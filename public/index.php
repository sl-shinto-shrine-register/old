<?php
/**
 * Include bootstrap
 */
include '../application/bootstrap.php';

/**
 * Entry point
 *
 * @package SL Shrine list
 * @license https://opensource.org/licenses/MIT The MIT License
 * @author Vivien Richter <chri_ri@hotmail.de>
 */
$application = new Application($_SERVER['REQUEST_URI']);
$application->Run();
?>
