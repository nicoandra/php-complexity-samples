<?php

class Repo {}

abstract class BaseManager {

 private $useSlaves = false;
 private $repo;
 private $repoRead;

 public function __construct(){
      $this->repo = new Repo();
      $this->repoRead = new Repo();
  }

 public function getList($params) {
     return $this->repo->read();
 }

 public function getOne($params) {
     return $this->repo->read();
 }

 private function getRepoForReads(){
     if ($this->$useSlaves) {
         return $this->repoRead;
     }
     return $this->repo;
 }

}


class SomeSensitiveManager extends BaseManager {}

class SomeSafeManager extends BaseManager {
    private $useSlaves = true;
}


class SensitiveController {
    private $manager;
    public function __construct(){
        $this->manager = new SomeSensitiveManager();
    }

}

class SafeController {
    private $manager;
    public function __construct(){
        $this->manager = new SomeSafeManager();
    }
}
