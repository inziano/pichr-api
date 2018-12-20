<?php

namespace Modules\Post\Services\Interfaces;

interface DownloadServiceInterface {

    // Methods
    public function createSingleDownload($request);

    public function getAllDownloads();

   public function getUserDownloads($id);

   public function getPostDownloads($id);
}