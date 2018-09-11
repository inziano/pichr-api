<?php

namespace Modules\User\Services\Interfaces;

interface UserServiceInterface {

    // Methods
    public function getAllUsers();

    public function getSingleUser($id);

    public function createSingleUser($request);

    public function registerUser($request);

    public function appTokens($type,array $data=[]);

    public function loginAttempt($request);
}