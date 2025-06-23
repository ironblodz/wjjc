#!/bin/bash

# Script de Deploy para Produção - WJJC Portugal
# Este script automatiza o processo completo de deploy para produção

set -e  # Para o script se houver algum erro

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Função para log
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

warn() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}"
}

error() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR: $1${NC}"
    exit 1
}

log "🚀 Iniciando deploy para produção..."

# Verificar se estamos no diretório correto
if [ ! -f "artisan" ]; then
    error "Este script deve ser executado no diretório raiz do Laravel"
fi

# 1. Backup do banco de dados (se configurado)
if command -v mysqldump &> /dev/null; then
    log "💾 Fazendo backup do banco de dados..."
    if [ -n "$DB_DATABASE" ]; then
        mysqldump -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" > "backup_$(date +%Y%m%d_%H%M%S).sql"
        log "✅ Backup criado com sucesso"
    else
        warn "Variáveis de banco de dados não configuradas, pulando backup"
    fi
fi

# 2. Limpar todos os caches do Laravel
log "🧹 Limpando caches do Laravel..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan clear-compiled

# 3. Verificar e instalar dependências do Composer
log "📦 Verificando dependências do Composer..."
if [ ! -d "vendor" ] || [ ! -f "composer.lock" ]; then
    log "Instalando dependências do Composer..."
    composer install --no-dev --optimize-autoloader
else
    log "Atualizando dependências do Composer..."
    composer install --no-dev --optimize-autoloader
fi

# 4. Verificar e instalar dependências do Node.js
log "📦 Verificando dependências do Node.js..."
if [ ! -d "node_modules" ] || [ ! -f "package-lock.json" ]; then
    log "Instalando dependências do Node.js..."
    npm ci --production
else
    log "Atualizando dependências do Node.js..."
    npm ci --production
fi

# 5. Build dos assets para produção
log "🔨 Fazendo build dos assets para produção..."
npm run build

# 6. Verificar e corrigir manifest.json
log "📋 Verificando manifest.json..."
if [ -f "public/build/.vite/manifest.json" ]; then
    log "Copiando manifest.json..."
    cp public/build/.vite/manifest.json public/build/manifest.json
    log "✅ Manifest.json copiado com sucesso"
else
    warn "Manifest.json não encontrado em .vite/, verificando se já existe..."
    if [ ! -f "public/build/manifest.json" ]; then
        error "Manifest.json não encontrado. Build pode ter falhado."
    fi
fi

# 7. Executar migrações do banco de dados
log "🗄️ Executando migrações do banco de dados..."
php artisan migrate --force

# 8. Otimizar para produção
log "⚡ Otimizando para produção..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Verificar e corrigir permissões
log "🔐 Configurando permissões..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/build

# Verificar se o usuário web pode escrever nos diretórios necessários
if [ -n "$(command -v apache2 2>/dev/null)" ] || [ -n "$(command -v nginx 2>/dev/null)" ]; then
    # Em servidores web, o usuário pode ser www-data, apache, nginx, etc.
    WEB_USER=$(ps aux | grep -E '(apache|nginx|httpd)' | grep -v grep | head -1 | awk '{print $1}')
    if [ -n "$WEB_USER" ]; then
        log "Configurando permissões para usuário web: $WEB_USER"
        chown -R $WEB_USER:$WEB_USER storage
        chown -R $WEB_USER:$WEB_USER bootstrap/cache
        chown -R $WEB_USER:$WEB_USER public/build
    fi
fi

# 10. Verificar storage link
log "🔗 Verificando storage link..."
if [ ! -L "public/storage" ]; then
    log "Criando storage link..."
    php artisan storage:link
fi

# 11. Limpar logs antigos (manter apenas os últimos 7 dias)
log "🗑️ Limpando logs antigos..."
find storage/logs -name "*.log" -mtime +7 -delete 2>/dev/null || true

# 12. Verificação final
log "🔍 Fazendo verificação final..."

# Verificar se o Laravel está funcionando
if php artisan --version > /dev/null 2>&1; then
    log "✅ Laravel está funcionando corretamente"
else
    error "❌ Laravel não está funcionando corretamente"
fi

# Verificar se os assets foram buildados
if [ -f "public/build/manifest.json" ]; then
    log "✅ Assets buildados com sucesso"
else
    error "❌ Assets não foram buildados corretamente"
fi

# Verificar permissões críticas
if [ -w "storage" ] && [ -w "bootstrap/cache" ]; then
    log "✅ Permissões configuradas corretamente"
else
    error "❌ Problemas com permissões"
fi

log "🎉 Deploy concluído com sucesso!"
log "🌐 A aplicação está pronta para produção!"
log "📊 Para monitorar logs: tail -f storage/logs/laravel.log"
