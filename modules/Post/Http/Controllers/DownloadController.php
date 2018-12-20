<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Modules\Post\Services\DownloadService;


class DownloadController extends Controller
{
    
    // Variables
    private $downloadservice;

    /**
     * 
     * Class constructor
     */
    public function __construct( DownloadService $downloadservice ) {

        $this->downloadservice = $downloadservice;
    }

     /**
     * 
     * Download Methods
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function allDownloads() {

        return $this->downloadservice->getAllCategories();
    }

   
    /**
     * Get a single post
     * @return Response
     */
    public function singleDownload( Request $request,$id) {

        return $this->downloadservice->getSingledownload($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function storeDownload(Request $request) {
        
        return $this->downloadservice->createSingledownload($request);
    }
}