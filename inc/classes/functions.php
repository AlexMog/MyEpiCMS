<?php

/**
 * Description of functions
 *
 * @author AlexMog
 * @name functions
 * @encoding UTF-8
 * @filesource functions.php
 * @version of 11 avr. 2013 16:10:14
 */

class functions {
    
    /**
    * Used to verify if an email adress is exact.
    * @param string $adresse Email adress to verify
    * @return boolean True if correct, false if not
    */
    public static function verify_email($adresse)  
    {  
       $syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
       if (preg_match($syntaxe,$adresse))  
          return true;  
       else  
         return false;  
    }
}

?>
