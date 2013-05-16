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
    private $menu;
    private $body;
    private $copyright;
    private $body_file = "body.html";
    private $header_file = "header.html";
    private $copyright_file = "copyright.html";
    private $menu_file = "menu.html";
    
    /** On template object creation **/
    public function __construct(core $core) {
        $this->core = $core;
    }

    /**
     * Used to verify if the template is a valid one.
     * @return boolean True if valid template
     */
    public function isValidTemplate() {
        if (!file_exists(TEMPLATE_PATH.$this->core->getTemplate())
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->body_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->header_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->copyright_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->menu_file))
            return (false);
        return (true);
    }
    
    /**
     * Init the header
     */
    public function initHeader() {
        $this->core->loadHeader();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->header_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->header_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->header_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
        fclose($fp);
        $this->header = $content;
    }
    
    /**
     * Init the body
     */
    public function initBody() {
        $this->core->loadBody();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->body_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->body_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->body_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
        fclose($fp);
        $this->body = $content;
    }
    
    /**
     * Init the Copyright
     */
    public function initCopyright() {
        $this->core->loadCopyright();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->copyright_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->copyright_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->copyright_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
        fclose($fp);
        $this->copyright = $content;
    }
    
    /**
     * Init the menu
     */
    public function initMenu() {
        $this->core->loadMenu();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->menu_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->menu_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".$this->menu_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
        fclose($fp);
        $this->menu = $content;
    }
    
    /**
     * Return the Header as HTML Template
     * @return String
     */
    public function getHeader() {
        return ($this->header);
    }
    
    /**
     * Return the Body as HTML Template
     * @return String
     */
    public function getBody() {
        return ($this->body);
    }
    
    /**
     * Return the CopyRight as HTML Template
     * @return String
     */
    public function getCopyright() {
        return ($this->copyright);
    }
    
    /**
     * Return the Menu as HTML Template
     * @return String
     */
    public function getMenu() {
        return ($this->menu);
    }
}

?>
