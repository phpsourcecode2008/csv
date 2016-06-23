<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function isLoggedIn()
{
    // Get current CodeIgniter instance
    $CI = & get_instance();

    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('rolename');

    if (isset($user) && $user != '')
    {
        return true;
    }
    return false;
}
