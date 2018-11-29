<?php


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
