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
    
    /**
     * Return the name of the plugin
     * @return String name of the plugin
     */
    public function getName() {
        return ("Page gestionnary");
    }
    
    /**
     * On the load of the plugin
     */
    public function onLoad(core $core) {
        /* We are going to need the core, so we use a private var to stock it. */
        $this->core = $core;
        /* We look if the page var is set. */
        if (isset($_GET['page'])) {
            /* if it is, we are going to replace every "/" char to secure our include. */
            $page = str_replace("/", "", $_GET['page']);
            /* We look if the file exists */
            if (file_exists(__DIR__."/pagesGestionnary/".$page.".php")) {
                /* Include the file */
                include_once __DIR__."/pagesGestionnary/".$page.".php";
                /* Setting the page vars */
                $this->title = $title;
                $this->content = $content;
            }
            else
            {
                /* If the page didn't exist, set a 404 page */
                $this->title = "404";
                $this->content = "<h1>Page not found.</h1>";
            }
        } else {
            /* If no page is called, setting the index. */
            $this->title = "index";
            $this->content = "index test";
        }
    }
    
    /*
     * Header loader
     */
    public function onHeaderLoad() {
        /* Adding the replaceer to the title of the page */
        $this->core->addReplacer("{Title}", $this->title, $this);
    }
    
    /*
     * Body loader
     */
    public function onBodyLoad() {
        /* Adding the remplacer to set the Body of the page */
        $this->core->addReplacer("{TextPage}", $this->content, $this);
    }
    
    /*
     * Define the class as plugin
     */
    public function isPlugin() {
        return (true);
    }
}

?>
