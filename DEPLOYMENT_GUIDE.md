# 🚀 Panduan Lengkap Deployment Sevalla

## ✅ Langkah-Langkah Setelah Deployment

### 1️⃣ **Build Vite Assets (WAJIB!)**

Setelah deployment berhasil, SSH ke container Sevalla dan jalankan:

```bash
cd /app
npm run build
```

**Apa yang dilakukan:**
- Compile CSS dari `resources/css/app.css` → `public/build/assets/app-[hash].css`
- Compile JS dari `resources/js/app.js` → `public/build/assets/app-[hash].js`
- Generate manifest.json untuk asset loading
- Fix icon tidak tampil (Iconify)
- Fix CSS tidak muncul
- Fix JavaScript tidak jalan

**Output yang benar:**
```
✓ built in 5.23s
✓ 4 modules transformed.
✓ public/build/manifest.json
✓ public/build/assets/app-[hash].css
✓ public/build/assets/app-[hash].js
```

---

### 2️⃣ **Seed Database (untuk Login Admin)**

Jalankan seeder untuk membuat user admin:

```bash
php artisan db:seed --force
```

**Credentials Admin:**
- **Username:** `keuangandn01`
- **Password:** `adminkeuangan@dn1`
- **Email:** `deninugrahakantornotaris@gmail.com`

---

### 3️⃣ **Clear & Optimize Cache**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

---

### 4️⃣ **Test Website**

Akses website Anda:
- **Public:** https://notarisppatdeni.sevalla.app
- **Admin Login:** https://notarisppatdeni.sevalla.app/login

**Checklist:**
- [ ] CSS tampil dengan benar
- [ ] Icon Iconify muncul (di header, footer, buttons)
- [ ] Google Maps di footer tampil
- [ ] JavaScript bekerja (carousel, back-to-top button)
- [ ] Bisa login admin dengan credentials di atas
- [ ] Images tampil semua

---

## 📘 Penjelasan File `deploy-sevalla.sh`

### Apa itu `deploy-sevalla.sh`?

File ini adalah **automated deployment script** yang menjalankan semua langkah deployment secara otomatis.

### Isi Script:

```bash
#!/bin/bash

# 1. Install Composer Dependencies
composer install --no-dev --optimize-autoloader

# 2. Install NPM Dependencies
npm ci --omit=dev

# 3. Build Vite Assets (CSS, JS, Icons)
npm run build

# 4. Clear All Caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 5. Run Database Migrations
php artisan migrate --force

# 6. Seed Database (jika diinginkan)
# php artisan db:seed --force

# 7. Create Storage Symlink
php artisan storage:link

# 8. Optimize Application
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 9. Set File Permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
```

### Cara Menggunakan:

**Opsi 1: Manual di SSH Terminal**
```bash
bash deploy-sevalla.sh
```

**Opsi 2: Otomatis di Sevalla Build Command (RECOMMENDED)**

Di **Sevalla Dashboard → Settings → Build & Deploy:**

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan storage:link
```

**Post-Deploy Command:**
```bash
php artisan migrate --force && php artisan optimize
```

Dengan setting ini, setiap kali Anda `git push`, Sevalla akan:
1. Install dependencies
2. Build assets
3. Run migrations
4. Optimize aplikasi

---

## 🔧 Troubleshooting

### Problem: Icon tidak tampil

**Penyebab:**
- Vite assets belum di-build
- Iconify script tidak terload

**Solusi:**
```bash
npm run build
php artisan optimize
```

Cek di browser DevTools (F12) → Network tab:
- Pastikan `https://code.iconify.design/2/2.0.0/iconify.min.js` loaded
- Pastikan `public/build/assets/app-[hash].css` loaded

---

### Problem: CSS tidak tampil

**Penyebab:**
- Asset path menggunakan relative path bukan `{{ asset() }}`
- Vite belum build

**Solusi:**
1. Pastikan semua link CSS pakai `{{ asset('css/style.css') }}`
2. Jalankan `npm run build`
3. Check di browser: View Source → cari `<link>` tag
4. Pastikan path CSS benar: `/css/style.css` atau `/build/assets/app-xxx.css`

---

### Problem: Google Maps tidak tampil di footer

**Penyebab:**
- JavaScript error (check console F12)
- Network blocking iframe

**Solusi:**
1. Buka DevTools (F12) → Console
2. Lihat error messages
3. Pastikan tidak ada CSP (Content Security Policy) blocking
4. Cek Network tab untuk iframe request

Jika ada error CSP, tambahkan di `SecurityHeaders.php`:
```php
'frame-src' => "'self' https://www.google.com",
```

---

### Problem: Tidak bisa login admin

**Penyebab:**
- Database belum di-seed
- Session driver issue

**Solusi:**
```bash
# Seed database
php artisan db:seed --force

# Cek session configuration
php artisan tinker
>>> config('session.driver')  // harus: "database"
>>> DB::table('sessions')->count()  // cek sessions table exists

# Test login
# Username: keuangandn01
# Password: adminkeuangan@dn1
```

---

### Problem: Error 500 setelah deployment

**Penyebab:**
- Environment variables tidak lengkap
- APP_KEY tidak set

**Solusi:**
1. Cek Sevalla Dashboard → Environment Variables
2. Pastikan `APP_KEY` ada dan dimulai dengan `base64:`
3. Pastikan `DB_*` credentials benar
4. Jalankan:
```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize
```

---

## 📋 Post-Deployment Checklist

Setelah setiap deployment, pastikan:

- [ ] Jalankan `npm run build` di SSH
- [ ] Jalankan `php artisan optimize`
- [ ] Clear browser cache (Ctrl+Shift+R)
- [ ] Test homepage: CSS, icon, images
- [ ] Test admin login
- [ ] Test semua menu: Service, About, Gallery
- [ ] Test responsive design (mobile view)
- [ ] Check console errors (F12)
- [ ] Test Google Maps di footer
- [ ] Test contact form (jika ada)
- [ ] Check back-to-top button

---

## 🔄 Workflow Development ke Production

### Local Development:
```bash
# 1. Buat perubahan di local
# 2. Test di local
npm run dev
php artisan serve

# 3. Commit changes
git add .
git commit -m "Your commit message"
git push origin master
```

### Automatic Deployment:
Sevalla akan otomatis:
1. Pull dari GitHub
2. Run build commands
3. Deploy aplikasi

### Manual Steps di Production:
```bash
# SSH ke Sevalla container
php artisan migrate --force  # jika ada migration baru
npm run build                 # rebuild assets
php artisan optimize          # optimize cache
```

---

## 💡 Best Practices

1. **Selalu build assets di production:**
   ```bash
   npm run build  # BUKAN npm run dev
   ```

2. **Optimize Laravel di production:**
   ```bash
   php artisan optimize
   ```

3. **Jangan commit node_modules atau vendor:**
   - Sudah ada di `.gitignore`

4. **Environment-specific config:**
   - Local: `.env` dengan `APP_ENV=local`, `APP_DEBUG=true`
   - Production: Sevalla env vars dengan `APP_ENV=production`, `APP_DEBUG=false`

5. **Database backup:**
   ```bash
   # Di Sevalla SSH
   mysqldump -h $DB_HOST -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > backup.sql
   ```

6. **Monitor logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

---

## 🆘 Quick Command Reference

```bash
# Assets
npm run build              # Build production assets
npm run dev                # Build development assets (local only)

# Cache
php artisan optimize        # Cache everything
php artisan config:clear    # Clear config cache
php artisan cache:clear     # Clear application cache
php artisan route:clear     # Clear route cache
php artisan view:clear      # Clear compiled views

# Database
php artisan migrate --force      # Run migrations
php artisan db:seed --force      # Seed database
php artisan migrate:fresh --seed # Fresh migration + seed (DANGER!)

# Storage
php artisan storage:link    # Create storage symlink

# Debug
php artisan tinker          # Interactive shell
php artisan about           # Show app info
tail -f storage/logs/laravel.log  # Watch logs
```

---

## 📞 Support

Jika masih ada masalah:
1. Cek runtime logs di Sevalla Dashboard
2. SSH ke container dan cek `storage/logs/laravel.log`
3. Buka DevTools (F12) di browser untuk check console errors
4. Test dengan Incognito/Private mode (untuk rule out cache issues)

---

**Last Updated:** 16 November 2025
