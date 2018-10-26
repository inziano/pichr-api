<?php

namespace Modules\User\Repositories;

use Modules\User\Repositories\Interfaces\UserRepositoryInterface;


use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface {

    // Variables
    protected $user;

    /**
     * 
     * Class constructor
     * 
     */
    public function __constructor(User $user) {

        $this->user = $user;
    }

    /**
     * 
     * DB access methods
     * 
     */

    /**
     * 
     * Create methods
     * 
      */
    // Create single user record
    public function createSingleUser($request) {
        
        // Get the email and check if it exists
        $email = $request->email;
        $username = $request->username;

        // Get email and check if it exists
        if ($this->checkForDuplicateEmail($email) && !$this->checkForDuplicateUsername($username)) {
           
            // User exists
            return 'email exists';

        } else if($this->checkForDuplicateUsername($username) && !$this->checkForDuplicateEmail($email)) {
            
            // Username exists
            return 'username exists';

        }else if ($this->checkForDuplicateEmail($email) && $this->checkForDuplicateUsername($username)) {
            
            // Username Email Combination exists
            return 'username and email exist';

        }else {
            // //Create the new user 
            $newUser = User::create(
                [
                    'name'=> $request->name,
                    'username'=> $request->username,
                    'email'=> $request->email,
                    'password'=> $request->password
                ]);
            return 'ok';
        }
    }

    /**
     * 
     * Read methods
     * 
     */
    // Query single user record
    public function getSingleUser($id) {
        // User
        return User::where('id',$id)->first();
    }

    // Query all user records
    public function getAllUsers() {
        // Users
        return User::all();
    }

    // Query availability of record
    public function userExists ( $id ) {
        // User
        return User::where( 'id', $id )->exists();
    }

    // Query single user's credentials
    public function checkCredentials($request)
    {
        //Check that the username and password exist and match
        $pwd = trim($request->password," ");

        $email = $request->email;
        //Find account with that user name
        $user = User::where('email',$email)->firstOrFail();

        if($user)
        {
            $pass = $user->password;

            // Check if the password matches the hashed password
            if ( Hash::check($request->password,$pass) )
            {
                // Build data
                $resp = [
                    'return'=> 'ok',
                    'value'=> $user->id
                ];
                // Return Okay.
                return $resp;
            }
            else
            {
               // Build data
               $resp = [
                    'return'=> 'password error',
                    'value'=> null
                ];

                return $resp;
            }
        }
        else
        {
            // Build data
            $resp = [
                'return'=> 'incorrect',
                'value'=> null
            ];

            return $resp;
        }
    } 

    // Query for duplicate email
    public function checkForDuplicateEmail($email) {

        $value = User::where('email',$email)->count();

        if ( $value >= 1)
        {
            return true;
        } else //$value is 0
        {
            return false;
        }
    }

    // Query for duplicate username
    public function checkForDuplicateUsername($username) {

        $value = User::where('username',$username)->count();

        if ( $value >= 1)
        {
            // Username already exists
            return true;
        } else
        {
            // Username not in use
            return false;
        }
    }
    // Query for duplicate record

    /**
     * 
     * Update methods
     * 
     */
    // Update single user record
    public function updateSingleUser($request, $id) {
        // Find user
        $user = User::findOrFail($id);

        // Update if user exists
        if ($user) {

            $val = $user->update($request->all());

            // dd($val);

            if($val->id === $id) {

                return $val->username;
            }
        } else {

            return False;
        }
    }

    /**
     * 
     * Delete methods
     * 
     */
    // Delete single user record
    public function deleteUser($id)
    {
        //Get the id if exists
        $user = User::findOrFail($id);
        //if the user exist then delete the account
        if($user)
        {
            $user->delete($id);

            return $user;
        }
    }
}