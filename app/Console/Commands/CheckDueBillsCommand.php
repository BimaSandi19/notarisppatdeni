<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Reminder;
use App\Mail\DueBillNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckDueBillsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bills:check-due {--test : Run in test mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for bills due tomorrow and send email notifications to admins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isTest = $this->option('test');

        if ($isTest) {
            $this->info('🧪 Running in TEST MODE...');
            $this->newLine();
        }

        // Hitung tanggal besok (H-1 sebelum jatuh tempo)
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $this->info('🔍 Checking bills due on: ' . $tomorrow);

        // Query tagihan yang jatuh tempo besok (status masih Pending)
        $dueBills = Reminder::where('status_pembayaran', 'Pending')
            ->whereDate('tanggal_tagihan', $tomorrow)
            ->orderBy('nominal_tagihan', 'desc')
            ->get();

        $count = $dueBills->count();

        if ($count === 0) {
            $this->info('✅ No bills due tomorrow. No emails sent.');
            return 0;
        }

        $this->info("📋 Found {$count} bill(s) due tomorrow:");
        $this->newLine();

        // Display bills in console
        foreach ($dueBills as $bill) {
            $this->line("  • {$bill->nama_nasabah} - {$bill->nomor_kwitansi} - Rp " . number_format($bill->nominal_tagihan, 0, ',', '.'));
        }

        $this->newLine();

        // Get all admin users
        $admins = User::all();

        if ($admins->isEmpty()) {
            $this->error('❌ No admin users found in database!');
            return 1;
        }

        $this->info("📧 Sending notifications to {$admins->count()} admin(s)...");
        $this->newLine();

        $successCount = 0;
        $failCount = 0;

        foreach ($admins as $admin) {
            try {
                // Kirim email ke admin
                Mail::to($admin->email)->send(new DueBillNotification($dueBills, $admin));

                $this->line("  ✅ Email sent to: {$admin->nama} ({$admin->email})");
                $successCount++;
            } catch (\Exception $e) {
                $this->error("  ❌ Failed to send email to: {$admin->email}");
                $this->error("     Error: " . $e->getMessage());
                $failCount++;
            }
        }

        $this->newLine();
        $this->info("📊 Summary:");
        $this->line("  • Bills found: {$count}");
        $this->line("  • Emails sent successfully: {$successCount}");
        if ($failCount > 0) {
            $this->line("  • Emails failed: {$failCount}");
        }

        if ($isTest) {
            $this->newLine();
            $this->warn('⚠️  This was a TEST run. In production, this will run automatically at 09:00 AM daily.');
        }

        $this->newLine();
        $this->info('✅ Command completed successfully!');

        return 0;
    }
}
