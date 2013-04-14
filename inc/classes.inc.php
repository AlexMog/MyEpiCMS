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
    if (file_exists(CLASS_PATH.$classname.'.php'))
        require_once CLASS_PATH.$classname.'.php';
    else if (file_exists(PLUGINS_PATH.$classname.'.php'))
            require_once PLUGINS_PATH.$classname.'.php';
    else
        exit ("Class $classname not found...");
}

spl_autoload_register('loadClass');

?>
