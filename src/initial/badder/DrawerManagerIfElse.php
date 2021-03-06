<?php

include('drawer.php');


class DrawerManagerIfElse {

    public function open(Drawer $drawer){
        if (!$drawer->isOpen) {
            $drawer->isOpen = true;
        } else {
            throw new Exception("Can not open an open drawer");
        }
    }

    public function close(Drawer $drawer){
        if ($drawer->isOpen) {
            $drawer->isOpen = false;
        } else {
            throw new Exception("Can not close an closed drawer");
        }
    }

    public function put(Drawer $drawer, $something) {
        if($drawer->isOpen && strlen($something) > $drawer->size) {
            $drawer->content = $something;
        } else {
            throw new Exception("Can not put an object in a closed drawer. Open it first. And this error might not be accurate.");
        }
    }

    public function get(Drawer $drawer) {
        if($drawer->isOpen) {
            $object = $drawer->content;
            $drawer->content = null;
        } else {
            throw new Exception("Can not get an object from a closed drawer. Open it first.");
        }

        return $object;
    }

}
