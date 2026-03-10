<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateNewUserStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-new-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user status from baru to aktif after 1 week of approval';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = User::where('status', 'baru')
            ->whereNotNull('email_verified_at')
            ->where('email_verified_at', '<=', now()->subWeek())
            ->update(['status' => 'aktif']);

        $this->info("Updated {$count} user(s) from 'baru' to 'aktif'.");

        return self::SUCCESS;
    }
}
