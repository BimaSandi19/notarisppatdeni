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
    echo "Installing Node.js dependencies (including dev for build)..."
    npm ci --silent
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
        
        # Prune dev dependencies after build to save space
        echo "Removing dev dependencies..."
        npm prune --omit=dev --silent
        echo "✅ Dev dependencies removed"
    fi
else
    echo "⚠️  Skipping asset build (npm not available)"
fi

echo ""

# ========================================
# 4. ENVIRONMENT SETUP
# ========================================
echo "⚙️  Step 4: Setting up environment..."

# Check if .env exists
if [ ! -f ".env" ]; then
    if [ -f ".env.production" ]; then
        echo "Copying .env.production to .env..."
        cp .env.production .env
        echo "✅ .env file created from .env.production"
    else
        echo "❌ Error: No .env file found and no .env.production to copy from!"
        echo "Please create a .env file on the server with production settings."
        exit 1
    fi
fi

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
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

if [ "$1" == "--seed" ]; then
    echo "Seeding database..."
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

php artisan optimize:clear
php artisan config:cache
echo "✅ Config cached"

php artisan route:cache
echo "✅ Routes cached"

php artisan view:cache
echo "✅ Views cached"

echo ""

# ========================================
# 8. STORAGE SYMLINK
# ========================================
echo "🔗 Step 8: Setting up storage symlink..."

if [ ! -L "public/storage" ]; then
    php artisan storage:link
    echo "✅ Storage linked"
else
    echo "✅ Storage symlink already exists"
fi

echo ""

# ========================================
# 9. CLEANUP
# ========================================
echo "🧹 Step 9: Cleaning up..."

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

php artisan route:list --path=admin/dashboard > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Application routes verified"
else
    echo "⚠️  Warning: Could not verify routes"
fi

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
echo "   1. Check website at your domain"
echo "   2. Test login functionality"
echo "   3. Verify history & reminder pages"
echo ""
echo "📝 Useful Commands:"
echo "   - View logs: tail -f storage/logs/laravel.log"
echo "   - Clear cache: php artisan optimize:clear"
echo ""
echo "🎉 Deployment successful!"
echo "=========================================="
