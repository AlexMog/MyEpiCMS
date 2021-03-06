<?php
/**
 * Description of core
 *
 * @author AlexMog
 * @name core
 * @encoding UTF-8
 * @filesource core.php
 * @version of 11 avr. 2013 15:44:35
 */

class CORETYPE {
    const DEBUG = 0;
    const RELEASE = 1;
}

class LOADMETHOD {
    const AUTO = 0;
    const MANUAL = 1;
}

class core {
    private $classfiles = array();
    private $coretype;
    private $template = "default";
    private $plugins_prepare = array();
    /* Var who define the replacers */
    private $replacers;
    private $loadmethod;
    
    /**
     * Called on the construction of the object
     */
    public function __construct($coretype = CORETYPE::DEBUG, $loadmethod = LOADMETHOD::AUTO) {
        $this->coretype = $coretype;
        $this->loadmethod = $loadmethod;
        echo "<!-- Using MyEpiCMS Framework version ".VERSION." -->\n";
    }
    
     /**
     * Return the Coretype
     */
    public function getCoretype() {
        return ($this->coretype);
    }
    
    /**
     * Add a replacer to the actual loader.
     * 
     * @staticvar int $i Counter
     * @param type $rech What to be find
     * @param type $repl The replacement
     * @param type $object The plugin object
     */
    public function addReplacer($rech, $repl, $object) {
        static $i = 0;
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Adding the replacer ".$rech." with the replacing sentence ".$repl." from the plugin ".$object->getName()."... ";
        foreach ($this->replacers as $replacer) {
            if ($replacer['rech'] == $rech) {
                if (method_exists($object, "getName") && method_exists($replacer['addBy'], "getName"))
                    echo "Conflict with plugin ".$replacer['addBy']->getName()." and ".$object->getName().". They are using the same replacer: ".$rech.".";
                else
                    echo "Conflict of plugins finded. The \"getName\" method is not set. Cannot find the plugin who is conflicting.";
                exit();
            }
        }
        $this->replacers[$i]['rech'] = $rech;
        $this->replacers[$i]['repl'] = $repl;
        $this->replacers[$i]['addBy'] = $object;
        $i++;
    }
    
    /**
     * Get the replacers (array[id][rech] and array[id][repl])
     * @return array
     */
    public function getReplacers() {
        return ($this->replacers);
    }
    
    /**
     * Load and set the Header
     * You can reload the Header with this function
     */
    public function loadHeader() {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Loading Header... ";
        unset ($this->replacers);
        $this->replacers = array();
        /* Start the method "onHeaderLoad" of each plugins */
        foreach ($this->classfiles as $classfile) {
            $object = $classfile['object'];
            if (method_exists($object, "onHeaderLoad"))
                $object->onHeaderLoad();
        }
    }
    
    /**
     * Load and set the Body
     * You can reload the Body with this function
     */
    public function loadBody() {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Loading Body... ";
        unset ($this->replacers);
        $this->replacers = array();
        /* Start the method "onBodyLoad" of each plugins */
        foreach ($this->classfiles as $classfile) {
            $object = $classfile['object'];
            if (method_exists($object, "onBodyLoad"))
                $object->onBodyLoad();
        }
    }
    
    /**
     * Load and set the Menu
     * You can reload the Menu with this function
     */
    public function loadMenu() {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Loading Menu... ";
        unset ($this->replacers);
        $this->replacers = array();
        /* Start the method "onMenuLoad" of each plugins */
        foreach ($this->classfiles as $classfile) {
            $object = $classfile['object'];
            if (method_exists($object, "onMenuLoad"))
                $object->onMenuLoad();
        }
    }
    
    /**
     * Load and set the Copyright
     * You can reload the Copyright with this function
     */
    public function loadCopyright() {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Loading Copyright... ";
        unset ($this->replacers);
        $this->replacers = array();
        /* Start the method "onCopirightLoad" of each plugins */
        foreach ($this->classfiles as $classfile) {
            $object = $classfile['object'];
            if (method_exists($object, "onCopyrightLoad"))
                $object->onCopyrightLoad();
        }
    }
    
    /**
     * Return True if the class is correctly added. False if not.
     * 
     * @param Object $obj the object created in the loadPlugin method
     * @param String $classfilename the file class name
     * @return Boolean
     */
    public function addPluginClass($classfilename, $obj) {
        if (!file_exists(PLUGINS_PATH.$classfilename))
                return (false);
        $this->classfiles[$classfilename]['path'] = PLUGINS_PATH.$classfilename."/plugin.php";
        $this->classfiles[$classfilename]['name'] = str_replace(".php", "", $classfilename);
        //$this->classfiles[$classfilename]['object'] = new $this->classfiles[$classfilename]['name']();
        $this->classfiles[$classfilename]['object'] = $obj;
        if (method_exists($this->classfiles[$classfilename]['object'], "onLoad"))
            $this->classfiles[$classfilename]['object']->onLoad($this);
        return (true);
    }
    
    public function loadPlugins()
    {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Loading Plugins...<br />\n";
        if ($this->loadmethod == LOADMETHOD::AUTO)
            $this->loadDirPlugins (PLUGINS_PATH);
        else
            require_once PLUGINS_PATH."register_plugins.php";
        $i = 0;
        $errors = array();
        foreach ($this->plugins_prepare as $value)
        {
            
            $classname = str_replace(".php", "", $value);
            if ($this->coretype == CORETYPE::DEBUG)
                echo "Loading plugin '".$classname."'... <br />\n";
            $class = new $classname();
            if (method_exists($class, "isEnabled") && $class->isEnabled() && !$this->addPluginClass($value, $class))
            {
                $errors[$i]['class_name'] = $value;
                $errors[$i]['error_type'] = "The plugin '$classname' didn't exist.";
                $i++;
            }
            else if (!method_exists($class, "isEnabled")) {
                $errors[$i]['class_name'] = $value;
                $errors[$i]['error_type'] = "The plugin '$classname' didn't have any isEnabled() method.";
            }
        }
        if (count($errors) != 0)
            return ($errors);
        return (true);
    }
    
    /**
     * Loads the plugins in the plugin directory
     */
    private function loadDirPlugins($directory) {
        if ($this->coretype == CORETYPE::DEBUG)
            echo "Using automatic loader on directory '".realpath($directory)."'<br />\n";
        if (($dh = opendir(realpath($directory)))) {
            while (($entry = readdir($dh)) !== false) {
                if ($entry != '.' && $entry != ".." && is_dir($directory.$entry))
                    if (file_exists($directory.$entry."/plugin.php")) {
                        if ($this->coretype == CORETYPE::DEBUG)
                            echo "Finded plugin ".$entry."<br />\n";
                        $this->preparePlugin ($entry);
                    }
            }
        } else
            exit("Error while opening the plugins directory.");
    }
    
    /**
     * Prepare the list of the plugins name
     * @param String $classfilename
     */
    public function preparePlugin($classfilename)
    {
        static $i = 0;
        
        $this->plugins_prepare[$i++] = $classfilename;
    }
    
    /**
     * Return the PluginsClassPath
     * @return Array
     */
    public function getPluginsClassPath() {
        return ($this->classfilename);
    }
    
    /**
     * Verify if the plugin is registered. If it is, returns true.
     * @param type $plugin_name The name of the plugin (name of the directory)
     * @return type
     */
    public function pluginIsRegistered($plugin_name) {
        if (in_array($plugin_name, $this->classfiles))
            return (true);
        return (false);
    }
    
    /**
     * Return the template folder
     * @return String
     */
    public function getTemplate() {
        return ($this->template);
    }
    
    /**
     * Set the template, return true if ok, false if not.
     * @param String $templatefolder
     * @return Boolean
     */
    public function setTemplate($templatefolder) {
        if (file_exists(TEMPLATE_PATH.$templatefolder)) {
            $this->template = $templatefolder;
            return (true);
        }
        return (false);
    }
}

?>
