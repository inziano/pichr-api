<?php

namespace Modules\Post\Repositories\Interfaces;

interface DownloadRepositoryInterface {

   // Methods
   public function createSingleDownload($request);

   public function getAllDownloads();

   public function getUserDownloads($id);

   public function getPostDownloads($id);
}