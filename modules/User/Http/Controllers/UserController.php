<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Services\UserService;

class UserController extends Controller
{

    // Variables
    private $service;

    /**
     * 
     * Constructor
     */
    public function __construct(UserService $service) {

        $this->service = $service;
    }

    /**
     * Display one user
     * @return Response
     */
    public function getSingleUser($id) {

        // Return single user
        return $this->service->getSingleUser($id);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getAll() {

        return $this->service->getAllUsers();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createSingleUser(Request $request) {

        return $this->service->createSingleUser($request);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request) {
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
