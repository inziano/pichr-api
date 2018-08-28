<?php

namespace Modules\User\Tests;

use Tests\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;


class UserRepositoryTest extends TestCase {
    
    use RefreshDatabase;

    /**
     * 
     * Setup
     */
    public function setUp() {

        parent::setUp();

        // Run migrations
        \Artisan::call('migrate');

        // Disable eloquent guard
        \Eloquent::unguard();
    }
    /**
     * 
     * Test database has some values
     * @test
     * 
     */
    public function test_database_has_values () {

        // Call user factory to create values
        $values = factory(User::class)->create();

        // 
        // dd($values->username);

        // Check that values exist in the database
        $this->assertDatabaseHas('user',[
            'username' => $values->username,
            'email' =>$values->email
            ]);
    }

    /**
     * 
     * Test user can be created
     * @Test
     */
    public function test_user_can_be_created() {

        // New request
        $request = new \Illuminate\Http\Request();

        $request->setMethod('POST');

        $request->request->add([
            'username'=> $this->faker->userName,
            'email'=> $this->faker->email,
            'password'=> $this->faker->password
        ]);
  
        // Repository
        $this->repo = new UserRepository();

        // Save to database
        $value = $this->repo->createSingleUser($request);

        // Assert
        $this->assertTrue($value);
    }

    /**
     * Test user can be updated
     * @Test
     */
    public function test_user_can_be_updated() {
        
        // Create request
        $request = new \Illuminate\Http\Request();

        $request->setMethod('POST');

        $request->request->add([
            'username'=> 'jon'
        ]);

        // Create record in database
        $values = factory(User::class)->create();

        // dd($values);

        // Repository
        $this->repo = new UserRepository();

        // 

        // Update 
        $value = $this->repo->updateSingleUser($request,1);

        // Assert
        $this->assertEquals($value->username, 'jon');
    }

    /**
     * Test users can be retrieved
     * @Test
     * 
     */
    public function test_users_can_be_retrived() {

        // Insert couple of users 
        $users = factory(User::class, 5)->create();

        // Repository
        $this->repo = new UserRepository();

        // Get all
        $value = $this->repo->getAllUsers();

        // Assertions
        $this->assertEquals(count($value) ,5);

    }

    /**
     * 
     * @Test
     * 
     * Test single user can be retrieved
     * 
     */
    public function test_single_user_can_be_retrieved() {

        $id = 1;

        // Insert single user
        $user = factory(User::class)->make([
            'username'=> "Jon",
        ]);

        // Repo
        $this->repo = new Repository();

        // Get single user
        $value = $this->repo->getSingleUser($id);

        // Assert
        $this->assertEquals($value->id, $id);
    }

}
