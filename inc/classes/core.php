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

class core {
    /** Design variable (only contain HTML/text) **/
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
    private $copyright = array(
        
    );
    
    /**
     * Called on the construction of the object
     */
    public function __construct() {
        ;
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
     * Those functions will be used in the plugins
     */
    public function onHeaderLoad() {
        
    }
    
    public function onBodyLoad() {
        
    }
    
    public function onMenuLoad() {
        
    }
    
    public function onCopyrightLoad() {
        
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
}

?>
