<?php
/**
 * Description of index
 *
 * @author AlexMog
 * @name index
 * @encoding UTF-8
 * @filesource index.php
 * @version of 11 avr. 2013 15:42:59
 */

require_once(__DIR__."/inc/vars.inc.php");
require_once(__DIR__."/inc/classes.inc.php");

if (file_exists(__DIR__."/install") && !file_exists(__DIR__."/install/.locked"))
        exit("<h1><font color='red'>The folder \"install\" is not locked. Have you finished the installation?</font></h1>");

?>
