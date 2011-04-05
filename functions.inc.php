<?php
/**
 * Functions used globally
 *
 * @author Argel Arias <levhita@gmail.com>
 * @package Screeenshots Gallery
 */
 
 /**
  * Main language replace function
  * @param string $string
  * @return string language specific string
  */
 function __($string) {
   global $language;
   if ( isset( $language[$string] ) ) {
     return $language[$string];
   }
   return $string;
 }
 
 /**
  * Handle debug, this should configurable to allow distiction between Production
  * and development enviroments.
  *
  * @param $message
  * @todo implement something useful
  */
 function debug($message){
   echo __('An error happened: ') . $message;
 }
 
 /**
  * Gets the given template file
  * @param string $view
  * @return string template file
  */
 function getTemplate($view = 'index') {
   $default_template = SCR_ROOT."/templates/".SCR_TEMPLATE."/index.php";
   if (!preg_match('/^\w*$/', $view) ) {
     return $default_template;
   }
   $template_file = SCR_ROOT."/templates/".SCR_TEMPLATE."/$view.php";
   if ( is_file($template_file) ) {
     return $template_file;
   } else {
     if ( is_file($default_template) ) {
       return $default_template;
     }
   }
   throw new RunTimeException("Couldn't find a valid template!!");
 }

?>
