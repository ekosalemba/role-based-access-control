<?php

/**
 * 
 * @author ekoaprianto
 * 
 */
/**
 * 
 * @inspiring from muharihar
 * 
 */
define('MY_FW_VERSION', '0.2.0');

/*
 * ------------------------------------------------------
 *  Load the framework config
 * ------------------------------------------------------
 */
if (file_exists(MY_SYS_PATH . 'core/' . 'MY_Config.php'))
{
    require_once(MY_SYS_PATH . 'core/' . 'MY_Config.php');
}