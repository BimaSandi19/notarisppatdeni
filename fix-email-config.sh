#!/bin/bash
#################################################################################
# Fix Email Reset Password - Clear Cache & Update Config
#################################################################################

echo "🔧 FIXING EMAIL CONFIGURATION"
echo "=============================="
echo ""

# Step 1: Clear ALL caches
echo "1️⃣ Clearing all Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo "✅ All caches cleared"
echo ""

# Step 2: Verify .env mail configuration
echo "2️⃣ Checking .env mail configuration..."
if grep -q "MAIL_MAILER=smtp" .env; then
    echo "✅ MAIL_MAILER=smtp"
else
    echo "❌ MAIL_MAILER not set to smtp"
fi

if grep -q "MAIL_HOST=smtp.gmail.com" .env; then
    echo "✅ MAIL_HOST=smtp.gmail.com"
else
    echo "❌ MAIL_HOST not configured"
fi

if grep -q "MAIL_PORT=587" .env; then
    echo "✅ MAIL_PORT=587"
else
    echo "❌ MAIL_PORT not configured"
fi

MAIL_USER=$(grep "^MAIL_USERNAME=" .env | cut -d'=' -f2)
if [ ! -z "$MAIL_USER" ]; then
    echo "✅ MAIL_USERNAME=$MAIL_USER"
else
    echo "❌ MAIL_USERNAME not set"
fi

MAIL_PASS=$(grep "^MAIL_PASSWORD=" .env | cut -d'=' -f2)
if [ ! -z "$MAIL_PASS" ]; then
    echo "✅ MAIL_PASSWORD=*** (${#MAIL_PASS} characters)"
else
    echo "❌ MAIL_PASSWORD not set"
fi
echo ""

# Step 3: Test mail configuration
echo "3️⃣ Testing mail configuration..."
php artisan tinker --execute="
try {
    \$config = config('mail');
    echo 'Mailer: ' . \$config['default'] . PHP_EOL;
    echo 'Host: ' . \$config['mailers']['smtp']['host'] . PHP_EOL;
    echo 'Port: ' . \$config['mailers']['smtp']['port'] . PHP_EOL;
    echo 'Username: ' . \$config['mailers']['smtp']['username'] . PHP_EOL;
    echo 'Encryption: ' . \$config['mailers']['smtp']['encryption'] . PHP_EOL;
    echo 'From Address: ' . \$config['from']['address'] . PHP_EOL;
    echo 'From Name: ' . \$config['from']['name'] . PHP_EOL;
} catch (Exception \$e) {
    echo 'Error: ' . \$e->getMessage() . PHP_EOL;
}
"
echo ""

# Step 4: Cache optimized config
echo "4️⃣ Caching optimized configuration..."
php artisan config:cache
echo "✅ Config cached"
echo ""

# Step 5: Test password reset
echo "5️⃣ Testing password reset functionality..."
echo "Run this in browser: /forgot-password"
echo "Enter email: deninugrahakantornotaris@gmail.com"
echo ""

echo "=============================="
echo "✅ FIX COMPLETE!"
echo ""
echo "If still error, check logs:"
echo "  tail -50 storage/logs/laravel.log"
echo ""
echo "To test email manually:"
echo "  php artisan tinker"
echo "  >>> Mail::raw('Test', fn(\$m) => \$m->to('test@example.com')->subject('Test'));"
echo ""
echo "Common issues:"
echo "  1. Wrong Gmail App Password → Generate new one"
echo "  2. Gmail 2FA not enabled → Enable it first"
echo "  3. Less secure apps blocked → Use App Password"
echo "  4. Port blocked → Check firewall (587 or 465)"
echo "=============================="
