<?php

namespace library\illuminate;

/**
 * Validation Class
 */
class Validate
{

    /**
     * @param  string json
     * @return boolean
     */
    public static function isJson(string $json) : bool
    {
        return is_string($json) && is_array(json_decode($json, true)) && (json_last_error() == JSON_ERROR_NONE)? true : false;
    }
}
