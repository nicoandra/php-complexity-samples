<?php

require('FeatureFlag.php');
class TestableDrawer
{
    private $content = null;
    private $isOpen = false;
    private $size = 20;

    public function open()
    {
        if ($this->isOpen) {
            throw new Exception("Can not open an open drawer");
        }
        $this->isOpen = true;
    }


    public function close(){
        if (!$this->isOpen) {
            throw new Exception("Can not close an closed drawer");
        }
        $this->isOpen = false;
    }

    public function put($something) {
        if(!$this->isOpen) {
            throw new Exception("Can not put an object in a closed drawer. Open it first.");
        }

        if (strlen($something) > $this->getMaxAllowedSize()) {
            throw new Exception("The object does not fit in this drawer.");
        }

        $this->content = $something;
    }


    private function getMaxAllowedSize(){
        if (FeatureFlag::isOn("myFlag")) {
            return $this->size / 2;
        }
        return $this->size;
    }

    public function get() {
        if(!$this->isOpen) {
            throw new Exception("Can not get an object from a closed drawer. Open it first.");
        }
        $object = $this->content;
        $this->content = null;
        return $object;
    }
}
