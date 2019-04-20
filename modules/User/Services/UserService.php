<?php

namespace Modules\User\Services;

use App\ApiCode;
use App\Events\UserCreated;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Application;
use Modules\User\Repositories\UserRepository;
use \MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\User\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface {

    // Variables
    private $mailer;
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
    public function getSingleUser($id) {

        // Hit repo
        $user = $this->repo->getSingleUser($id);
        // $user = $this->repo->userExists($id);

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
            // Hash password
            // email and password
            $email = $request->email;
            $password = $request->password;

            // pass the values to the repo
            $response = $this->repo->checkCredentials($request);

            // Check response
            switch ( $response ) {

                case $response->email === $email:
                    // Call token generator
                    $access_token = $this->appTokens('password',['username'=>$email, 'password'=>$password]);
                        
                    // create response
                    $data = [ "user_id"=>$response->id, "user_name"=>$response->name, "token"=> $access_token ];

                    // Return response from response builder
                    return ResponseBuilder::success($data);

                    break;
                // Password has error
                case 'password error':
                    // create response 
                    return ResponseBuilder::error(ApiCode::EMAIL_PASSWORD_MISMATCH);
                    break;

                case 'incorrect':
                    // Return response from response builder
                    return ResponseBuilder::error(ApiCode::LOGIN_ERROR);
                    break;

                default:
                    // Return response from response builder
                    return ResponseBuilder::error(ApiCode::LOGIN_ERROR);
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

        return $data;
    }

    // Check password 
    public function passwordHash ($request) {
        // 
        if ( $request->has('password') ) {
            // Take password
            $oldPass = $request->password;

            // Hash
            $newPass = Hash::make($oldPass);

            // Merge 
            $req = $request->merge( [ 'password' => $newPass ] );

            // return 
            return $req;
        } else {
            // Exit
            return 'error';
        }
    }

    // Register single user
    public function registerUser( $request ) {

        // Hash password
        $req = $this->passwordHash( $request );

        if ( $req === 'error' ) {

            return 'error';
        }

        $email = $req->email;
        $password = $req->password;

        // Send to repository
        $response = $this->repo->createSingleUser($req);
    

        // Build response 
        switch($response) {
            // Response 
            case $response->email === $email:
                // Fire user created event
                event( new UserCreated( $response->email ));
    
                // Call token generator
                $access_token = $this->appTokens('password',['username'=>$email,'password'=>$password]);
                
                // create response
                $data = [ "user_id"=> $response->id, "user_name"=> $response->username, "token"=> $access_token];

                dd( $access_token );
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
                // Return an error
                return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
                break;
        }
    }
}