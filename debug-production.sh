#!/bin/bash
#################################################################################
# Script untuk debug 500 errors di production Sevalla
# Jalankan di SSH terminal Sevalla
#################################################################################

echo "🔍 DEBUGGING PRODUCTION ERRORS"
echo "================================"
echo ""

echo "1️⃣ Checking Laravel error logs (last 50 lines):"
echo "------------------------------------------------"
tail -50 storage/logs/laravel.log
echo ""

echo "2️⃣ Checking Laravel log file size:"
echo "-----------------------------------"
ls -lh storage/logs/laravel.log
echo ""

echo "3️⃣ Checking if Reminder table exists:"
echo "--------------------------------------"
php artisan tinker --execute="echo count(\App\Models\Reminder::all()) . ' reminders found';"
echo ""

echo "4️⃣ Checking if History table exists:"
echo "-------------------------------------"
php artisan tinker --execute="echo count(\App\Models\History::all()) . ' history records found';"
echo ""

echo "5️⃣ Testing AdminController@reminder method:"
echo "--------------------------------------------"
php artisan tinker --execute="(new \App\Http\Controllers\AdminController())->reminder(new \Illuminate\Http\Request());"
echo ""

echo "6️⃣ Checking view files exist:"
echo "------------------------------"
if [ -f "resources/views/admin/reminder.blade.php" ]; then
    echo "✅ reminder.blade.php EXISTS"
else
    echo "❌ reminder.blade.php MISSING"
fi

if [ -f "resources/views/admin/history.blade.php" ]; then
    echo "✅ history.blade.php EXISTS"
else
    echo "❌ history.blade.php MISSING"
fi
echo ""

echo "7️⃣ Checking database connection:"
echo "---------------------------------"
php artisan db:show
echo ""

echo "8️⃣ Checking .env APP_KEY set:"
echo "------------------------------"
if grep -q "APP_KEY=base64:" .env; then
    echo "✅ APP_KEY is configured"
else
    echo "❌ APP_KEY is missing or invalid"
fi
echo ""

echo "9️⃣ Checking storage permissions:"
echo "---------------------------------"
ls -ld storage/logs
ls -l storage/logs/laravel.log 2>/dev/null || echo "No laravel.log file yet"
echo ""

echo "🔟 Clearing all caches:"
echo "----------------------"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo "✅ All caches cleared"
echo ""

echo "================================"
echo "✅ Debug complete!"
echo ""
echo "Next steps:"
echo "1. Review error logs above"
echo "2. If tables are empty, run: php artisan db:seed --force"
echo "3. If views missing, check deployment script copied them"
echo "4. Try accessing /admin/reminder again"
