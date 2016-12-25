<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class ListsAccessTest extends TestCase
{
    /**
     * Admin can access lists.
     *
     * @return void
     */
    public function testAdminAccess()
    {
    	$this->seed('UsersTableSeeder');
        $admin = User::where('username', '=', 'admin')->first();

        $this->actingAs($admin)
            ->get(URL::route('lists-index'))
            ->assertResponseOk()
            ->get(URL::action('DiseaseController@index'))
            ->assertResponseOk()
            ->get(URL::action('DiseaseTypeController@index'))
            ->assertResponseOk();
    }

    /**
     * Admin can see lists link in navbar.
     *
     * @return void
     */
    public function testAdminListsLinkVisibility()
    {
    	$this->seed('UsersTableSeeder');
        $admin = User::where('username', '=', 'admin')->first();

        $this->actingAs($admin)
        	->visit(URL::route('home'))
        	->see('Справочники');
    }

    /**
     * User can't see lists link in navbar.
     *
     * @return void
     */
    public function testUserListsLinkVisibility()
    {
    	$this->seed('UsersTableSeeder');
        $user = User::where('username', '=', 'user')->first();

        $this->actingAs($user)
        	->visit(URL::route('home'))
        	->dontsee('Справочники');
    }

    /**
     * User can't access lists.
     *
     * @return void
     * 
     */
    public function testUserAccess()
	{
		$this->seed('UsersTableSeeder');
	    $user = User::where('username', '=', 'user')->first();

	    $this->actingAs($user)
	        ->get(URL::route('lists-index'))
	        ->assertResponseStatus(403)
	        ->get(URL::action('DiseaseController@index'))
            ->assertResponseStatus(403)
            ->get(URL::action('DiseaseTypeController@index'))
            ->assertResponseStatus(403);
	}
}
