<?php

namespace Modules\User\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MarcinOrlowski\ResponseBuilder\Tests\Traits\TestingHelpers;

use Modules\User\Services\UserService;

class UserServiceTest extends TestCase
{
    // Var
    private $userRepo;
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

        // Mock the responsebuilder
        $responseBuilder = $this->createMock('\MarcinOrlowski\ResponseBuilder\ResponseBuilder\Success');

        $responseBuilder->expects($this->once())->method('success')->with($users)->will($this->returnValue($users));


        // Mock the repository class
        $repository = $this->getMockBuilder('\Modules\User\Repositories\UserRepository')->getMock();

        $repository->expects($this->once())->method('getAllUsers')->will($this->returnValue($users));

        // Call the method
        $service = new UserService($repository,$responseBuilder);

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
            'username'=> $this->faker->userName,//"username",
            'email'=> $this->faker->email,//"username@email.com",
            'password'=> $this->faker->password//"23ndkckek"
        ];

        // Mock the responsebuilder
        $responseBuilder = $this->getMockBuilder('\MarcinOrlowski\ResponseBuilder\ResponseBuilder')->getMock();

        $responseBuilder->expects($this->once())->method('success')->with($user)->will($this->returnValue($user));


        // Mock the repository
        $repository = $this->getMockBuilder('\Modules\User\Repositories\UserRepository')->getMock();

        $repository->expects($this->once())->method('getSingleUser')->with($id)->will($this->returnVAlue($user));

        // Call the service
        $service = new UserService($repository, $responseBuilder);

        // Action
        $val = $service->getSingleUser($id);

        // Assert
        $this->assertEquals($val,$user);

    }

    /**
     * 
     * @Test
     * 
     * Test user can be created
     */
    public function test_can_create_single_user() {

        // Request
        $request = new \Illuminate\Http\Request();

        $request->setMethod('POST');

        $request->request->add([
            'username'=> $this->faker->userName,
            'email'=> $this->faker->email,
            'password'=>  $this->faker->password
        ]);

        // Mock the responsebuilder
        $responseBuilder = $this->getMockBuilder('\MarcinOrlowski\ResponseBuilder\ResponseBuilder')->getMock();

        $responseBuilder->expects($this->once())->method('success')->with($request)->will($this->returnValue($request));

        // Mock user repository
        $repository = $this->getMockBuilder('\Modules\User\Repositories\UserRepository')->getMock();

        $repository->expects($this->once())->method('createSingleUser')->with($request)->will($this->returnValue($request));

        // Call service
        // Call the service
        $service = new UserService($repository, $responseBuilder);

        // Action
        $val = $service->createSingleUser($request);

        // Assert
        $this->assertTrue($val===$request);

    }
   
}
