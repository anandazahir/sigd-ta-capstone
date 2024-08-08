<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class UpdateUsersAnnually extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-users-annually';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users annually where jumlah_pengajuan is 0';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Update users logic
        $users = User::where('jumlah_cuti', '=', 0)->get();
        foreach ($users as $user) {
            $user->update(['jumlah_pengajuan' => 12]);
        }

        $this->info('Users updated successfully.');
    }
}
