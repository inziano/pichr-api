<?php

namespace Modules\User\Services\Interfaces;

interface AccountsServiceInterface {

    // Methods
    public function getAllAccounts();

    public function getSingleAccount($id);

    public function createSingleAccount($request);

}