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

// You can change CORETYPE::RELASE by CORETYPE::DEBUG to use debug mode.
$core = new core(CORETYPE::RELEASE);
require_once PLUGINS_PATH."register_plugins.php";
if (($tab = $core->loadPlugins()) !== true)
{
    foreach ($tab as $value)
        echo "<font color='red'>ERROR with plugin '".$value['class_name']."': ".$value['error_type']."</font><br />";
    exit();
}
$template = new template($core);
if (!$template->isValidTemplate())
    exit("<h1><font color='red'>Template is not valid.</font></h1>Put a valid template in the template path.");
$template->initHeader();
$template->initMenu();
$template->initBody();
$template->initCopyright();
echo $template->getHeader();
echo $template->getMenu();
echo $template->getBody();
echo $template->getCopyright();

?>
