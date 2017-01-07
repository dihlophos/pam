<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);

        $admin = User::firstOrNew(['username' => 'admin']);
        $admin->displayname = 'Admin';
        $admin->email = 'admin@pam.ru';
        $admin->password = bcrypt(config('seeding.userpasswords.admin'));
        $adminrole = Role::where('name','=','Администратор')->first();
        $admin->role()->associate($adminrole);
        $admin->save();

        $user = User::firstOrNew(['username' => 'user']);
        $user->displayname = 'User';
        $user->email = 'user@pam.ru';
        $user->password = bcrypt(config('seeding.userpasswords.user'));
        $userrole = Role::where('name','=','Сотрудник')->first();
        $user->role()->associate($userrole);
        $user->save();
    }
}
