#!/bin/bash

# ========================================
# 🚀 UNIVERSAL LARAVEL DEPLOYMENT SCRIPT.
# ========================================
# Project: Sistem Manajemen Tagihan Notaris PPAT
# Author: BimaSandi19
# Date: 2025-11-13
# 
# This script works on:
# - Sevalla.app
# - Railway.app
# - Render.com
# - Fly.io
# - Any VPS/Shared Hosting with SSH
# ========================================

set -e  # Exit immediately if a command exits with a non-zero status

echo "=========================================="
echo "🚀 DEPLOYING LARAVEL APPLICATION"
echo "=========================================="
echo ""

# ========================================
# 1. ENVIRONMENT CHECK
# ========================================
echo "📋 Step 1: Checking environment..."

if [ ! -f "composer.json" ]; then
    echo "❌ Error: composer.json not found!"
    echo "Please run this script from project root directory."
    exit 1
fi

if [ ! -f ".env" ] && [ ! -f ".env.production" ]; then
    echo "❌ Error: No .env file found!"
    echo "Please create .env or copy from .env.production"
    exit 1
fi

echo "✅ Environment check passed"
echo ""

# ========================================
# 2. DEPENDENCIES INSTALLATION
# ========================================
echo "📦 Step 2: Installing dependencies..."

# Check if composer is available
if command -v composer &> /dev/null; then
    echo "Installing PHP dependencies..."
    composer install --optimize-autoloader --no-dev --no-interaction
    echo "✅ PHP dependencies installed"
else
    echo "⚠️  Warning: Composer not found. Skipping PHP dependencies."
fi

# Check if npm is available
if command -v npm &> /dev/null; then
    echo "Installing Node.js dependencies..."
    npm ci --omit=dev --silent
    echo "✅ Node.js dependencies installed"
else
    echo "⚠️  Warning: npm not found. Skipping Node dependencies."
fi

echo ""

# ========================================
# 3. BUILD ASSETS
# ========================================
echo "🔨 Step 3: Building production assets..."

if command -v npm &> /dev/null; then
    if [ -f "package.json" ]; then
        echo "Running Vite build..."
        npm run build
        echo "✅ Assets built successfully"
    fi
else
    echo "⚠️  Skipping asset build (npm not available)"
fi

echo ""

# ========================================
# 4. ENVIRONMENT SETUP
# ========================================
echo "⚙️  Step 4: Setting up environment..."

# Copy .env.production to .env if .env doesn't exist
if [ ! -f ".env" ] && [ -f ".env.production" ]; then
    echo "Copying .env.production to .env..."
    cp .env.production .env
    echo "⚠️  Remember to edit .env with production credentials!"
fi

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
    echo "✅ Application key generated"
else
    echo "✅ Application key already set"
fi

echo ""

# ========================================
# 5. DATABASE MIGRATION
# ========================================
echo "🗄️  Step 5: Running database migrations..."

php artisan migrate --force
echo "✅ Migrations completed"
echo ""

# ========================================
# 6. DATABASE SEEDING (Production-safe)
# ========================================
echo "🌱 Step 6: Seeding database..."

# Only seed if explicitly requested or first deployment
if [ "$1" == "--seed" ]; then
    echo "Seeding database (admin user only in production)..."
    php artisan db:seed --force
    echo "✅ Database seeded"
else
    echo "ℹ️  Skipping seed (use --seed flag if needed)"
fi

echo ""

# ========================================
# 7. OPTIMIZATION
# ========================================
echo "⚡ Step 7: Optimizing application..."

# Clear all caches
php artisan optimize:clear

# Cache configuration
php artisan config:cache
echo "✅ Config cached"

# Cache routes
php artisan route:cache
echo "✅ Routes cached"

# Cache views
php artisan view:cache
echo "✅ Views cached"

echo ""

# ========================================
# 8. STORAGE & PERMISSIONS
# ========================================
echo "🔐 Step 8: Setting permissions..."

# Create storage symlink if needed
if [ ! -L "public/storage" ]; then
    php artisan storage:link
    echo "✅ Storage linked"
fi

# Set permissions (if running as root or with sudo)
if [ "$EUID" -eq 0 ]; then
    echo "Setting directory permissions..."
    chmod -R 775 storage bootstrap/cache
    echo "✅ Permissions set"
else
    echo "ℹ️  Run with sudo to set permissions automatically"
    echo "   Or manually run: chmod -R 775 storage bootstrap/cache"
fi

echo ""

# ========================================
# 9. CLEANUP
# ========================================
echo "🧹 Step 9: Cleaning up..."

# Remove node_modules to save space (optional)
if [ "$2" == "--cleanup" ]; then
    if [ -d "node_modules" ]; then
        echo "Removing node_modules..."
        rm -rf node_modules
        echo "✅ node_modules removed"
    fi
fi

echo ""

# ========================================
# 10. VERIFICATION
# ========================================
echo "✅ Step 10: Verifying deployment..."

# Check if key routes exist
php artisan route:list --path=admin/dashboard > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Application routes verified"
else
    echo "⚠️  Warning: Could not verify routes"
fi

# Check if migrations are up to date
PENDING_MIGRATIONS=$(php artisan migrate:status | grep "Pending" | wc -l)
if [ "$PENDING_MIGRATIONS" -eq 0 ]; then
    echo "✅ All migrations applied"
else
    echo "⚠️  Warning: $PENDING_MIGRATIONS pending migrations found"
fi

echo ""

# ========================================
# DEPLOYMENT COMPLETE
# ========================================
echo "=========================================="
echo "✅ DEPLOYMENT COMPLETE!"
echo "=========================================="
echo ""
echo "📋 Next Steps:"
echo "   1. Visit your website URL"
echo "   2. Test login with admin credentials"
echo "   3. Verify all features working"
echo "   4. Setup cron job for scheduler:"
echo "      * * * * * cd $(pwd) && php artisan schedule:run >> /dev/null 2>&1"
echo ""
echo "📝 Post-Deployment Commands:"
echo "   - View logs: tail -f storage/logs/laravel.log"
echo "   - Clear cache: php artisan optimize:clear"
echo "   - Run queue: php artisan queue:work"
echo ""
echo "🎉 Happy deploying!"
echo "=========================================="
