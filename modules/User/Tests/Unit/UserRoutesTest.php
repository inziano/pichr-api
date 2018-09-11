<?php

namespace Modules\User\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use MarcinOrlowski\ResponseBuilder\ApiCodesHelpers;
use MarcinOrlowski\ResponseBuilder\Tests\Traits\TestingHelpers;

use Modules\User\Entities\User;

class UserRoutesTest extends TestCase
{
    // use TestingHelpers;
    /**
     * 
     * @Test
     * 
     * Test routes return json responses
     * 
     */
    public function test_routes_return_api_response() {

        // Create data
        $user = factory(User::class,10)->create();

        // Call route
        $res = $this->get('/api/user/all');

        // Get the json object
        $resj = json_decode($res->getContent());
        
        // Validate it was a success
        $this->assertTrue($resj->success);
    }
}
