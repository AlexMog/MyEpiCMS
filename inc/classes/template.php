<?php

/**
 * Description of template
 *
 * @author AlexMog
 * @name template
 * @encoding UTF-8
 * @filesource template.php
 * @version of 11 avr. 2013 17:43:52
 */

class template {
    private $core;
    private $header;
    private $body;
    private $copyright;
    
    /** On template object creation **/
    public function __construct($core) {
        $this->core = $core;
    }

    public function setHeader() {
        
    }
    
    public function setBody() {
        
    }
    
    public function setCopyright() {
        
    }
    
    /**
     * Return the Header Template
     * @return String
     */
    public function getHeader() {
        return ($this->header);
    }
    
    /**
     * Return the Body Template
     * @return String
     */
    public function getBody() {
        return ($this->body);
    }
    
    /**
     * Return the CopyRight Template
     * @return String
     */
    public function getCopyright() {
        return ($this->copyright);
    }
}

?>
