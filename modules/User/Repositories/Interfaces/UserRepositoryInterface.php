<?php

namespace Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface {

    // Methods
    public function createSingleUser($request);

    public function updateSingleUser($request,$id);

    public function getAllUsers();

    public function getSingleUser($id);

    public function userExists ( $id );

    public function checkForDuplicateEmail($email);

    public function checkForDuplicateUsername($username);

    public function checkCredentials($request);

    public function deleteUser($id);
}