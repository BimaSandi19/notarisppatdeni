# 🚀 Sevalla Deployment Guide - Kantor Notaris Deni Nugraha

## 📋 Persiapan Sebelum Deployment

### 1. Akun dan Setup Sevalla

1. Login ke https://app.sevalla.com
2. Buat aplikasi baru:
    - Pilih **PHP** sebagai platform
    - Pilih **Laravel** sebagai framework
    - Pilih region terdekat (Singapore/Jakarta untuk performa optimal)
    - Pilih plan sesuai kebutuhan

### 2. Konfigurasi Database

Sevalla akan otomatis membuat database MySQL. Catat kredensial:

- Database Name
- Database Username
- Database Password
- Database Host

---

## 🔧 Langkah Deployment

### Step 1: Persiapkan Repository GitHub

```bash
# Pastikan semua perubahan sudah di-commit
git add .
git commit -m "Prepare for Sevalla deployment"
git push origin master
```

### Step 2: Hubungkan Sevalla dengan GitHub

1. Di Sevalla Dashboard, pilih aplikasi Anda
2. Go to **Deployment** tab
3. Connect dengan GitHub repository: `BimaSandi19/notarisppatdeni`
4. Pilih branch: `master`
5. Set deployment path: `/`

### Step 3: Konfigurasi Environment Variables

Di Sevalla Dashboard > **Environment** tab, tambahkan variabel berikut:

```env
# Application
APP_NAME="WebsiteDN"
APP_ENV=production
APP_KEY=base64:ldltM/+B6N8MRQyfGzcJr6KTaOSfOYeIePtesR8YOKs=
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://your-domain.sevalla.app

# Database (Gunakan kredensial dari Sevalla)
DB_CONNECTION=mysql
DB_HOST=<sevalla-db-host>
DB_PORT=3306
DB_DATABASE=<sevalla-db-name>
DB_USERNAME=<sevalla-db-username>
DB_PASSWORD=<sevalla-db-password>

# Queue
QUEUE_CONNECTION=database

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

# Cache
CACHE_DRIVER=file
CACHE_PREFIX=websitedn_cache

# Mail (Gmail SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=deninugrahakantornotaris@gmail.com
MAIL_PASSWORD=dluwagcxrqaqgqmb
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=deninugrahakantornotaris@gmail.com
MAIL_FROM_NAME="Kantor Notaris Deni Nugraha"

# Security
SECURE_HEADERS=true
```

### Step 4: Konfigurasi Build Commands

Di Sevalla Dashboard > **Build & Deploy** settings:

**Pre-deployment commands:**

```bash
composer install --no-dev --optimize-autoloader --no-interaction
npm ci --omit=dev
npm run build
```

**Post-deployment commands:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan migrate --force
php artisan optimize
php artisan storage:link
```

### Step 5: Setup Web Root

Di Sevalla Dashboard > **Application Settings**:

- Set document root ke: `/public`
- Enable HTTPS/SSL (Let's Encrypt)
- Set PHP version: **8.2** atau lebih tinggi

### Step 6: Konfigurasi PHP

Di Sevalla > **PHP Settings**, pastikan extension berikut aktif:

- ✅ BCMath
- ✅ Ctype
- ✅ Fileinfo
- ✅ JSON
- ✅ Mbstring
- ✅ OpenSSL
- ✅ PDO
- ✅ PDO_MySQL
- ✅ Tokenizer
- ✅ XML
- ✅ cURL
- ✅ GD
- ✅ Zip

### Step 7: Upload dan Import Database

Jika Anda memiliki data existing:

```bash
# 1. Export database lokal
mysqldump -u root website_dn > database_backup.sql

# 2. Di Sevalla Dashboard > Database > Import
# Upload file database_backup.sql
# Atau gunakan phpMyAdmin yang disediakan Sevalla
```

**Atau jalankan migrations:**

```bash
# SSH ke Sevalla server, lalu:
cd /path/to/application
php artisan migrate --force
php artisan db:seed --force
```

### Step 8: Upload Images dan Assets

Pastikan semua folder berikut ter-upload:

```
public/
├── images/
│   ├── icon/
│   ├── gallery/
│   └── *.jpg, *.jpeg, *.png
├── css/
├── js/
└── build/
```

Jika menggunakan Git, file images sudah ter-track dan akan otomatis ter-deploy.

### Step 9: Setup Storage Link

```bash
# SSH ke Sevalla server
cd /path/to/application
php artisan storage:link
```

### Step 10: Setup Cron Job (Laravel Scheduler)

Di Sevalla Dashboard > **Cron Jobs**, tambahkan:

```
* * * * * cd /path/to/application && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔐 Security Checklist

### SSL/HTTPS

- ✅ Enable SSL Certificate (Let's Encrypt) di Sevalla
- ✅ Force HTTPS redirect
- ✅ Set `APP_URL=https://your-domain.com`
- ✅ Set `SESSION_SECURE_COOKIE=true`

### File Permissions

```bash
# Jalankan via SSH
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
```

### Security Headers

File `.htaccess` sudah dikonfigurasi dengan security headers:

- X-Frame-Options
- X-Content-Type-Options
- X-XSS-Protection
- Referrer-Policy

---

## ⚡ Performance Optimization

### 1. Enable OPcache

Di Sevalla PHP Settings, enable:

- ✅ OPcache
- ✅ JIT (Just-In-Time Compilation)

### 2. Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 3. Enable Gzip Compression

Sevalla biasanya sudah enable by default, pastikan aktif di settings.

---

## 🧪 Testing Post-Deployment

### 1. Test Website

- ✅ Homepage: https://your-domain.com
- ✅ Service page: https://your-domain.com/service
- ✅ About page: https://your-domain.com/about
- ✅ Gallery page: https://your-domain.com/gallery
- ✅ Admin login: https://your-domain.com/login

### 2. Test Email

- Kirim test email dari contact form
- Verifikasi email terkirim ke: deninugrahakantornotaris@gmail.com

### 3. Test Database

- Login ke admin dashboard
- Create/Read/Update/Delete data reminder
- Export data to Excel/PDF

### 4. Check Performance

- Run Google PageSpeed Insights
- Check loading time < 3 seconds
- Verify mobile responsiveness

---

## 📊 Monitoring

### Sevalla Built-in Monitoring

1. **Application Monitoring**
    - CPU usage
    - Memory usage
    - Disk usage
    - Database connections

2. **Error Logs**
    - Check Laravel logs: `storage/logs/laravel.log`
    - Check server logs di Sevalla Dashboard

3. **Uptime Monitoring**
    - Setup uptime monitoring di Sevalla
    - Get notified jika website down

---

## 🔄 Auto-Deployment (CI/CD)

### Setup Webhook for Auto-Deploy

1. Di GitHub repository settings > Webhooks
2. Add webhook:
    - URL: `<sevalla-webhook-url>`
    - Content type: `application/json`
    - Events: Push events

3. Setiap kali push ke `master`, otomatis deploy!

```bash
# Workflow development
git add .
git commit -m "Update feature X"
git push origin master
# Sevalla akan otomatis deploy!
```

---

## 🐛 Troubleshooting

### Error: 500 Internal Server Error

```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Re-optimize
php artisan optimize
```

### Error: Database Connection Failed

- Verify DB credentials di environment variables
- Check DB host (gunakan internal IP dari Sevalla)
- Pastikan DB port 3306 accessible

### Error: Storage Link Not Working

```bash
# Remove old link
rm public/storage

# Recreate link
php artisan storage:link
```

### Error: Assets Not Loading

- Verify `APP_URL` sesuai dengan domain
- Check folder `public/build` exists
- Run `npm run build` lagi jika perlu

### Error: Email Not Sending

- Verify Gmail SMTP credentials
- Check Gmail "Less secure app access" atau gunakan App Password
- Test dengan: `php artisan tinker` → `Mail::raw('Test', function($msg) { $msg->to('test@example.com')->subject('Test'); });`

---

## 📱 Custom Domain Setup

### 1. Add Domain di Sevalla

1. Go to Application > Domains
2. Add custom domain: `notarisdeninugraha.com`
3. Catat nameserver yang diberikan Sevalla

### 2. Update DNS Records

Di domain registrar Anda (Niagahoster, GoDaddy, dll):

```
Type    Name    Value
A       @       <sevalla-ip-address>
A       www     <sevalla-ip-address>
CNAME   www     your-app.sevalla.app
```

### 3. Enable SSL

- Di Sevalla, enable Let's Encrypt SSL
- Wait 5-10 menit untuk propagasi
- Force HTTPS redirect

### 4. Update Environment

```env
APP_URL=https://notarisdeninugraha.com
SESSION_DOMAIN=.notarisdeninugraha.com
```

---

## 📞 Support & Maintenance

### Backup Strategy

1. **Database Backup** (Weekly)

    ```bash
    php artisan backup:run
    # Atau manual via Sevalla phpMyAdmin
    ```

2. **Files Backup** (Monthly)
    - Download folder `storage/app`
    - Download folder `public/images`

### Update Workflow

```bash
# Local development
git pull origin master
composer update
npm update
php artisan migrate
git add .
git commit -m "Update dependencies"
git push origin master
# Sevalla auto-deploys
```

### Contact

- Sevalla Support: https://sevalla.com/support
- Laravel Documentation: https://laravel.com/docs
- Project Repository: https://github.com/BimaSandi19/notarisppatdeni

---

## ✅ Deployment Checklist

**Pre-Launch:**

- [ ] Environment variables configured
- [ ] Database credentials correct
- [ ] SMTP email configured
- [ ] SSL certificate enabled
- [ ] Custom domain configured (optional)
- [ ] Storage linked
- [ ] Cron job setup
- [ ] File permissions set

**Post-Launch:**

- [ ] Test all pages
- [ ] Test admin login
- [ ] Test contact form
- [ ] Test email sending
- [ ] Test reminder CRUD
- [ ] Test responsive design
- [ ] Check Google PageSpeed
- [ ] Setup monitoring
- [ ] Create database backup
- [ ] Document production credentials

---

## 🎉 Selamat! Website Anda Sudah Live!

Website Kantor Notaris Deni Nugraha sekarang sudah online dan dapat diakses publik.

**Next Steps:**

1. Monitor traffic dan performance
2. Setup Google Analytics (optional)
3. Submit sitemap ke Google Search Console
4. Regular maintenance dan updates
5. Backup database secara berkala

---

**Dibuat oleh:** Deployment Assistant
**Tanggal:** November 14, 2025
**Versi:** 1.0
