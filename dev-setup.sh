#!/bin/bash

# Script de Setup para Desenvolvimento Local - WJJC Portugal
# Este script configura o ambiente de desenvolvimento

set -e

# Cores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

warn() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}"
}

log "🔧 Configurando ambiente de desenvolvimento..."

# Verificar se estamos no diretório correto
if [ ! -f "artisan" ]; then
    echo "❌ Este script deve ser executado no diretório raiz do Laravel"
    exit 1
fi

# 1. Copiar arquivo de ambiente se não existir
if [ ! -f ".env" ]; then
    log "📋 Copiando arquivo de ambiente..."
    cp .env.example .env
    log "✅ Arquivo .env criado"
else
    log "✅ Arquivo .env já existe"
fi

# 2. Gerar chave da aplicação se não existir
if ! grep -q "APP_KEY=base64:" .env; then
    log "🔑 Gerando chave da aplicação..."
    php artisan key:generate
    log "✅ Chave da aplicação gerada"
else
    log "✅ Chave da aplicação já existe"
fi

# 3. Instalar dependências do Composer
log "📦 Instalando dependências do Composer..."
composer install

# 4. Instalar dependências do Node.js
log "📦 Instalando dependências do Node.js..."
npm install

# 5. Limpar caches
log "🧹 Limpando caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 6. Executar migrações
log "🗄️ Executando migrações..."
php artisan migrate

# 7. Executar seeders
log "🌱 Executando seeders..."
php artisan db:seed

# 8. Criar storage link
log "🔗 Criando storage link..."
php artisan storage:link

# 9. Configurar permissões
log "🔐 Configurando permissões..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# 10. Build dos assets para desenvolvimento
log "🔨 Fazendo build dos assets para desenvolvimento..."
npm run build

log "🎉 Ambiente de desenvolvimento configurado com sucesso!"
log "🚀 Para iniciar o servidor: php artisan serve"
log "📱 Para iniciar o Vite: npm run dev"
log "🔄 Para ambos: npm run start"
