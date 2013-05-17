<?php

/**
 * File pageGestionnary.php
 * Encoded with: UTF-8
 * Created date: May 16, 2013 at 3:46:08 PM 
 * @author moghra_a
 */
class pageGestionnary {
    private $title;
    private $content;
    private $core;
    
    public function getName() {
        return ("Page gestionnary");
    }
    
    /**
     * On the load of the plugin
     */
    public function onLoad(core $core) {
        $this->core = $core;
        if (isset($_GET['page'])) {
            $page = str_replace("/", "", $_GET['page']);
            if (file_exists(__DIR__."/pagesGestionnary/".$page.".php")) {
                include_once __DIR__."/pagesGestionnary/".$page.".php";
                $this->title = $title;
                $this->content = $content;
            }
            else
            {
                $this->title = "404";
                $this->content = "<h1>Page not found.</h1>";
            }
        } else {
            $this->title = "index";
            $this->content = "index test";
        }
    }
    
    public function onHeaderLoad() {
        $this->core->addReplacer("{Title}", $this->title, $this);
    }
    
    public function onBodyLoad() {
        $this->core->addReplacer("{TextPage}", $this->content, $this);
    }
    
    public function isPlugin() {
        return (true);
    }
}

?>
