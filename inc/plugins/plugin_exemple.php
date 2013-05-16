<?php

/**
 * Description of plugin_exemple
 *
 * @author AlexMog
 * @name plugin_exemple
 * @encoding UTF-8
 * @filesource plugin_exemple.php
 * @version of 11 avr. 2013 16:55:21
 */
class plugin_exemple {
    private $pluginName = "MyPluginName";
    private $core;
    
    /**
     * Return the name of your plugin
     * 
     * @return string
     */
    public function getName() {
        return ($this->pluginName);
    }
    
    /**
     * On the load of the plugin
     */
    public function onLoad(core $core) {
        $this->core = $core;
    }
    
    /**
     * Will be called with the LoadHeader
     */
    public function onHeaderLoad() {
        
    }
    
    /**
     * Will be called with the LoadBody
     */
    public function onBodyLoad() {
        //$this->core->addReplacer("{test}", "Hello World", $this);
    }
    
    /**
     * Will be called with the LoadMenu
     */
    public function onMenuLoad() {
        
    }
    
    /**
     * Will be called with the LoadCopyright
     */
    public function onCopyrightLoad() {
        
    }
    
    /**
     * Verify if it's a plugin. Return true if you want to be a plugin, false if not.
     */
    public function isPlugin() {
        return (true);
    }
}

?>
