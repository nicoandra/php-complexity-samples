<?php

include('drawer.php');

class DrawerManager {

    public function open(Drawer $drawer){
        if ($drawer->isOpen) {
            throw new Exception("Can not open an open drawer");
        }

        $drawer->isOpen = true;
    }

    public function close(Drawer $drawer){
        if (!$drawer->isOpen) {
            throw new Exception("Can not close an closed drawer");
        }

        $drawer->isOpen = false;
    }

    public function put(Drawer $drawer, $something) {
        if(!$drawer->isOpen) {
            throw new Exception("Can not put an object in a closed drawer. Open it first.");
        }
        $drawer->content = $something;
    }

    public function get(Drawer $drawer) {
        if(!$drawer->isOpen) {
            throw new Exception("Can not get an object from a closed drawer. Open it first.");
        }
        $object = $drawer->content;
        $drawer->content = null;
        return $object;
    }

}
