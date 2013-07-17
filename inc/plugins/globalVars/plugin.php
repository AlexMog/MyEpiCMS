<?php

/**
 * Global Vars is a plugin created to set global vars in the templates (like the file dir parent, etc.)
 * 
 * File globalVars.php
 * Encoded with: UTF-8
 * Created date: Jun 20, 2013 at 5:23:32 PM 
 * @author moghra_a
 */
class globalVars {
    private $core;
    /* Array with the different vars name */
    private $varsName = array(
            "{DIR}" /* The template path directory (from the http path) */
        );
    private $varsFunc;
    
    /**
     * Setting the plugin name
     * @return String
     */
    public function getName() {
        return ("GlobalVars");
    }
    
    /**
     * Setting the onLoad function
     * @param core $core
     */
    public function onLoad(core $core) {
        $this->core = $core;
        $this->varsFunc = array(
            "templates/".$this->core->getTemplate()."/"
        );
    }
    
    /**
     * OnHeaderLoad method
     */
    public function onHeaderLoad() {
        foreach ($this->varsName as $key => $value)
            $this->core->addReplacer($value, $this->varsFunc[$key], $this);
    }
    
    /**
     * onBodyLoad method
     */
    public function onBodyLoad() {
        foreach ($this->varsName as $key => $value)
            $this->core->addReplacer($value, $this->varsFunc[$key], $this);
    }
    
    /**
     * onMenuLoad method
     */
    public function onMenuLoad() {
        foreach ($this->varsName as $key => $value)
            $this->core->addReplacer($value, $this->varsFunc[$key], $this);
    }
    
    /**
     * onCopyrightLoad method
     */
    public function onCopyrightLoad() {
        foreach ($this->varsName as $key => $value)
            $this->core->addReplacer($value, $this->varsFunc[$key], $this);
    }
    
    /**
     * Setting the class as a plugin
     * @return boolean
     */
    public function isEnabled() {
        return (true);
    }
}

?>
