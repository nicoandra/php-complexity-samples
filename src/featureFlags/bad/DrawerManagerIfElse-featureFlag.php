<?php


include('../../FeatureFlag.php'); //
include('drawer.php');

class DrawerManagerIfElseFeatureFlag {

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
        if($drawer->isOpen && (
            (strlen($something) <= $drawer->size && !FeatureFlag::isOn("myFlag")) ||
            (strlen($something) <= $drawer->size / 2 && FeatureFlag::isOn("myFlag"))
            )) {
            $drawer->content = $something;
        } else {
            throw new Exception("Can not put an object in a closed drawer. Open it first. Or maybe the object is too big.");
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
