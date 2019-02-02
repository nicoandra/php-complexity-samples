<?php

class Repo {}

abstract class BaseManager {

 private $repo;
 private $repoRead;

 public function __construct(){
     $this->repo = new Repo();
     $this->repoRead = new Repo();
 }

 public function getList($params, $useSlaves = false) {
     if ($useSlaves) {
        return $this->repoRead->read();
     }
     return $this->repo->read();
 }

 public function getOne($params, $useSlaves) {
     if ($useSlaves) {
        return $this->repoRead->read();
     }
     return $this->repo->read();
 }
}


class SomeSensitiveManager extends BaseManager {
}

class SomeSafeManager extends BaseManager {
}



class SensitiveController {
    private $manager;
    public function __construct(){
        $this->manager = new SomeSensitiveManager();
    }

    public function getList($params){
        return $this->manager->getList($params, true);   // pass TRUE because it's a SensitiveController
    }

    public function getOne($params){
        return $this->manager->getOne($params, true);   // pass TRUE because it's a SensitiveController
    }

}

class SafeController {
    private $manager;
    public function __construct(){
        $this->manager = new SomeSafeManager();
    }
}
