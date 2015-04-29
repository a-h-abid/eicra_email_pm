<?php

/**
 * Check to see if the app is in Debug Mode or not
 *
 * @return boolean
 */
function isDebugMode()
{
    return Slim\Slim::getInstance()->container['settings']['debug'];
}