<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Services\AccountsService;

class AccountsController extends Controller
{

    // Variables
    private $service;

    /**
     * 
     * Constructor
     */
    public function __construct(AccountsService $service) {

        $this->service = $service;
    }

    /**
     * 
     * Read methods
     */

    /**
     * Display one user
     * @return Response
     */
    public function getSingleAccount($id) {

        // Return single user
        return $this->service->getSingleAccount($id);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getAll() {

        return $this->service->getAllAccounts();
    }

    /**
     * 
     * Create methods
     */

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function createSingleAccount(Request $request) {

        return $this->service->createSingleAccount($request);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show() {

        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
