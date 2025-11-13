<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--output= : Custom output filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database to SQL file before deployment or maintenance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🗄️  Starting Database Backup...");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

        // Get database configuration
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        // Generate filename
        $timestamp = Carbon::now()->format('Y-m-d_His');
        $filename = $this->option('output')
            ? $this->option('output')
            : "backup_{$dbName}_{$timestamp}.sql";

        // Backup directory
        $backupDir = database_path('backups');

        // Create backup directory if not exists
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
            $this->info("✓ Created backup directory: {$backupDir}");
        }

        $backupPath = "{$backupDir}/{$filename}";

        // Check if mysqldump is available
        if ($this->checkMysqldump()) {
            $this->backupWithMysqldump($dbHost, $dbPort, $dbUser, $dbPass, $dbName, $backupPath);
        } else {
            $this->warn("⚠️  mysqldump not found, using PHP native backup (slower)");
            $this->backupWithPHP($backupPath);
        }

        // Verify backup file
        if (File::exists($backupPath)) {
            $fileSize = File::size($backupPath);
            $this->newLine();
            $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->info("✅ Backup Successful!");
            $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->table(
                ['Detail', 'Value'],
                [
                    ['Database', $dbName],
                    ['File', $filename],
                    ['Path', $backupPath],
                    ['Size', $this->formatBytes($fileSize)],
                    ['Created', Carbon::now()->format('Y-m-d H:i:s')],
                ]
            );

            // Show restore instructions
            $this->newLine();
            $this->comment("📝 To restore this backup, run:");
            $this->comment("   mysql -u {$dbUser} -p {$dbName} < {$backupPath}");
            $this->newLine();
            $this->comment("Or use: php artisan db:restore {$filename}");

            return 0;
        } else {
            $this->error("❌ Backup failed! File not created.");
            return 1;
        }
    }

    /**
     * Check if mysqldump command is available
     */
    private function checkMysqldump(): bool
    {
        $command = PHP_OS_FAMILY === 'Windows' ? 'where mysqldump' : 'which mysqldump';
        exec($command, $output, $returnCode);
        return $returnCode === 0;
    }

    /**
     * Backup using mysqldump command (FAST)
     */
    private function backupWithMysqldump($host, $port, $user, $pass, $database, $outputPath)
    {
        $this->info("🚀 Using mysqldump (fast method)...");

        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s > %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($user),
            escapeshellarg($pass),
            escapeshellarg($database),
            escapeshellarg($outputPath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error("mysqldump failed with code {$returnCode}");
            $this->warn("Falling back to PHP native backup...");
            $this->backupWithPHP($outputPath);
        }
    }

    /**
     * Backup using PHP native (SLOWER but always works)
     */
    private function backupWithPHP($outputPath)
    {
        $this->info("⏳ Using PHP native backup (this may take a while)...");

        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');
        $tableKey = "Tables_in_{$dbName}";

        $sql = "-- Database Backup\n";
        $sql .= "-- Generated: " . Carbon::now()->toDateTimeString() . "\n";
        $sql .= "-- Database: {$dbName}\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        $bar = $this->output->createProgressBar(count($tables));
        $bar->start();

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;

            // Get table structure
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createTable[0]->{'Create Table'} . ";\n\n";

            // Get table data
            $rows = DB::table($tableName)->get();

            if ($rows->count() > 0) {
                $sql .= "INSERT INTO `{$tableName}` VALUES\n";
                $values = [];

                foreach ($rows as $row) {
                    $rowData = (array) $row;
                    $escaped = array_map(function ($value) {
                        return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                    }, $rowData);
                    $values[] = "(" . implode(", ", $escaped) . ")";
                }

                $sql .= implode(",\n", $values) . ";\n\n";
            }

            $bar->advance();
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        $bar->finish();
        $this->newLine();

        // Write to file
        File::put($outputPath, $sql);
    }

    /**
     * Format bytes to human-readable size
     */
    private function formatBytes($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
