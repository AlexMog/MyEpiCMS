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
    public static $body_file = "body.html";
    public static $header_file = "header.html";
    public static $copyright_file = "copyright.html";
    public static $menu_file = "menu.html";
    
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
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$body_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$copyright_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$header_file)
                || !file_exists(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$menu_file))
            return (false);
        return (true);
    }
    
    /**
     * Init the header
     */
    public function initHeader() {
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "Starting the initialisation of the Header... ";
        $this->core->loadHeader();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$header_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$header_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$header_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
        {
            if ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Using replacer '".$replacer['rech']."' with value '".$replacer['repl']."'... ";
            $tmp = $content;
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
            if ($this->core->getCoretype() == CORETYPE::DEBUG && $tmp == $content)
                echo "Warning: Replacement fail, '".$replacer['rech']."' not found in the template. ";
            elseif ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Replacer OK. ";
        }
        fclose($fp);
        $this->header = $content;
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "<br />\n";
    }
    
    /**
     * Init the body
     */
    public function initBody() {
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "Starting the initialisation of the Body... ";
        $this->core->loadBody();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$body_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$body_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$body_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
        {
            if ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Using replacer '".$replacer['rech']."' with value '".$replacer['repl']."'... ";
            $tmp = $content;
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
            if ($this->core->getCoretype() == CORETYPE::DEBUG && $tmp == $content)
                echo "Warning: Replacement fail, '".$replacer['rech']."' not found in the template. ";
            elseif ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Replacer OK. ";
        }
        fclose($fp);
        $this->body = $content;
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "<br />\n";
    }
    
    /**
     * Init the Copyright
     */
    public function initCopyright() {
                if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "Starting the initialisation of the Copyright... ";
        $this->core->loadCopyright();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$copyright_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$copyright_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$copyright_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
        {
            if ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Using replacer '".$replacer['rech']."' with value '".$replacer['repl']."'... ";
            $tmp = $content;
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
            if ($this->core->getCoretype() == CORETYPE::DEBUG && $tmp == $content)
                echo "Warning: Replacement fail, '".$replacer['rech']."' not found in the template. ";
            elseif ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Replacer OK. ";
        }        fclose($fp);
        $this->copyright = $content;
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "<br />\n";
    }
    
    /**
     * Init the menu
     */
    public function initMenu() {
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "Starting the initialisation of the Menu... ";
        $this->core->loadMenu();
        $rpl = $this->core->getReplacers();
        $fp = fopen(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$menu_file, "r");
        if (filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$menu_file) > 0)
            $content = fread($fp, filesize(TEMPLATE_PATH.$this->core->getTemplate()."/".template::$menu_file));
        else
            $content = "";
        foreach ($rpl as $replacer)
        {
            if ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Using replacer '".$replacer['rech']."' with value '".$replacer['repl']."'... ";
            $tmp = $content;
            $content = str_replace($replacer['rech'], $replacer['repl'], $content);
            if ($this->core->getCoretype() == CORETYPE::DEBUG && $tmp == $content)
                echo "Warning: Replacement fail, '".$replacer['rech']."' not found in the template. ";
            elseif ($this->core->getCoretype() == CORETYPE::DEBUG)
                echo "Replacer OK. ";
        }
        fclose($fp);
        $this->menu = $content;
        if ($this->core->getCoretype() == CORETYPE::DEBUG)
            echo "<br />\n";
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
