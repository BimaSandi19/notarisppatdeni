# ✅ NAT VPS DEPLOYMENT CHECKLIST

## 📋 PRE-DEPLOYMENT (Local)

- [ ] Clone latest code: `git clone https://github.com/BimaSandi19/notarisppatdeni.git`
- [ ] Copy .env file: `cp .env.natvps .env`
- [ ] Update APP_KEY: `php artisan key:generate`
- [ ] Update DB credentials in .env
- [ ] Update MAIL credentials in .env
- [ ] Test locally: `php artisan serve`
- [ ] Test email: `php artisan tinker` → `Mail::raw(...)`
- [ ] Commit changes: `git add -A && git commit -m "message"`

## 🔧 SERVER SETUP (SSH to VPS)

### System & Dependencies
- [ ] SSH login successful
- [ ] Update system: `apt update && apt upgrade -y`
- [ ] Install PHP 8.2+
- [ ] Install MySQL/MariaDB
- [ ] Install Node.js 18+
- [ ] Install Composer
- [ ] Install Nginx
- [ ] Install Git

### Database
- [ ] Create database: `notarisppatdeni`
- [ ] Create user: `natvps_user`
- [ ] Grant privileges
- [ ] Test connection: `mysql -u natvps_user -p notarisppatdeni`

### Application Setup
- [ ] Create directory: `/var/www/notarisppatdeni`
- [ ] Clone repo: `git clone ...`
- [ ] Copy .env: `cp .env.natvps .env`
- [ ] Install composer: `composer install --no-dev`
- [ ] Install npm: `npm ci`
- [ ] Build assets: `npm run build`
- [ ] Generate key: `php artisan key:generate`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Run seeders: `php artisan db:seed --force`
- [ ] Set permissions: `chown -R www-data:www-data`

### Nginx Configuration
- [ ] Create nginx config file
- [ ] Enable site: `ln -s /etc/nginx/sites-available/...`
- [ ] Test config: `nginx -t`
- [ ] Restart: `systemctl restart nginx`

### SSL Certificate
- [ ] Install certbot
- [ ] Generate certificate: `certbot certonly --nginx -d domain.com`
- [ ] Enable auto-renewal
- [ ] Test renewal: `certbot renew --dry-run`

### DNS Configuration (Domainesia)
- [ ] A record: @ → VPS_IP
- [ ] A record: www → VPS_IP
- [ ] Wait 24 hours for propagation

### Cron Job (for notifications)
- [ ] Edit crontab: `crontab -e`
- [ ] Add schedule line: `* * * * * cd /var/www/... && php artisan schedule:run`

## ✅ VERIFICATION

### Application Access
- [ ] Homepage loads: https://domain.com
- [ ] Login page works: https://domain.com/login
- [ ] Admin panel accessible: https://domain.com/admin/dashboard
- [ ] No console errors in browser (F12)

### Database
- [ ] Migration successful: `php artisan migrate:status`
- [ ] Admin user exists: `php artisan tinker` → `User::count()`
- [ ] All tables created: `php artisan tinker` → `DB::table('users')->count()`

### Email
- [ ] Reset password works: Click "Lupa Password" → Enter email → Check inbox
- [ ] Email sent successfully: `tail storage/logs/laravel.log | grep -i mail`
- [ ] Test manual email: `php artisan tinker` → `Mail::raw(...)`

### Functionality Testing
- [ ] Login successful
- [ ] Create reminder: Add new tagihan
- [ ] Edit reminder: Modify existing tagihan
- [ ] Delete reminder: Remove tagihan
- [ ] Export PDF: Download works
- [ ] Export Excel: Download works
- [ ] Search/Filter: Works with AJAX
- [ ] Approve reminder: Moves to history

### Monitoring
- [ ] Check logs: `tail -50 storage/logs/laravel.log`
- [ ] No errors in logs
- [ ] Server resources OK: `htop`
- [ ] Disk space available: `df -h`
- [ ] Backups configured

## 📊 PRODUCTION CHECKLIST

- [ ] APP_DEBUG=false
- [ ] APP_ENV=production
- [ ] Strong DB password set
- [ ] Gmail App Password configured
- [ ] SSL certificate active (HTTPS working)
- [ ] Firewall rules configured (80, 443, 22 only)
- [ ] SSH key authentication enabled
- [ ] Automatic backups scheduled
- [ ] Log rotation configured
- [ ] Monitoring/alerts setup
- [ ] Database backups working
- [ ] All CRUD operations tested
- [ ] Notification flow tested
- [ ] Email sending confirmed

## 🚀 POST-DEPLOYMENT

### Day 1
- [ ] Monitor error logs
- [ ] Check email delivery
- [ ] Verify all features
- [ ] Test with real data
- [ ] Check server performance

### Week 1
- [ ] Monitor cronjob execution
- [ ] Check automatic notifications
- [ ] Verify backups
- [ ] Review server logs
- [ ] Test disaster recovery

### Monthly
- [ ] SSL certificate check
- [ ] Security updates
- [ ] Database backup verification
- [ ] Server performance review
- [ ] Disk space check

## 📞 EMERGENCY CONTACTS

- **VPS Provider:** Nat VPS (support contact)
- **Domain Provider:** Domainesia (support@domainesia.com)
- **GitHub:** BimaSandi19/notarisppatdeni
- **Email:** deninugrahakantornotaris@gmail.com

---

**Last Updated:** 2025-11-16  
**Status:** Ready for Deployment  
**Next Step:** Execute checklist items in order
