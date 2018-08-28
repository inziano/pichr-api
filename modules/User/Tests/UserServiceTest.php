<?php

namespace Modules\User\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\User\Services\UserService;

class UserServiceTest extends TestCase
{
    // Var
    private $userRepo;

    public function setUp() {

        // Build mock of user repository
        $this->userRepo = $this->getMockBuilder('\Moddules\User\Repositories\UserRepository')->getMock();
    }
    /**
     * 
     * @Test
     * 
     * Test can return a response of all users
     * 
     */
    public function test_can_return_all_users() {

        // Generate random values
        $users = [
            'username' => "username",
            'email' => "username@email.com",
            'password' => "2jas9u2"
        ];

        // Mock the repository class
        $repository = $this->getMockBuilder('\Modules\User\Repositories\UserRepository')->getMock();

        $repository->expects($this->once())->method('getAllUsers')->will($this->returnValue($users));

        // Call the method
        $service = new UserService($repository);

        // Action
        $val = $service ->getAllUsers();

        // Assert
        $this->assertEquals($val, $users);
    }

    /**
     * 
     * @Test
     * 
     * Test that a single user can be retrieved
     * 
     */
    public function test_can_return_single_user() {

        $id = 1;

        $user = [
            'username'=> "username",
            'email'=>"username@email.com",
            'password'=> "23ndkckek"
        ];

        // Mock the repository
        $repository = $this->getMockBuilder('\Modules\User\Repositories\UserRepository')->getMock();

        $repository->expects($this->once())->method('getSingleUser')->with($id)->will($this->returnVAlue($user));

        // Call the service
        $service = new UserService($repository);

        // Action
        $val = $service->getSingleUser($id);

        // Assert
        $this->assertEquals($val,$user);

    }
   
}
