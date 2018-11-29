<?php

class SimpleFeatureFlagClass {

    public $flag = 'on';
    public function simpleFunction(){   // 1 symbol, 0

        if ($this->flag === 'on') {
            echo(date());
        } else {
            throw new Exception("The feature is not enabled.");
        }

    }
}
