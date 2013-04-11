<?php
/**
 * Description of classes
 *
 * @author AlexMog
 * @name classes
 * @encoding UTF-8
 * @filesource classes.inc.php
 * @version of 11 avr. 2013 15:43:14
 */

function loadClass($classname)
{
    require 'classes/'.$classname.'.php';
}

spl_autoload_register('loadClass');

?>
