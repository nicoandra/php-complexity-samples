<?php

namespace \DuplicateMethod;

class Repo {}

abstract class BaseManager {

     private $repo;
     private $repoRead;

     public function __construct(){
          $this->repo = new Repo();
          $this->repoRead = new Repo();
      }

     public function getList($params) {
         return $this->repo->read($params);
     }

    public function getListFromSlaves($params) {
        return $this->repo->read($params);
    }

    public function getOne($params) {
        return $this->repo->read($params);
    }

    public function getOneFromSlaves($params) {
        return $this->repo->read($params);
    }
}


class SomeSensitiveManager extends BaseManager {}

class SomeSafeManager extends BaseManager {

    public function getList($params) {
        // This is a safe manager so we can read from slaves
        return $this->getListFromSlaves($params);
    }

    public function getOne($params) {
        // This is a safe manager so we can read from slaves
        return $this->getOneFromSlaves($params);
    }
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
