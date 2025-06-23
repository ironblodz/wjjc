# Guia de Deploy - WJJC Portugal

Este guia explica como fazer deploy da aplicação WJJC Portugal em diferentes ambientes.

## 🚀 Deploy Rápido

### Para Produção

```bash
# Opção 1: Script automatizado
./deploy.sh

# Opção 2: Comando Artisan
php artisan app:deploy --force

# Opção 3: NPM script
npm run deploy
```

### Para Desenvolvimento Local

```bash
# Configurar ambiente pela primeira vez
./dev-setup.sh

# Ou usando NPM
npm run setup
```

## 📋 Pré-requisitos

### Servidor de Produção

-   PHP 8.1+
-   Composer 2.0+
-   Node.js 18+
-   MySQL 8.0+ ou MariaDB 10.5+
-   Redis (opcional, para cache)
-   Nginx ou Apache

### Local

-   PHP 8.1+
-   Composer 2.0+
-   Node.js 18+
-   MySQL 8.0+ ou MariaDB 10.5+

## 🔧 Configuração

### 1. Arquivo de Ambiente

Copie o arquivo de exemplo e configure as variáveis:

```bash
cp .env.example .env
```

**Variáveis importantes para produção:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://wjjc.pt

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wjjc_production
DB_USERNAME=wjjc_user
DB_PASSWORD=your_secure_password

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 2. Permissões

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/build
```

### 3. Storage Link

```bash
php artisan storage:link
```

## 🛠️ Scripts Disponíveis

### NPM Scripts

```bash
npm run dev          # Desenvolvimento com Vite
npm run build        # Build para produção
npm run build:watch  # Build com watch
npm run start        # Laravel + Vite simultaneamente
npm run deploy       # Deploy completo
npm run setup        # Setup inicial
npm run clean        # Limpar node_modules
npm run clean:all    # Limpar tudo e rebuild
```

### Comandos Artisan

```bash
php artisan app:deploy --force  # Deploy para produção
php artisan optimize            # Otimizar para produção
php artisan config:cache        # Cache de configuração
php artisan route:cache         # Cache de rotas
php artisan view:cache          # Cache de views
```

## 🔄 Processo de Deploy

### Automatizado (Recomendado)

1. Execute `./deploy.sh`
2. O script fará automaticamente:
    - Backup do banco (se configurado)
    - Limpeza de caches
    - Instalação de dependências
    - Build dos assets
    - Migrações
    - Otimizações
    - Verificação de permissões

### Manual

```bash
# 1. Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 2. Instalar dependências
composer install --no-dev --optimize-autoloader
npm ci --production

# 3. Build dos assets
npm run build

# 4. Copiar manifest.json (se necessário)
cp public/build/.vite/manifest.json public/build/manifest.json

# 5. Migrações
php artisan migrate --force

# 6. Otimizar
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Permissões
chmod -R 755 storage bootstrap/cache public/build
```

## 🐛 Troubleshooting

### Problemas Comuns

#### 1. Manifest.json não encontrado

```bash
# Verificar se o build foi feito
ls -la public/build/

# Rebuild se necessário
npm run build
```

#### 2. Permissões de Storage

```bash
# Verificar permissões
ls -la storage/
ls -la bootstrap/cache/

# Corrigir permissões
chmod -R 755 storage bootstrap/cache
```

#### 3. Storage Link quebrado

```bash
# Remover link antigo
rm public/storage

# Criar novo link
php artisan storage:link
```

#### 4. Cache não limpo

```bash
# Limpar todos os caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan clear-compiled
```

### Logs

```bash
# Ver logs em tempo real
tail -f storage/logs/laravel.log

# Ver logs de erro
tail -f storage/logs/laravel-$(date +%Y-%m-%d).log
```

## 📊 Monitoramento

### Verificar Status

```bash
# Verificar se Laravel está funcionando
php artisan --version

# Verificar configurações
php artisan config:show

# Verificar rotas
php artisan route:list
```

### Performance

```bash
# Verificar cache
php artisan cache:table
php artisan cache:clear

# Verificar otimizações
php artisan optimize
```

## 🔒 Segurança

### Produção

-   Sempre use `APP_DEBUG=false`
-   Configure HTTPS
-   Use senhas fortes para banco de dados
-   Mantenha dependências atualizadas
-   Configure firewall adequadamente

### Backup

```bash
# Backup do banco
mysqldump -u username -p database_name > backup.sql

# Backup dos arquivos
tar -czf backup_$(date +%Y%m%d).tar.gz --exclude=node_modules --exclude=vendor .
```

## 📞 Suporte

Para problemas específicos:

1. Verifique os logs em `storage/logs/`
2. Execute `php artisan app:deploy --force` para verificar erros
3. Consulte a documentação do Laravel
4. Entre em contato com a equipe de desenvolvimento
