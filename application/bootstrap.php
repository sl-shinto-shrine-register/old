<?php
/**
 * Bootstrap
 *
 * @package SL Shrine list
 * @license https://opensource.org/licenses/MIT The MIT License
 * @author Vivien Richter <chri_ri@hotmail.de>
 */

/**
 * Check PHP version
 */
if (version_compare(PHP_VERSION, '5.4.0') < 0) {
    die('Require PHP 5.4.0 or above.');
}

/**
 * Get base directory
 */
define('BASE_DIRECTORY', dirname(__DIR__));

/**
 * Set class autoloading
 */
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/application');
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/application/models');
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/application/views');
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/application/controller');
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/application/tasks');
spl_autoload_register();
?>
