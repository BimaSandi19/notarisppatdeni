#!/bin/bash

# ========================================
# 🗄️ MYSQL & PHPMYADMIN SETUP SCRIPT
# ========================================
# Project: Sistem Manajemen Tagihan Notaris PPAT
# Author: BimaSandi19
# Date: 2025-11-19
# 
# This script will:
# 1. Install MySQL Server
# 2. Create database and user
# 3. Install phpMyAdmin
# 4. Configure .env file
# ========================================

set -e  # Exit on error

echo "=========================================="
echo "🗄️ MYSQL & PHPMYADMIN SETUP"
echo "=========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}❌ Error: This script must be run as root (use sudo)${NC}"
    exit 1
fi

echo -e "${YELLOW}📋 Please provide the following information:${NC}"
echo ""

# Get database configuration
read -p "Database Name [laravel_db]: " DB_NAME
DB_NAME=${DB_NAME:-laravel_db}

read -p "Database User [laravel_user]: " DB_USER
DB_USER=${DB_USER:-laravel_user}

read -sp "Database Password (min 8 characters): " DB_PASS
echo ""

if [ -z "$DB_PASS" ] || [ ${#DB_PASS} -lt 8 ]; then
    echo -e "${RED}❌ Error: Password must be at least 8 characters${NC}"
    exit 1
fi

read -sp "MySQL Root Password (will be set if not exists): " MYSQL_ROOT_PASS
echo ""

if [ -z "$MYSQL_ROOT_PASS" ] || [ ${#MYSQL_ROOT_PASS} -lt 8 ]; then
    echo -e "${RED}❌ Error: Root password must be at least 8 characters${NC}"
    exit 1
fi

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
# 2. INSTALL MYSQL SERVER
# ========================================
echo "🗄️ Step 2: Installing MySQL Server..."

# Check if MySQL is already installed
if command -v mysql &> /dev/null; then
    echo -e "${YELLOW}⚠️  MySQL is already installed${NC}"
else
    # Set MySQL root password before installation
    debconf-set-selections <<< "mysql-server mysql-server/root_password password $MYSQL_ROOT_PASS"
    debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MYSQL_ROOT_PASS"
    
    apt install -y mysql-server
    echo -e "${GREEN}✅ MySQL Server installed${NC}"
fi

# Start MySQL service
systemctl start mysql
systemctl enable mysql
echo -e "${GREEN}✅ MySQL service started and enabled${NC}"
echo ""

# ========================================
# 3. SECURE MYSQL INSTALLATION
# ========================================
echo "🔐 Step 3: Securing MySQL installation..."

# Run mysql_secure_installation commands
mysql -u root -p"$MYSQL_ROOT_PASS" <<EOF
-- Remove anonymous users
DELETE FROM mysql.user WHERE User='';
-- Disallow root login remotely
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
-- Remove test database
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
-- Reload privilege tables
FLUSH PRIVILEGES;
EOF

echo -e "${GREEN}✅ MySQL secured${NC}"
echo ""

# ========================================
# 4. CREATE DATABASE AND USER
# ========================================
echo "🗄️ Step 4: Creating database and user..."

mysql -u root -p"$MYSQL_ROOT_PASS" <<EOF
-- Create database
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';

-- Grant privileges
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';

-- Reload privileges
FLUSH PRIVILEGES;

-- Show created database
SHOW DATABASES LIKE '$DB_NAME';
EOF

echo -e "${GREEN}✅ Database '$DB_NAME' and user '$DB_USER' created${NC}"
echo ""

# ========================================
# 5. INSTALL PHPMYADMIN
# ========================================
echo "🌐 Step 5: Installing phpMyAdmin..."

# Check if phpMyAdmin is already installed
if [ -d "/usr/share/phpmyadmin" ]; then
    echo -e "${YELLOW}⚠️  phpMyAdmin is already installed${NC}"
else
    # Pre-configure phpMyAdmin
    debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
    debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $MYSQL_ROOT_PASS"
    debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $MYSQL_ROOT_PASS"
    debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $MYSQL_ROOT_PASS"
    debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
    
    DEBIAN_FRONTEND=noninteractive apt install -y phpmyadmin php-mbstring php-zip php-gd php-json php-curl
    
    echo -e "${GREEN}✅ phpMyAdmin installed${NC}"
fi

# Enable required PHP extensions
phpenmod mbstring
phpenmod mysqli

# Restart web server
if systemctl is-active --quiet apache2; then
    systemctl restart apache2
    echo -e "${GREEN}✅ Apache restarted${NC}"
elif systemctl is-active --quiet nginx; then
    # Create symlink for nginx
    if [ ! -L "/var/www/html/phpmyadmin" ]; then
        ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
    fi
    systemctl restart nginx
    systemctl restart php8.3-fpm 2>/dev/null || systemctl restart php8.2-fpm 2>/dev/null || systemctl restart php8.1-fpm
    echo -e "${GREEN}✅ Nginx and PHP-FPM restarted${NC}"
fi

echo ""

# ========================================
# 6. CONFIGURE .ENV FILE.
# ========================================
echo "⚙️  Step 6: Configuring .env file..."

# Find the application directory
APP_DIR=$(pwd)

if [ -f "$APP_DIR/.env" ]; then
    echo -e "${YELLOW}⚠️  .env file exists. Creating backup...${NC}"
    cp "$APP_DIR/.env" "$APP_DIR/.env.backup.$(date +%Y%m%d_%H%M%S)"
    echo -e "${GREEN}✅ Backup created${NC}"
    
    # Update existing .env
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" "$APP_DIR/.env"
    sed -i "s/^DB_HOST=.*/DB_HOST=127.0.0.1/" "$APP_DIR/.env"
    sed -i "s/^DB_PORT=.*/DB_PORT=3306/" "$APP_DIR/.env"
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" "$APP_DIR/.env"
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USER/" "$APP_DIR/.env"
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" "$APP_DIR/.env"
    
    echo -e "${GREEN}✅ .env file updated${NC}"
elif [ -f "$APP_DIR/.env.example" ]; then
    echo "Creating .env from .env.example..."
    cp "$APP_DIR/.env.example" "$APP_DIR/.env"
    
    # Update .env
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" "$APP_DIR/.env"
    sed -i "s/^DB_HOST=.*/DB_HOST=127.0.0.1/" "$APP_DIR/.env"
    sed -i "s/^DB_PORT=.*/DB_PORT=3306/" "$APP_DIR/.env"
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" "$APP_DIR/.env"
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USER/" "$APP_DIR/.env"
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" "$APP_DIR/.env"
    
    echo -e "${GREEN}✅ .env file created and configured${NC}"
else
    echo -e "${RED}❌ Error: No .env or .env.example found${NC}"
    echo "Please create .env manually with these settings:"
    echo "DB_CONNECTION=mysql"
    echo "DB_HOST=127.0.0.1"
    echo "DB_PORT=3306"
    echo "DB_DATABASE=$DB_NAME"
    echo "DB_USERNAME=$DB_USER"
    echo "DB_PASSWORD=$DB_PASS"
fi

echo ""

# ========================================
# 7. TEST DATABASE CONNECTION
# ========================================
echo "🧪 Step 7: Testing database connection..."

if command -v php &> /dev/null; then
    php -r "
    try {
        \$pdo = new PDO('mysql:host=127.0.0.1;dbname=$DB_NAME', '$DB_USER', '$DB_PASS');
        echo '✅ Database connection successful!' . PHP_EOL;
    } catch(PDOException \$e) {
        echo '❌ Connection failed: ' . \$e->getMessage() . PHP_EOL;
        exit(1);
    }
    "
else
    echo -e "${YELLOW}⚠️  PHP CLI not found, skipping connection test${NC}"
fi

echo ""

# ========================================
# SETUP COMPLETE
# ========================================
echo "=========================================="
echo -e "${GREEN}✅ SETUP COMPLETE!${NC}"
echo "=========================================="
echo ""
echo -e "${YELLOW}📋 Database Information:${NC}"
echo "   Database Name: $DB_NAME"
echo "   Database User: $DB_USER"
echo "   Database Password: [HIDDEN]"
echo "   MySQL Root Password: [HIDDEN]"
echo ""
echo -e "${YELLOW}🌐 phpMyAdmin Access:${NC}"
echo "   URL: http://your-server-ip/phpmyadmin"
echo "   Username: $DB_USER (or root)"
echo "   Password: [Your database password]"
echo ""
echo -e "${YELLOW}📝 Next Steps:${NC}"
echo "   1. Access phpMyAdmin at http://your-server-ip/phpmyadmin"
echo "   2. Run Laravel migrations: php artisan migrate"
echo "   3. Seed the database: php artisan db:seed"
echo "   4. Test your application"
echo ""
echo -e "${YELLOW}🔐 Security Recommendations:${NC}"
echo "   1. Change phpMyAdmin URL (rename /phpmyadmin)"
echo "   2. Setup firewall (ufw) to limit access"
echo "   3. Use strong passwords"
echo "   4. Regular backups with: mysqldump -u root -p $DB_NAME > backup.sql"
echo ""
echo -e "${GREEN}🎉 Happy coding!${NC}"
echo "=========================================="
