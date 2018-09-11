<?php

namespace Modules\User\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\User\Http\Controllers\UserController;

class UserControllerTest extends TestCase
{
    /**
     * 
     * @Test
     * 
     * Test all users can be retrieved
     * 
     */
    public function test_all_users_can_be_retrieved() {
        
        // Make users
        $users = [
            'username'=>"someuser",
            'email'=>"someuser@email.com",
            'password'=>"somepass"
        ];

        // Mock service
        // $service = $this->getMockBuilder('\Modules\User\Services\UserService')->set->getMock();

        $service = $this->createMock('\Modules\User\Services\UserService');

        // dd($service);
        // Setup mock
        $service->expects($this->once())->method('getAllUsers')->will($this->returnValue($users));

        // Call controller method
        $controller = new UserController($service);

        // Action
        $val = $controller->getAll();

        // Assert
        $this->assertEquals($val, $users);
    }

    /**
     * 
     * @Test
     * 
     * Test user can be created
     * 
     */
    public function test_user_can_be_created() {

        // $_REQUEST
        $request = new \Illuminate\Http\Request();

        $request->request->add([
            'username'=>$this->faker->userName,
            'email'=> $this->faker->email,
            'password'=> $this->faker->password
        ]);

        // Mock service
        $service = $this->createMock('\Modules\User\Services\UserService');

        $service->expects($this->once())->method('createSingleUser')->with($request)->will($this->returnValue($request));

        // call controller method
        $controller = new UserController($service);

        // Action
        $val = $controller->createSingleUser($request);

        // Assert
        $this->assertEquals($val, $request);
    }
}
