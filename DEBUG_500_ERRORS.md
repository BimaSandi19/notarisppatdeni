# PANDUAN DEBUGGING 500 ERROR DI SEVALLA
# ========================================

## LANGKAH 1: Deploy ulang ke Sevalla
1. Login ke Sevalla dashboard: https://app.sevalla.com
2. Masuk ke aplikasi: notarisppatdeni
3. Klik tab "Deployment"
4. Klik "Deploy Now" (atau tunggu auto-deploy jika enabled)
5. Tunggu hingga selesai (biasanya 2-3 menit)

## LANGKAH 2: Jalankan debug script via SSH
```bash
# Login SSH (dapatkan command dari Sevalla dashboard)
ssh [user]@[server].sevalla.app

# Masuk ke folder aplikasi
cd /app

# Jalankan debug script
chmod +x debug-production.sh
./debug-production.sh
```

## LANGKAH 3: Analisa hasil debug

### Jika error "Table 'reminders' doesn't exist":
```bash
php artisan migrate --force
php artisan db:seed --force
```

### Jika error "View not found":
```bash
# Cek apakah views ter-copy
ls -la resources/views/admin/

# Jika tidak ada, re-deploy atau manual copy
```

### Jika error "Class not found" atau "Method not found":
```bash
# Clear autoload
composer dump-autoload --optimize

# Clear Laravel caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

### Jika error terkait permissions:
```bash
# Fix storage permissions
chmod -R 755 storage
chmod -R 775 storage/logs
chown -R www-data:www-data storage
```

## LANGKAH 4: Test langsung di browser
1. Buka: https://notarisppatdeni.sevalla.app/login
2. Login dengan: keuangandn01 / adminkeuangan@dn1
3. Klik menu "Reminder" atau langsung akses:
   - https://notarisppatdeni.sevalla.app/admin/reminder
   - https://notarisppatdeni.sevalla.app/admin/history
4. Buka Developer Tools (F12) → Console untuk lihat error

## LANGKAH 5: Lihat Laravel logs secara real-time
```bash
# Monitor logs live
tail -f storage/logs/laravel.log

# Atau lihat 100 baris terakhir
tail -100 storage/logs/laravel.log
```

## KEMUNGKINAN PENYEBAB 500 ERROR

### 1. Database belum di-seed
**Gejala:** Halaman error 500 tanpa data
**Solusi:**
```bash
php artisan db:seed --force
```

### 2. APP_KEY tidak set
**Gejala:** "No application encryption key has been specified"
**Solusi:**
```bash
php artisan key:generate --force
```

### 3. Views tidak ter-compile
**Gejala:** "View [admin.reminder] not found"
**Solusi:**
```bash
php artisan view:clear
php artisan view:cache
```

### 4. Autoload class tidak update
**Gejala:** "Class 'App\Models\Reminder' not found"
**Solusi:**
```bash
composer dump-autoload --optimize
```

### 5. Cache config stale
**Gejala:** Error terkait config atau routes
**Solusi:**
```bash
php artisan config:clear
php artisan route:clear
php artisan optimize
```

## QUICK FIX (All-in-one command)
```bash
cd /app
git pull origin master
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan db:seed --force
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
chmod -R 755 storage
chmod -R 775 storage/logs
```

## TEST ROUTES VIA COMMAND LINE
```bash
# Test reminder route
php artisan tinker
>>> $controller = new App\Http\Controllers\AdminController();
>>> $request = new Illuminate\Http\Request();
>>> $controller->reminder($request);

# Test if models work
>>> App\Models\Reminder::count()
>>> App\Models\History::count()
```

## CONTACT INFO
Jika masih error setelah semua langkah:
1. Screenshot error 500 page
2. Copy paste output dari: `tail -50 storage/logs/laravel.log`
3. Copy paste output dari: `debug-production.sh`
4. Kirim ke developer untuk analisa lebih lanjut
