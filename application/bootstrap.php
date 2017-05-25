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
define('BASE_DIRECTORY', dirname(__FILE__));

/**
 * Set class autoloading
 */
set_include_path(get_include_path().PATH_SEPARATOR.BASE_DIRECTORY.'/classes');
spl_autoload_register();
?>
