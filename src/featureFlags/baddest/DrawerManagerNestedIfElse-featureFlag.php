<?php

include('../../FeatureFlag.php'); //

include('drawer.php');


class DrawerManagerNestedIfElseFeatureFlagBaddest {

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

            if (class_exists("FeatureFlag") && is_callable("FeatureFlag", "isOn") && FeatureFlag::isOn("myFlag")) {
                // Proudly brought to you by https://github.com/Groupe-Atallah/SSENSE-Portal/pull/856/commits/ba466ec25fbf652ce3bf20a4718a56c4b46bc439#diff-2c3d886919ec4e23efae44b619f8d76bR655
                if (strlen($something) <= $drawer->size / 2) {
                    $drawer->content = $something;
                } else {
                    throw new Exception("The object does not fit in this drawer.");
                }
            } else {
                if (strlen($something) <= $drawer->size) {
                    $drawer->content = $something;
                } else {
                    throw new Exception("The object does not fit in this drawer.");
                }
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
