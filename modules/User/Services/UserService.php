<?php

namespace Modules\User\Services;

use App\ApiCode;
use Illuminate\Http\Response;
use Illuminate\Foundation\Application;
use \MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\User\Repositories\UserRepository;

class UserService implements UserServiceInterface {

    // Variables
    private $app;
    private $repo;
    private $api_response;
    private $apiconsumer;

    // Class constructor
    public function __construct( Application $app, UserRepository $repo, ResponseBuilder $api_response ) {

        $this->apiconsumer = $app->make('apiconsumer');

        $this->repo = $repo;

        $this->response = $api_response;
    }

    /**
     * 
     * Create Methods
     */
    // Create single user
    public function createSingleUser($request) {

        // Ensure request has all the necessary params
        // Hash password
        // Add password to request
        // Hit repo
        $user = $this->repo->createSingleUser($request);

        // Build json response
        $response = $this->response::success($user);

        // dd($response);

        // Return response
        return $response;
    }

    /**
     * 
     * Read methods
     * 
     */
    // Get all the users
    public function getAllUsers() {
        
        // Hit repo 
        $users = $this->repo->getAllUsers();

        // Build response
        $response = $this->response::success($users);

        return $response;
    }

    // Get single user
    public function getSingleUSer($id) {

        // Hit repo
        $user = $this->repo->getSingleUser($id);

        // Build response
        $response = $this->response::success($user);

        return $response;
    }

    /**
     * 
     * Authentication methods
     * 
     */
    // Login 
    public function loginAttempt($request) {
        // Check if request has email and password 
        if ( $request->has('email') && $request->has('password')) {
            // Start processing the request

            // email and password
            $email = $request->email;
            $password = $request->password;

            // pass the values to the repo
            $response = $this->repo->checkCredentials($request);

            // Check response
            switch ($response) {

                case 'ok':
                    // Call token generator
                    $access_token = $this->appTokens('password',['username'=>$email,'password'=>$password]);
                    // create response
                    $data = ["token"=> $access_token];

                    // Return response from response builder
                    return ResponseBuilder::success($data);
                    break;

                case 'password error':
                    // create response 
                    return ResponseBuilder::error(ApiCode::EMAIL_PASSWORD_MISMATCH);
                    break;

                case 'incorrect':
                    // Return response from response builder
                    return ResponseBuilder::error(ApiCode::LOGIN_ERROR);
                    break;

                default:
                    // create response 
                    return ResponseBuilder::error(ApiCode::EMAIL_PASSWORD_MISMATCH);
                    break;
            }
        } else if ( !$request->has('email') || !$request->has('password') ) {
            // Return error
            return ResponseBuilder::error(ApiCode::EMAIL_PASSWORD_MISSING);

        } else {
            // Neither email or password.
            return ResponseBuilder::error(ApiCode::MISSING_CREDENTIALS);
        }
         
    }

    // Generate token based on username--password combination
    public function appTokens($type, array $data =[]) {
        $data = array_merge($data,
        [
            'client_id'=> env('CLIENT_ID'),
            'client_secret'=> env('CLIENT_SECRET'),
            'grant_type'=> $type
        ]);

        // Push to oauth/login
        $response = $this->apiconsumer->post('/oauth/token',$data);

        //If oauth fails
        if(!$response->isSuccessful()) {
            return $response;
        }

        $payload = $response->getContent();

        $data = json_decode($payload);

        return $payload;
    }

    // Register single user
    public function registerUser( $request ) {
        // Send to repository
        $response = $this->repo->createSingleUser($request);

        // Email and password 
        $email = $request->email;
        $password = $request->password;

        // Build response 
        switch($response) {
            // User created
            case 'ok':
                 // Call token generator
                 $access_token = $this->appTokens('password',['username'=>$email,'password'=>$password]);
                 // create response
                 $data = ["token"=> $access_token];
                //  Return response plus key
                return ResponseBuilder::success($data);
                break;

            // User already exists on system
            case 'email exists':
                return ResponseBuilder::error(ApiCode::EMAIL_EXISTS);
                break;
            
            // Username exists
            case 'username exists':
                return ResponseBuilder::error(ApiCode::USERNAME_EXISTS);
                break;
            
            // Both email and username exist
            case 'username and email exist':
                return ResponseBuilder::error(ApiCode::USERNAME_EMAIL_EXISTS);
                break;

            // Some weird error that might happen
            default: 
                return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
        }
    }
}