#!/bin/bash

# ========================================
# 🌐 NGINX + PHP-FPM SETUP SCRIPT
# ========================================
# Project: Sistem Manajemen Tagihan Notaris PPAT
# Author: BimaSandi19
# Date: 2025-11-19
# 
# This script will:
# 1. Install Nginx Web Server
# 2. Install PHP 8.3 + PHP-FPM
# 3. Install required PHP extensions
# 4. Configure Nginx for Laravel
# 5. Setup SSL (optional)
# ========================================

set -e  # Exit on error

echo "=========================================="
echo "🌐 NGINX + PHP-FPM SETUP"
echo "=========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}❌ Error: This script must be run as root (use sudo)${NC}"
    exit 1
fi

# Get configuration
echo -e "${YELLOW}📋 Please provide the following information:${NC}"
echo ""

DOMAIN="https://notarisdeni.web.id"

read -p "Application directory [/var/www/notaris_ppat_den]: " APP_DIR
APP_DIR=${APP_DIR:-/var/www/notaris_ppat_deni}

read -p "Server name (for Nginx config) [notaris-ppat]: " SERVER_NAME
SERVER_NAME=${SERVER_NAME:-notaris-ppat}

echo ""
echo -e "${GREEN}✅ Configuration received. Starting setup...${NC}"
echo ""

# ========================================
# 1. UPDATE SYSTEM
# ========================================
echo "📦 Step 1: Updating system packages..."
apt update -qq
echo -e "${GREEN}✅ System updated${NC}"
echo ""

# ========================================
# 2. INSTALL NGINX
# ========================================
echo "🌐 Step 2: Installing Nginx..."

if command -v nginx &> /dev/null; then
    echo -e "${YELLOW}⚠️  Nginx is already installed${NC}"
else
    apt install -y nginx
    echo -e "${GREEN}✅ Nginx installed${NC}"
fi

# Stop nginx for now
systemctl stop nginx 2>/dev/null || true
echo ""

# ========================================
# 3. INSTALL PHP 8.3 + PHP-FPM
# ========================================
echo "🐘 Step 3: Installing PHP 8.3 and PHP-FPM..."

# Add PHP repository if needed
if ! apt-cache policy | grep -q "ondrej/php"; then
    echo "Adding PHP repository..."
    apt install -y software-properties-common
    add-apt-repository -y ppa:ondrej/php
    apt update -qq
fi

# Install PHP and required extensions
echo "Installing PHP packages..."
apt install -y \
    php8.3-fpm \
    php8.3-cli \
    php8.3-common \
    php8.3-mysql \
    php8.3-zip \
    php8.3-gd \
    php8.3-mbstring \
    php8.3-curl \
    php8.3-xml \
    php8.3-bcmath \
    php8.3-intl \
    php8.3-opcache \
    php8.3-readline

echo -e "${GREEN}✅ PHP 8.3 and extensions installed${NC}"

# Verify PHP version
php -v | head -n 1
echo ""

# ========================================
# 4. CONFIGURE PHP-FPM
# ========================================
echo "⚙️  Step 4: Configuring PHP-FPM..."

# Backup original config
if [ -f "/etc/php/8.3/fpm/php.ini" ]; then
    cp /etc/php/8.3/fpm/php.ini /etc/php/8.3/fpm/php.ini.backup
fi

# Optimize PHP settings for production
cat > /etc/php/8.3/fpm/conf.d/99-laravel.ini <<EOF
; Laravel Optimizations
upload_max_filesize = 50M
post_max_size = 50M
max_execution_time = 300
max_input_time = 300
memory_limit = 512M
date.timezone = Asia/Jakarta

; OPcache settings
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1
EOF

echo -e "${GREEN}✅ PHP-FPM configured${NC}"
echo ""

# ========================================
# 5. CREATE APPLICATION DIRECTORY
# ========================================
echo "📁 Step 5: Setting up application directory..."

if [ ! -d "$APP_DIR" ]; then
    mkdir -p "$APP_DIR"
    echo -e "${GREEN}✅ Directory created: $APP_DIR${NC}"
else
    echo -e "${YELLOW}⚠️  Directory already exists: $APP_DIR${NC}"
fi

# Set ownership
chown -R www-data:www-data "$APP_DIR"
echo -e "${GREEN}✅ Ownership set to www-data${NC}"
echo ""

# ========================================
# 6. CONFIGURE NGINX FOR LARAVEL
# ========================================
echo "⚙️  Step 6: Configuring Nginx..."

# Create Nginx config
cat > /etc/nginx/sites-available/$SERVER_NAME <<EOF
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN;
    root $APP_DIR/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Disable access to sensitive files
    location ~* \.(env|git|gitignore|log)$ {
        deny all;
        return 404;
    }

    # Cache static files
    location ~* \.(jpg|jpeg|gif|png|css|js|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        access_log off;
        add_header Cache-Control "public, immutable";
    }

    # Deny access to .htaccess
    location ~ /\.ht {
        deny all;
    }

    # Security headers
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    
    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/json application/javascript;
}
EOF

# Enable site
ln -sf /etc/nginx/sites-available/$SERVER_NAME /etc/nginx/sites-enabled/

# Remove default site
rm -f /etc/nginx/sites-enabled/default

# Test Nginx configuration
nginx -t

echo -e "${GREEN}✅ Nginx configured${NC}"
echo ""

# ========================================
# 7. INSTALL COMPOSER (if not exists)
# ========================================
echo "📦 Step 7: Checking Composer..."

if ! command -v composer &> /dev/null; then
    echo "Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
    chmod +x /usr/local/bin/composer
    echo -e "${GREEN}✅ Composer installed${NC}"
else
    echo -e "${GREEN}✅ Composer already installed${NC}"
    composer --version
fi
echo ""

# ========================================
# 8. INSTALL NODE.JS & NPM (if not exists)
# ========================================
echo "📦 Step 8: Checking Node.js..."

if ! command -v node &> /dev/null; then
    echo "Installing Node.js..."
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt install -y nodejs
    echo -e "${GREEN}✅ Node.js installed${NC}"
else
    echo -e "${GREEN}✅ Node.js already installed${NC}"
fi

node -v
npm -v
echo ""

# ========================================
# 9. SET PERMISSIONS
# ========================================
echo "🔐 Step 9: Setting Laravel permissions..."

if [ -d "$APP_DIR/storage" ]; then
    chown -R www-data:www-data "$APP_DIR/storage"
    chmod -R 775 "$APP_DIR/storage"
    echo -e "${GREEN}✅ Storage permissions set${NC}"
fi

if [ -d "$APP_DIR/bootstrap/cache" ]; then
    chown -R www-data:www-data "$APP_DIR/bootstrap/cache"
    chmod -R 775 "$APP_DIR/bootstrap/cache"
    echo -e "${GREEN}✅ Bootstrap cache permissions set${NC}"
fi

echo ""

# ========================================
# 10. START SERVICES
# ========================================
echo "🚀 Step 10: Starting services..."

# Start PHP-FPM
systemctl start php8.3-fpm
systemctl enable php8.3-fpm
echo -e "${GREEN}✅ PHP-FPM started${NC}"

# Start Nginx
systemctl start nginx
systemctl enable nginx
echo -e "${GREEN}✅ Nginx started${NC}"

echo ""

# ========================================
# 11. FIREWALL CONFIGURATION
# ========================================
echo "🔥 Step 11: Configuring firewall..."

if command -v ufw &> /dev/null; then
    # Allow Nginx
    ufw allow 'Nginx Full' 2>/dev/null || ufw allow 80/tcp
    ufw allow 443/tcp
    
    # Show status (don't enable if not already enabled)
    if ufw status | grep -q "Status: active"; then
        echo -e "${GREEN}✅ Firewall rules added${NC}"
    else
        echo -e "${YELLOW}⚠️  Firewall not active. Rules added but not enabled.${NC}"
        echo "   To enable: sudo ufw enable"
    fi
else
    echo -e "${YELLOW}⚠️  UFW not installed. Skipping firewall setup.${NC}"
fi

echo ""

# ========================================
# 12. VERIFY INSTALLATION
# ========================================
echo "✅ Step 12: Verifying installation..."

# Check PHP-FPM
if systemctl is-active --quiet php8.3-fpm; then
    echo -e "${GREEN}✅ PHP-FPM is running${NC}"
else
    echo -e "${RED}❌ PHP-FPM is not running${NC}"
fi

# Check Nginx
if systemctl is-active --quiet nginx; then
    echo -e "${GREEN}✅ Nginx is running${NC}"
else
    echo -e "${RED}❌ Nginx is not running${NC}"
fi

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo -e "${GREEN}✅ PHP Version: $PHP_VERSION${NC}"

echo ""

# ========================================
# SETUP COMPLETE
# ========================================
echo "=========================================="
echo -e "${GREEN}✅ WEB SERVER SETUP COMPLETE!${NC}"
echo "=========================================="
echo ""
echo -e "${YELLOW}📋 Server Information:${NC}"
echo "   Domain/IP: $DOMAIN"
echo "   App Directory: $APP_DIR"
echo "   Web Root: $APP_DIR/public"
echo "   Nginx Config: /etc/nginx/sites-available/$SERVER_NAME"
echo "   PHP Version: $PHP_VERSION"
echo "   PHP-FPM Socket: /var/run/php/php8.3-fpm.sock"
echo ""
echo -e "${YELLOW}🌐 Access Your Application:${NC}"
echo "   URL: http://$DOMAIN"
echo ""
echo -e "${YELLOW}📝 Next Steps:${NC}"
echo "   1. Deploy your Laravel application to: $APP_DIR"
echo "   2. Create .env file with database credentials"
echo "   3. Run: composer install --no-dev"
echo "   4. Run: php artisan key:generate"
echo "   5. Run: php artisan migrate"
echo "   6. Run: php artisan storage:link"
echo "   7. Test your application at: http://$DOMAIN"
echo ""
echo -e "${YELLOW}🔐 SSL Setup (Optional):${NC}"
echo "   Install Certbot: sudo apt install certbot python3-certbot-nginx"
echo "   Get SSL: sudo certbot --nginx -d $DOMAIN"
echo ""
echo -e "${YELLOW}📊 Useful Commands:${NC}"
echo "   - Restart Nginx: sudo systemctl restart nginx"
echo "   - Restart PHP-FPM: sudo systemctl restart php8.3-fpm"
echo "   - Check Nginx logs: sudo tail -f /var/log/nginx/error.log"
echo "   - Check PHP-FPM logs: sudo tail -f /var/log/php8.3-fpm.log"
echo "   - Test Nginx config: sudo nginx -t"
echo ""
echo -e "${GREEN}🎉 Happy deploying!${NC}"
echo "=========================================="
