<?php

namespace Modules\Post\Repositories;

use Modules\Post\Repositories\Interfaces\DownloadRepositoryInterface;

use Modules\Post\Entities\Downloads;

class DownloadRepository implements DownloadRepositoryInterface {

    /**
     * Class constructor
     */
    public function __construct() {

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

    //  Create new download
    public function createSingleDownload($request) {

        $data = Download::create($request->all());

        return $data;
    }

    /**
     * 
     * Read methods
     * 
     */

    //  Query downloads by a single user
    public function getUserDownloads($id) {

        $data = Download::where('user_id',$id)->get();

        return data;
    }

    // Query download on a single post
    public function getPostDownload($id) {

        $data = Download::where('post_id',$id)->get();

        return data;
    }

    // Query all downloads
    public function getAllDownloads() {

        $data = Download::all();

        return $data;
    }
}