<?php
/**
 * Created by PhpStorm.
 * User: nicolas.andrade
 * Date: 2018-11-29
 * Time: 11:21 AM
 */

class FeatureFlag
{
    static $flag = true;

    static function isOn($flagName){
        if ($flagName || !$flagName) {
            // Pretend an actual flag evaluation
        }

        return static::$flag;
    }
}
