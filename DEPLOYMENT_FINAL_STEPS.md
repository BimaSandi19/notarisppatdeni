# 🚀 LANGKAH DEPLOYMENT KE SEVALLA (FINAL)

## ✅ CHECKLIST DEPLOYMENT

### 📦 Persiapan (SUDAH SELESAI)
- [x] Repository GitHub: https://github.com/BimaSandi19/notarisppatdeni
- [x] Latest commits pushed (CSP fix + debug tools)
- [x] deploy-sevalla.sh script ready
- [x] .env.sevalla configured
- [x] Database seeder created (AdminSeeder)

### 🔧 LANGKAH DEPLOYMENT

#### 1. Login ke Sevalla Dashboard
```
URL: https://app.sevalla.com
Email: [your-email]
Password: [your-password]
```

#### 2. Masuk ke Aplikasi
- Pilih aplikasi: **notarisppatdeni**
- URL: https://notarisppatdeni.sevalla.app

#### 3. Deploy via Git (RECOMMENDED)
**Option A: Auto-deploy (otomatis)**
```
Settings → Deployment → Enable Auto-Deploy
Setiap git push, Sevalla akan auto-deploy (PAKAI CREDITS)
```

**Option B: Manual deploy (hemat credits)**
```
1. Buka tab "Deployment"
2. Klik "Deploy Now"
3. Tunggu proses selesai (2-3 menit)
4. Lihat log deployment untuk error
```

#### 4. Jalankan Deployment Script via SSH
```bash
# Login SSH (dapatkan command dari Sevalla dashboard)
ssh [user]@[server].sevalla.app

# Masuk ke folder aplikasi
cd /app

# Jalankan deployment script
chmod +x deploy-sevalla.sh
./deploy-sevalla.sh

# Output expected:
# ✅ Composer install success
# ✅ NPM install success
# ✅ Assets built
# ✅ Database migrated
# ✅ Admin seeder run
# ✅ Caches cleared
# ✅ Production ready!
```

#### 5. Verify Deployment
```bash
# Cek Laravel version
php artisan --version
# Expected: Laravel Framework 11.46.1

# Cek database connection
php artisan db:show

# Cek admin user exists
php artisan tinker
>>> User::where('username', 'keuangandn01')->first();
>>> exit

# Cek tables exist
php artisan tinker
>>> Reminder::count();
>>> History::count();
>>> exit
```

#### 6. Test di Browser
**Test 1: Homepage**
```
https://notarisppatdeni.sevalla.app
Expected: Homepage dengan icons dan Google Maps
```

**Test 2: Login**
```
https://notarisppatdeni.sevalla.app/login
Username: keuangandn01
Password: adminkeuangan@dn1
Expected: Redirect ke /admin/dashboard
```

**Test 3: Dashboard**
```
https://notarisppatdeni.sevalla.app/admin/dashboard
Expected: Dashboard dengan statistics
Browser Console: No CSP errors
```

**Test 4: Reminder (YANG SEKARANG ERROR 500)**
```
https://notarisppatdeni.sevalla.app/admin/reminder
Expected: Halaman list reminder (kosong jika belum ada data)
```

**Test 5: History**
```
https://notarisppatdeni.sevalla.app/admin/history
Expected: Halaman list history (kosong jika belum ada data)
```

**Test 6: Forgot Password**
```
https://notarisppatdeni.sevalla.app/forgot-password
POST email: test@example.com
Expected: Success message (even if email not exist - security)
```

### 🐛 JIKA MASIH ERROR 500

#### Debugging via SSH:
```bash
cd /app

# Run debug script
./debug-production.sh

# Manual checks:
tail -50 storage/logs/laravel.log

# Test controller manually
php artisan tinker
>>> $controller = new App\Http\Controllers\AdminController();
>>> $request = new Illuminate\Http\Request();
>>> $controller->reminder($request);
```

#### Common Fixes:

**Fix 1: Clear all caches**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan optimize
```

**Fix 2: Re-run migrations + seeders**
```bash
php artisan migrate:fresh --force
php artisan db:seed --force
```

**Fix 3: Fix permissions**
```bash
chmod -R 755 storage
chmod -R 775 storage/logs
chown -R www-data:www-data storage bootstrap/cache
```

**Fix 4: Reinstall dependencies**
```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

**Fix 5: Check environment**
```bash
# Verify .env exists and has correct values
cat .env | grep APP_KEY
cat .env | grep DB_DATABASE
cat .env | grep APP_URL

# If APP_KEY empty:
php artisan key:generate --force
```

### 📊 TESTING FUNCTIONALITY (SETELAH DEPLOY BERHASIL)

#### Test Create Reminder:
1. Login sebagai admin
2. Klik "Tambah Tagihan"
3. Isi form:
   - Nama Nasabah: PT. Test Company
   - Nomor Kwitansi: KW001
   - Tanggal Tagihan: 2025-01-15
   - Nominal: 5000000
   - Keterangan: Test tagihan
4. Klik "Simpan"
5. Expected: Success message + redirect ke /admin/reminder
6. Verify: Data muncul di list

#### Test Edit Reminder:
1. Dari list reminder, klik "Edit"
2. Ubah data (misal nama atau nominal)
3. Klik "Update"
4. Expected: Success message + data ter-update

#### Test Approve Reminder:
1. Dari list reminder, klik "Approve"
2. Expected: Data pindah dari Reminder ke History
3. Verify: Data tidak ada di /admin/reminder
4. Verify: Data muncul di /admin/history dengan status "Lunas"

#### Test Export:
1. Di /admin/history, klik "Export Excel"
2. Expected: Download file .xlsx
3. Di /admin/history, klik "Export PDF"
4. Expected: Download file .pdf

#### Test Search & Filter:
1. Di /admin/reminder, gunakan search box
2. Test sort by tanggal/nominal
3. Test pagination
4. Expected: Semua berfungsi dengan AJAX

### 🎯 KRITERIA PRODUCTION READY

- [ ] ✅ Homepage loading dengan icons + maps
- [ ] ✅ Login berhasil
- [ ] ✅ Dashboard accessible (no 500 errors)
- [ ] ✅ /admin/reminder accessible (no 500 errors)
- [ ] ✅ /admin/history accessible (no 500 errors)
- [ ] ✅ Forgot password working
- [ ] ✅ Create reminder working
- [ ] ✅ Edit reminder working
- [ ] ✅ Approve reminder working (move to history)
- [ ] ✅ Export Excel working
- [ ] ✅ Export PDF working
- [ ] ✅ Search & filter working
- [ ] ✅ No CSP errors in console
- [ ] ✅ No JavaScript errors
- [ ] ✅ Responsive design working

### 📝 NOTES

**Credentials:**
- Admin Username: `keuangandn01`
- Admin Password: `adminkeuangan@dn1`

**Important URLs:**
- Production: https://notarisppatdeni.sevalla.app
- GitHub: https://github.com/BimaSandi19/notarisppatdeni
- Sevalla Dashboard: https://app.sevalla.com

**Support Files:**
- `deploy-sevalla.sh` - Automated deployment script
- `debug-production.sh` - Production debugging tool
- `DEBUG_500_ERRORS.md` - Troubleshooting guide
- `SEVALLA_DEPLOYMENT.md` - Full deployment documentation

**Latest Changes (Commit History):**
1. Fix CSP: Allow Cloudflare CDN for jsPDF and Bootstrap
2. Add production debugging tools for 500 errors

---

## 🚨 JIKA SETELAH SEMUA LANGKAH MASIH ERROR

Kemungkinan issue:
1. **Sevalla belum pull latest code** → Manual deploy via dashboard
2. **Database credentials salah** → Check .env DB_* variables
3. **APP_KEY tidak set** → Run `php artisan key:generate --force`
4. **Storage permissions** → Run chmod commands above
5. **Composer/NPM cache** → Re-run deployment script

Kirim screenshot + output dari:
```bash
./debug-production.sh
tail -100 storage/logs/laravel.log
```
