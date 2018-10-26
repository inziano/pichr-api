<?php

namespace Modules\User\Repositories\Interfaces;

interface AccountsRepositoryInterface {

    // Methods
    public function createSingleAccount($request);

    // public function updateSingleAccount($request,$id);

    public function getAllAccounts();

    public function getSingleAccount($id);

    // public function checkForDuplicateAccount($username);

    // public function checkCredentials($request);

    // public function deleteAccount($id);
}