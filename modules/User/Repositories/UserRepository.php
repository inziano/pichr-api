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

        // Request email
        $email = $request->email;

        // dd($request);
        // Create the user
        $newuser = User::create([
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> $request->password
        ]);

        if ( $newuser->email === $email ) {

            // Return true
            return True;        
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
    // Query single user's credentials
    // Query for duplicate email
    // Query for duplicate username
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

            dd($val);

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
}