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
    $repo = $useSlaves ? $this->repoRead : $this->repo;

    return [
        $repo->count($params),
        $repo->read($params)
    ];
 }

 public function getOne($params, $useSlaves) {
     $repo = $useSlaves ? $this->repoRead : $this->repo;
     return $repo->read($params);
 }
}


class SomeSensitiveManager extends BaseManager {
}

class SomeSafeManager extends BaseManager {
}


class AnotherSafeManager extends BaseManager {
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

    public function getList($params){
        // Function override
        return $this->manager->getList($params, false);   // pass FALSE because it's a SafeController
    }

    public function getOne($params){
        return $this->manager->getOne($params, false);   // pass FALSE because it's a SafeController
    }
}
