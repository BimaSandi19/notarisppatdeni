#!/bin/bash
#################################################################################
# Deployment Script for Nat VPS
# Website Notaris Deni Nugraha
# Production Deployment & Configuration
#################################################################################

set -e  # Exit on error

echo "🚀 DEPLOYING TO NAT VPS"
echo "======================="
echo ""

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Check if .env exists
if [ ! -f ".env" ]; then
    echo -e "${RED}❌ ERROR: .env file not found!${NC}"
    echo "Please copy .env.natvps to .env and configure it first."
    echo "$ cp .env.natvps .env"
    echo "$ nano .env  # Edit with your values"
    exit 1
fi

echo -e "${YELLOW}1️⃣ Pulling latest code from Git${NC}"
git pull origin master
echo -e "${GREEN}✅ Git pull successful${NC}"
echo ""

echo -e "${YELLOW}2️⃣ Installing Composer dependencies${NC}"
composer install --no-dev --optimize-autoloader
echo -e "${GREEN}✅ Composer install successful${NC}"
echo ""

echo -e "${YELLOW}3️⃣ Installing NPM dependencies${NC}"
npm ci
echo -e "${GREEN}✅ NPM install successful${NC}"
echo ""

echo -e "${YELLOW}4️⃣ Building assets with Vite${NC}"
npm run build
echo -e "${GREEN}✅ Assets built successfully${NC}"
echo ""

echo -e "${YELLOW}5️⃣ Running database migrations${NC}"
php artisan migrate --force
echo -e "${GREEN}✅ Migrations completed${NC}"
echo ""

echo -e "${YELLOW}6️⃣ Seeding admin user${NC}"
php artisan db:seed --force
echo -e "${GREEN}✅ Database seeded${NC}"
echo ""

echo -e "${YELLOW}7️⃣ Clearing and caching configuration${NC}"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo -e "${GREEN}✅ Caches cleared${NC}"
echo ""

echo -e "${YELLOW}8️⃣ Optimizing application${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
echo -e "${GREEN}✅ Application optimized${NC}"
echo ""

echo -e "${YELLOW}9️⃣ Creating storage symlink${NC}"
php artisan storage:link
echo -e "${GREEN}✅ Storage symlink created${NC}"
echo ""

echo -e "${YELLOW}🔟 Setting file permissions${NC}"
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
echo -e "${GREEN}✅ Permissions set${NC}"
echo ""

echo -e "${YELLOW}1️⃣1️⃣ Verifying deployment${NC}"
echo ""
echo "App version: $(php artisan --version)"
echo "Environment: $(grep APP_ENV .env | cut -d'=' -f2)"
echo "Database: $(grep DB_DATABASE .env | cut -d'=' -f2)"
echo "URL: $(grep APP_URL .env | cut -d'=' -f2)"
echo ""

echo -e "${GREEN}================================${NC}"
echo -e "${GREEN}✅ DEPLOYMENT COMPLETE!${NC}"
echo -e "${GREEN}================================${NC}"
echo ""
echo "Next steps:"
echo "1. Test application: curl -I https://your-domain.com"
echo "2. Check logs: tail -50 storage/logs/laravel.log"
echo "3. Test routes:"
echo "   - Homepage: https://your-domain.com"
echo "   - Login: https://your-domain.com/login"
echo "   - Admin Dashboard: https://your-domain.com/admin/dashboard"
echo ""
echo "Admin Credentials:"
echo "   Username: keuangandn01"
echo "   Password: adminkeuangan@dn1"
echo ""
echo "For troubleshooting, check:"
echo "   - storage/logs/laravel.log (application logs)"
echo "   - Database connection and migrations"
echo "   - File permissions (especially storage and bootstrap/cache)"
echo "   - HTTPS certificate (if using SSL)"
echo ""
