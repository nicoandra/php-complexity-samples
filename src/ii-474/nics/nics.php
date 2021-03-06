<?php

class Repo {}

abstract class BaseManager {

 protected $useSlaves = false;
 protected $repo;
 protected $repoRead;

 public function __construct(){
      $this->repo = new Repo();
      $this->repoRead = new Repo();
  }

 public function getList($params) {
     $repo = $this->getRepoForReads();
     return [
         $repo->count($params),
         $repo->read($params)
        ];
 }

 public function getOne($params) {
     return $this->getRepoForReads()->read($params);
 }

 private function getRepoForReads(){
     return $this->useSlaves ? $this->repoRead : $this->repo;
 }

}


class SomeSensitiveManager extends BaseManager {}

class SomeSafeManager extends BaseManager {
    protected $useSlaves = true;
}

class AnotherSafeManager extends BaseManager {
    protected $useSlaves = true;
}


class SensitiveController {
    protected $manager;
    public function __construct(){
        $this->manager = new SomeSensitiveManager();
    }

}

class SafeController {
    protected $manager;
    public function __construct(){
        $this->manager = new SomeSafeManager();
    }
}
