<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__)  .'PhpWord/Autoloader.php';
 
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
Autoloader::register();
Settings::loadConfig();

class Phpword extends Autoloader {

}
