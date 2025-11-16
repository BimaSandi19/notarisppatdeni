# 🚀 NAT VPS DEPLOYMENT GUIDE
# Website Notaris Deni Nugraha
# Domain: [Your domain from Domainesia]

## 📋 PREREQUISITE CHECKLIST

- [ ] Nat VPS account aktif
- [ ] SSH access siap (username, password/key)
- [ ] Domain dari Domainesia
- [ ] DNS sudah pointing ke Nat VPS IP
- [ ] Gmail App Password sudah di-generate
- [ ] SSL Certificate (Nat VPS biasanya provide Let's Encrypt free)

## 📦 SERVER REQUIREMENTS

**Minimum:**
- PHP 8.2+
- MySQL 5.7+ atau MariaDB 10.3+
- Node.js 18+
- Composer
- Git
- OpenSSL (for SSL)

**Optimal (Recommended by Nat VPS):**
- PHP 8.3
- MySQL 8.0
- Node.js 20 LTS
- 2GB+ RAM
- 20GB+ SSD storage

---

## 🔧 SETUP STEPS

### STEP 1: Login ke Nat VPS via SSH

```bash
# Using password
ssh root@your_vps_ip
# Then enter password

# Using SSH key (if available)
ssh -i /path/to/key root@your_vps_ip
```

### STEP 2: Update System & Install Dependencies

```bash
# Update system
apt update && apt upgrade -y

# Install basic tools
apt install -y curl wget git vim htop

# Install PHP 8.2 (or latest)
apt install -y php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-mbstring \
  php8.2-xml php8.2-curl php8.2-zip php8.2-bcmath php8.2-gd php8.2-intl

# Install MySQL
apt install -y mysql-server mysql-client

# Install Node.js & npm
curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
apt install -y nodejs

# Install Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Nginx
apt install -y nginx

# Verify installations
php -v
node -v
npm -v
composer -v
mysql --version
nginx -v
```

### STEP 3: Configure Database

```bash
# Login ke MySQL
mysql -u root -p

# Create database
CREATE DATABASE notarisppatdeni;
CREATE USER 'natvps_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON notarisppatdeni.* TO 'natvps_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### STEP 4: Clone Repository & Setup Application

```bash
# Create application directory
mkdir -p /var/www/notarisppatdeni
cd /var/www/notarisppatdeni

# Clone repository
git clone https://github.com/BimaSandi19/notarisppatdeni.git .
# atau
git clone https://github.com/BimaSandi19/notarisppatdeni.git .

# Copy environment file
cp .env.natvps .env

# Edit .env with your values
nano .env
```

**Update these in .env:**
```env
APP_URL=https://your-domain.com

DB_HOST=localhost
DB_DATABASE=notarisppatdeni
DB_USERNAME=natvps_user
DB_PASSWORD=your_secure_password

MAIL_USERNAME=deninugrahakantornotaris@gmail.com
MAIL_PASSWORD=your_gmail_app_password
```

**Generate APP_KEY:**
```bash
php artisan key:generate
```

### STEP 5: Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

### STEP 6: Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed --force
# or use deployment script
chmod +x deploy-natvps.sh
./deploy-natvps.sh
```

### STEP 7: Configure Nginx

Create `/etc/nginx/sites-available/notarisppatdeni`:

```nginx
server {
    listen 80;
    listen [::]:80;
    
    server_name your-domain.com www.your-domain.com;
    root /var/www/notarisppatdeni/public;
    
    index index.php index.html;
    
    # Redirect HTTP to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    
    server_name your-domain.com www.your-domain.com;
    root /var/www/notarisppatdeni/public;
    
    index index.php index.html;
    
    # SSL Certificates (Let's Encrypt via Certbot)
    ssl_certificate /etc/letsencrypt/live/your-domain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/your-domain.com/privkey.pem;
    
    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    
    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml text/javascript 
               application/json application/javascript application/xml+rss 
               application/rss+xml font/truetype font/opentype 
               application/vnd.ms-fontobject image/svg+xml;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
    
    # Cache busting for assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
```

**Enable site:**
```bash
ln -s /etc/nginx/sites-available/notarisppatdeni /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test Nginx config
nginx -t

# Restart Nginx
systemctl restart nginx
```

### STEP 8: Setup SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
apt install -y certbot python3-certbot-nginx

# Generate certificate
certbot certonly --nginx -d your-domain.com -d www.your-domain.com

# Auto-renewal (should be automatic)
systemctl enable certbot.timer
systemctl start certbot.timer

# Test renewal
certbot renew --dry-run
```

### STEP 9: Setup PHP-FPM

```bash
# Edit PHP-FPM pool config
nano /etc/php/8.2/fpm/pool.d/www.conf

# Key settings to check:
# user = www-data
# group = www-data
# listen = /run/php/php8.2-fpm.sock
# listen.owner = www-data
# listen.group = www-data

# Restart PHP-FPM
systemctl restart php8.2-fpm
```

### STEP 10: Setup File Permissions

```bash
# Set ownership
chown -R www-data:www-data /var/www/notarisppatdeni

# Set permissions
chmod -R 755 /var/www/notarisppatdeni
chmod -R 775 /var/www/notarisppatdeni/storage
chmod -R 775 /var/www/notarisppatdeni/bootstrap/cache

# Make storage writable for logs
chmod -R 777 /var/www/notarisppatdeni/storage/logs
```

### STEP 11: Setup Cron Job (untuk notifikasi otomatis)

```bash
# Edit crontab
crontab -e

# Add this line:
* * * * * cd /var/www/notarisppatdeni && php artisan schedule:run >> /dev/null 2>&1
```

### STEP 12: DNS Configuration (Domainesia)

1. Login ke Domainesia dashboard
2. Manage domain → DNS Management
3. Add DNS records:

```
Type    Name    Value                  TTL
A       @       your_vps_ip           3600
A       www     your_vps_ip           3600
CNAME   mail    your_vps_ip           3600
```

**Wait 24 hours for DNS propagation** (usually faster, 1-2 hours)

---

## ✅ TESTING & VERIFICATION

### Test 1: Check HTTP/HTTPS

```bash
curl -I https://your-domain.com
# Should return: HTTP/2 200
```

### Test 2: Check Application

```bash
# Homepage
curl https://your-domain.com

# Login page
curl https://your-domain.com/login

# Admin dashboard (need login)
curl -b "session=xxx" https://your-domain.com/admin/dashboard
```

### Test 3: Check Logs

```bash
tail -50 /var/www/notarisppatdeni/storage/logs/laravel.log
# Should show no errors
```

### Test 4: Database Connection

```bash
cd /var/www/notarisppatdeni

php artisan tinker
>>> DB::connection()->getPdo();
# Should return PDO object (success)
>>> User::count();
# Should return number of users
>>> exit
```

### Test 5: Email Configuration

```bash
php artisan tinker
>>> use Illuminate\Support\Facades\Mail;
>>> Mail::raw('Test email', fn($m) => $m->to('deninugrahakantornotaris@gmail.com')->subject('Test'));
# Should work without error (check email in 1-2 minutes)
>>> exit
```

### Test 6: Reset Password Flow

1. Open browser: https://your-domain.com/forgot-password
2. Enter email: deninugrahakantornotaris@gmail.com
3. Click "Kirim Link Reset"
4. Check email for reset link
5. Click link and reset password
6. Try login with new password

---

## 🚀 DEPLOYMENT USING SCRIPT

After first setup, for future deployments:

```bash
cd /var/www/notarisppatdeni
git pull origin master
chmod +x deploy-natvps.sh
./deploy-natvps.sh
```

---

## 📊 MONITORING & MAINTENANCE

### View Logs

```bash
# Real-time log monitoring
tail -f /var/www/notarisppatdeni/storage/logs/laravel.log

# Check errors
grep -i error /var/www/notarisppatdeni/storage/logs/laravel.log | tail -20
```

### Check Server Status

```bash
# CPU & Memory
htop

# Disk usage
df -h /var/www/notarisppatdeni

# PHP-FPM status
systemctl status php8.2-fpm

# Nginx status
systemctl status nginx

# MySQL status
systemctl status mysql
```

### Backup Database

```bash
# Daily backup
mysqldump -u natvps_user -p notarisppatdeni > /var/backups/notarisppatdeni_$(date +%Y%m%d).sql

# Add to crontab for automatic backup
0 2 * * * mysqldump -u natvps_user -p'password' notarisppatdeni > /var/backups/notarisppatdeni_$(date +\%Y\%m\%d).sql
```

---

## 🔐 SECURITY CHECKLIST

- [ ] SSH key authentication enabled (disable password)
- [ ] Firewall rules: Allow only 80, 443, 22 (SSH)
- [ ] Strong MySQL password set
- [ ] Gmail App Password secure
- [ ] .env file NOT readable from web
- [ ] storage/ directory writable by PHP but not executable
- [ ] Backups configured
- [ ] SSL certificate auto-renewal enabled
- [ ] Laravel debug mode OFF (APP_DEBUG=false)
- [ ] Regular security updates (apt update && apt upgrade)

---

## 🆘 TROUBLESHOOTING

### Issue: 502 Bad Gateway

```bash
# Check PHP-FPM
systemctl restart php8.2-fpm
systemctl status php8.2-fpm

# Check Nginx
nginx -t
systemctl restart nginx
```

### Issue: 500 Internal Server Error

```bash
tail -50 /var/www/notarisppatdeni/storage/logs/laravel.log
# Check error message and fix accordingly
```

### Issue: Database Connection Error

```bash
# Check MySQL running
systemctl status mysql

# Check .env DB credentials
cat /var/www/notarisppatdeni/.env | grep DB_

# Test connection
mysql -h localhost -u natvps_user -p notarisppatdeni -e "SELECT 1"
```

### Issue: Email Not Sending

```bash
php artisan tinker
>>> config('mail')
# Verify settings
>>> Mail::raw('Test', fn($m) => $m->to('test@test.com')->subject('Test'));
# Check error message
```

---

## 📞 SUPPORT

**GitHub:** https://github.com/BimaSandi19/notarisppatdeni  
**Admin Credentials:** keuangandn01 / adminkeuangan@dn1

---

**Created:** 2025-11-16  
**Version:** 1.0  
**Status:** Production Ready
