<?php

namespace Modules\Post\Services\Interfaces;

interface PostServiceInterface {

    // Methods
    public function createSinglePost($request);

    public function updateSinglePost($request,$id);

    public function getAllPosts();

    public function getSinglePost($id);

    public function deletePost($id);

    public function checkImage($request);

    public function storeImage($image, $imagename);
}