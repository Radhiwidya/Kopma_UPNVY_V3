<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashUserPasswords extends Command
{
    protected $signature = 'hash:user-passwords';
    protected $description = 'Hash semua password user yang belum di-hash';

    public function handle()
    {
        $users = User::all();
        $no = 1;

        foreach ($users as $user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();

                $this->info("Baris {$no} berhasil di-hash");
            } else {
                $this->line("Baris {$no} sudah ter-hash");
            }

            $no++;
        }

        $this->info('Semua password selesai diproses!');
    }
}