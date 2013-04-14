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

class core {
    /** Design public variable (only contain HTML/text) **/
    private $header = array(
        'title' => 'Title test'
    );
    private $body = array(
        'body_content' => 'test'
    );
    private $menu = array(
        'links' => array(
            0 => array('name', 'link'),
            1 => array('name2', 'link2')
        )
    );
    private $copyright = array();
    private $classfiles = array();
    private $coretype;
    private $template = "default";
    private $plugins_prepare = array();
    
    /**
     * Called on the construction of the object
     */
    public function __construct($coretype = CORETYPE::DEBUG) {
        $this->coretype = $coretype;
    }
    
    /**
     * Load and set the Header
     * You can reload the Header with this function
     */
    public function loadHeader() {
        
    }
    
    /**
     * Load and set the Body
     * You can reload the Body with this function
     */
    public function loadBody() {
        
    }
    
    /**
     * Load and set the Menu
     * You can reload the Menu with this function
     */
    public function loadMenu() {
        
    }
    
    /**
     * Load and set the Copyright
     * You can reload the Copyright with this function
     */
    public function loadCopyright() {
        
    }
    
    /**
     * Return the Header contents after a loadHeader
     * @return Array Header
     */
    public function getHeader() {
        return ($this->header);
    }
    
    /**
     * Return the Body contents after a loadBody
     * @return Array Body
     */
    public function getBody() {
        return ($this->body);
    }
    
    /**
     * Return the Menu contents after a loadMenu
     * @return Array Menu
     */
    public function getMenu() {
        return ($this->menu);
    }
    
    /**
     * Return the Copyright contents after a loadCopyright
     * @return Array Copyright
     */
    public function getCopyright() {
        return ($this->copyright);
    }
    
    /**
     * Return True if the class is correctly added. False if not.
     * @param String $classfilename the file class name
     * @return Boolean
     */
    public function addPluginClass($classfilename) {
        if (!file_exists(PLUGINS_PATH.$classfilename))
                return (false);
        $this->classfiles[$classfilename]['path'] = PLUGINS_PATH.$classfilename;
        $this->classfiles[$classfilename]['name'] = str_replace(".php", "", $classfilename);
        $this->classfiles[$classfilename]['object'] = new $this->classfiles[$classfilename]['name']();
        return (true);
    }
    
    public function loadPlugins()
    {
        $i = 0;
        $errors = array();
        foreach ($this->plugins_prepare as $value)
        {
            $classname = str_replace(".php", "", $value);
            $class = new $classname();
            if ($class->isPlugin() && !$this->addPluginClass($value))
            {
                $errors[$i]['class_name'] = $value;
                $errors[$i]['error_type'] = "The plugin '$classname' didn't exist.";
                $i++;
            }
            unset($class);
        }
        if (count($errors) != 0)
            return ($errors);
        return (true);
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
