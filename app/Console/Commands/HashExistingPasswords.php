<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    protected $signature = 'hash:passwords';
    protected $description = 'Hash existing passwords in tb_user table if not hashed';

    public function handle()
    {
        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Cek apakah password belum di-hash (contohnya dengan mengecek panjang string)
            if (strlen($user->password) < 60) { // Panjang hash bcrypt adalah 60 karakter
                // Update password yang belum di-hash
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info('Password for user ' . $user->email . ' has been hashed.');
            }
        }

        $this->info('All passwords have been processed.');
    }
}
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'app:hash-existing-passwords';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Command description';

//     /**
//      * Execute the console command.
//      */
//     public function handle()
//     {
//         //
//     }
// }
