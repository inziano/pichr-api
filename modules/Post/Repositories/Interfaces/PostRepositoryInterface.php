<?php

namespace Modules\Post\Repositories\Interfaces;

interface PostRepositoryInterface {

   // Methods
   public function createSinglePost($request);

   public function updateSinglePost($request,$id);

   public function getAllPosts();

   public function getSinglePost($id);

   public function postExists ($id);

   public function deletePost($id);
}