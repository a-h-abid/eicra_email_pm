<?php

/**
 * Check if logged in
 *
 * @return bool
 */
function middleware_Loggedin()
{
    return isset($_SESSION['auth']);
}