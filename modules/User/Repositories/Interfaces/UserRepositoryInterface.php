<?php

namespace Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface {

    // Methods
    public function createSingleUser($request);

    public function updateSingleUser($request,$id);

    public function getAllUsers();

    public function getSingleUser($id);
}