<?php

include('../../FeatureFlag.php'); //

include('drawer.php');


class DrawerManagerOriginal {

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
        if($drawer->isOpen) {
            if (strlen($something) <= $drawer->size) {
                $drawer->content = $something;
            } else {
                throw new Exception("The object does not fit in this drawer.");
            }
        } else {
            throw new Exception("Can not put an object in a closed drawer. Open it first.");
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

class DrawerManagerWhenFlagIsOn extends DrawerManagerOriginal {

    public function put(Drawer $drawer, $something) {
        if($drawer->isOpen) {
            if (strlen($something) <= $drawer->size / 2) {
                $drawer->content = $something;
            } else {
                throw new Exception("The object does not fit in this drawer.");
            }
        } else {
            throw new Exception("Can not put an object in a closed drawer. Open it first.");
        }
    }
}


// Declare the class depending on the feature flag
if(FeatureFlag::isOn("myFlag")) {
    class DrawerManager extends DrawerManagerWhenFlagIsOn {};
} else {
    class DrawerManager extends DrawerManagerOriginal{};
}
