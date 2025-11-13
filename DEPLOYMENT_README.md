# 🚀 Quick Deployment Guide

## 📋 Pre-Deployment Checklist

✅ **COMPLETED:**

- [x] Database migrations run (9 migrations)
- [x] Database backup created (49.18 KB - 2025-11-13 21:32:30)
- [x] Images optimized (7.43 MB total)
- [x] Production assets built (npm run build)
- [x] DatabaseSeeder production-safe
- [x] deploy.sh script created
- [x] Website profile improved (asset(), lazy loading, SEO alt text)

---

## 🎯 Deployment Steps

### Method 1: Using deploy.sh (Recommended)

```bash
# 1. Upload files to server
git clone https://github.com/BimaSandi19/notarisppatdeni.git
cd notarisppatdeni

# 2. Make deploy.sh executable
chmod +x deploy.sh

# 3. Run deployment script
bash deploy.sh

# 4. Setup cron job for scheduler
crontab -e
# Add this line:
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

### Method 2: Manual Deployment

```bash
# 1. Install dependencies
composer install --no-dev --optimize-autoloader
npm ci --omit=dev

# 2. Build assets
npm run build

# 3. Setup environment
cp .env.production .env
# Edit .env with production credentials
php artisan key:generate

# 4. Database
php artisan migrate --force
php artisan db:seed --force  # Creates admin user

# 5. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Permissions
chmod -R 775 storage bootstrap/cache
```

---

## 🌐 Sevalla.app Deployment

**Free Credit:** $50

### Quick Steps:

1. **Connect GitHub**
    - Go to Sevalla dashboard
    - Connect to `BimaSandi19/notarisppatdeni`
    - Branch: `master`

2. **Environment Variables** (Set in Sevalla dashboard)

    ```
    APP_ENV=production
    APP_DEBUG=false
    APP_KEY=<generate with: php artisan key:generate>
    APP_URL=https://your-app.sevalla.app

    DB_HOST=<from Sevalla>
    DB_DATABASE=<from Sevalla>
    DB_USERNAME=<from Sevalla>
    DB_PASSWORD=<from Sevalla>

    MAIL_PASSWORD=<your Gmail app password>
    ```

3. **Post-Deploy Commands** (Run in Sevalla terminal)

    ```bash
    php artisan migrate --force
    php artisan db:seed --force
    bash deploy.sh
    ```

4. **Setup Scheduler** (In Sevalla cron settings)
    ```
    * * * * * php artisan schedule:run
    ```

---

## 🔄 Migration to New Hosting

When $50 credit runs out, migrate easily:

### Backup Data:

```bash
php artisan db:backup
# Download: database/backups/backup_website_dn_*.sql
```

### Deploy to New Host:

```bash
# 1. Clone repository
git clone https://github.com/BimaSandi19/notarisppatdeni.git

# 2. Import database
mysql -u user -p database < backup_website_dn_*.sql

# 3. Run deploy script
bash deploy.sh --seed
```

**Time:** 30-45 minutes to migrate

---

## 🐛 Troubleshooting

### Issue: 500 Error

```bash
tail -f storage/logs/laravel.log
php artisan optimize:clear
```

### Issue: Permission Denied

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Issue: Database Connection Failed

```bash
# Verify credentials in .env
cat .env | grep DB_

# Test connection
php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue: Assets Not Loading

```bash
npm run build
php artisan view:clear
```

---

## 📊 Website Improvements Applied

### Performance Optimizations:

- ✅ Lazy loading on all images (except first carousel slide)
- ✅ Images compressed: 33 MB → 7.43 MB (77% reduction)
- ✅ Production assets minified with Vite

### SEO Improvements:

- ✅ Fixed missing `asset()` helper (1 image in index.blade.php)
- ✅ Descriptive alt text for all images
- ✅ Proper alt attributes for accessibility

### Code Quality:

- ✅ All images use `asset()` helper (portable)
- ✅ Consistent code style
- ✅ Production-safe database seeders

---

## 📝 Admin Login (After Seeding)

```
URL: https://your-domain.com/login
Username: keuangandn01
Password: adminkeuangan@dn1
```

**⚠️ IMPORTANT:** Change admin password after first login!

---

## 🎓 Testing for Skripsi (Cypress)

After production deployment is stable:

```bash
# Install Cypress
npm install --save-dev cypress

# Configure cypress.config.js with production URL
# Run tests and record for documentation
npm run cypress:open
```

See: Cypress testing guide (Day 9-10)

---

## 📞 Support

- **Repository:** https://github.com/BimaSandi19/notarisppatdeni
- **Backups:** `database/backups/`
- **Logs:** `storage/logs/laravel.log`

---

**Last Updated:** 2025-11-13  
**Version:** 1.0.0  
**Status:** Production Ready ✅
