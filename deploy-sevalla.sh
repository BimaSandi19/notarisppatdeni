#!/bin/bash

# Sevalla Deployment Script
# Kantor Notaris Deni Nugraha
# Version: 1.0

echo "🚀 Starting Sevalla Deployment Process..."
echo "================================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

# Check if running in production
if [ "$APP_ENV" != "production" ]; then
    print_warning "APP_ENV is not set to production. Proceeding with caution..."
fi

# Step 1: Install Composer Dependencies
echo ""
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction || {
    print_error "Composer install failed"
    exit 1
}
print_status "Composer dependencies installed"

# Step 2: Install NPM Dependencies
echo ""
echo "📦 Installing NPM dependencies..."
npm ci || {
    print_error "NPM install failed"
    exit 1
}
print_status "NPM dependencies installed"

# Step 3: Build Assets
echo ""
echo "🏗️  Building production assets..."
npm run build || {
    print_error "Asset build failed"
    exit 1
}
print_status "Assets built successfully"

# Step 4: Clear All Caches
echo ""
echo "🧹 Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
print_status "All caches cleared"

# Step 5: Run Database Migrations
echo ""
echo "🗄️  Running database migrations..."
php artisan migrate --force || {
    print_error "Database migration failed"
    exit 1
}
print_status "Database migrations completed"

# Step 6: Create Storage Link
echo ""
echo "🔗 Creating storage symlink..."
php artisan storage:link || print_warning "Storage link may already exist"
print_status "Storage link created"

# Step 7: Optimize Application
echo ""
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize
print_status "Application optimized"

# Step 8: Set File Permissions
echo ""
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
print_status "File permissions set"

# Step 9: Verify Critical Directories
echo ""
echo "📁 Verifying critical directories..."
directories=(
    "storage/app/public"
    "storage/framework/cache"
    "storage/framework/sessions"
    "storage/framework/views"
    "storage/logs"
    "bootstrap/cache"
    "public/images"
    "public/css"
    "public/js"
    "public/build"
)

for dir in "${directories[@]}"; do
    if [ -d "$dir" ]; then
        print_status "Directory exists: $dir"
    else
        print_warning "Creating directory: $dir"
        mkdir -p "$dir"
        chmod -R 755 "$dir"
    fi
done

# Step 10: Health Check
echo ""
echo "🏥 Running health checks..."

# Check if .env exists
if [ ! -f ".env" ]; then
    print_error ".env file not found!"
    exit 1
fi
print_status ".env file exists"

# Check if APP_KEY is set
if ! grep -q "APP_KEY=base64:" .env; then
    print_error "APP_KEY not set in .env file!"
    exit 1
fi
print_status "APP_KEY is configured"

# Check database connection
php artisan db:show > /dev/null 2>&1 || {
    print_warning "Database connection check failed. Verify DB credentials."
}

# Step 11: Display Deployment Summary
echo ""
echo "================================================"
echo "📊 Deployment Summary"
echo "================================================"
echo "PHP Version: $(php -v | head -n 1)"
echo "Composer Version: $(composer --version)"
echo "NPM Version: $(npm --version)"
echo "Laravel Version: $(php artisan --version)"
echo ""
echo "Application URL: ${APP_URL}"
echo "Environment: ${APP_ENV}"
echo "Debug Mode: ${APP_DEBUG}"
echo ""

# Step 12: Post-Deployment Instructions
echo "================================================"
echo "🎉 Deployment Completed Successfully!"
echo "================================================"
echo ""
echo "📝 Post-Deployment Checklist:"
echo "  1. ✅ Test website at: ${APP_URL}"
echo "  2. ✅ Test admin login: ${APP_URL}/login"
echo "  3. ✅ Test contact form email"
echo "  4. ✅ Verify all images loading"
echo "  5. ✅ Check responsive design on mobile"
echo "  6. ✅ Setup cron job for scheduler:"
echo "     * * * * * cd $(pwd) && php artisan schedule:run >> /dev/null 2>&1"
echo ""
echo "📞 Support:"
echo "  - Sevalla: https://sevalla.com/support"
echo "  - Documentation: SEVALLA_DEPLOYMENT.md"
echo ""
print_status "Deployment script completed!"
