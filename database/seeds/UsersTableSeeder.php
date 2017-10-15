<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::firstOrNew(['username' => 'admin']);
        $admin->displayname = 'Admin';
        $admin->email = 'admin@pam.ru';
        $admin->password = bcrypt(config('seeding.userpasswords.admin'));
        $admin->is_admin = true;
        $admin->save();

        $user = User::firstOrNew(['username' => 'user']);
        $user->displayname = 'User';
        $user->email = 'user@pam.ru';
        $user->password = bcrypt(config('seeding.userpasswords.user'));
        $user->save();
    }
}
