<?php namespace Eicra\Jira;

class StatusCode {

    protected static $codes = [
        '3'         => 'In Progress',
        '10000'     => 'To Do',
        '10100'     => 'Done',
    ];

    public static function getStatus($code)
    {
        if (!isset(static::$codes[$code]))
            return null;

        return static::$codes[$code];
    }

    public static function getAllStatus()
    {
        return static::$codes;
    }

}