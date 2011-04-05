<?php
/**
 * Deals with individual image stuff
 *
 * @author Argel Arias <levhita@gmail.com>
 * @package Screeenshots Gallery
 */
 
  class Image {
    
    public $base_name       = '';
    public $timestamp       = '';
    public $title           = '';
    public $description     = '';
    public $sample_file     = '';
    public $full_file       = '';
    public $thumbnail_file  = '';
    public $time_since      = '';
    public $previous        = '';
    public $next            = '';
    private $id_screenshot  = '';
    
    /**
     * Gets the basic information from the filename
     * @param str $filename in format "screenshot-2006-45-45-45-45-45-thumb.png"
     * @todo get name and description from database
     */
    public function __construct( $filename ) {
      /** Gets the date part of the filename **/
      $aux = substr($filename, 0, -strlen('-thumb.png'));
      $aux = substr($aux, strlen('screenshot-'));
      
      /** Gets the date out of the filename **/
      if ( preg_match('/\d{4}(-\d{2}){5}/', $aux) ) {
        list($year, $month, $day, $hour, $minute, $second) = explode('-', $aux);
        $this->timestamp = mktime($hour, $minute, $second, $month, $day, (int)$year);
        $this->base_name = $aux;
        $this->timeSince();
      } else {
        throw new RunTimeException(__('The filename ') . $filename . __(' doesn\'t match the required format')); 
      }
      
      /** Set filenames **/
      $this->full_file      = 'screenshot-' . $this->base_name . '-full.png';
      $this->sample_file    = 'screenshot-' . $this->base_name . '.jpg';
      $this->thumbnail_file = 'screenshot-' . $this->base_name . '-thumb.png';
      
      /** In case of missing files replace for default ones **/
      if( !is_file($this->full_file) ) {
        $this->full_file = SCR_MISSING_FULL;
      }
      if( !is_file($this->sample_file) ) {
        $this->sample_file = SCR_MISSING_SAMPLE;
      }
      if( !is_file($this->thumbnail_file) ) {
        $this->thumbnail_file = SCR_MISSING_THUMBNAIL;
      }
      
      /* This are the defaults, add here the database adquisition code */
      $this->title= strftime('%c', $this->timestamp);
      $this->description = __('Screenshot taken ') . $this->time_since . __(' ago');
    }
    
    /**
      * Set the previous image
      * @param string $base_name
      */
    public function setPrevious($base_name){
      $this->previous = $base_name;
    }
    
    /**
      * Set the next image
      * @param string $base_name
      */
    public function setNext($base_name){
      $this->next = $base_name;
    }
    /**
      * It generates a really nice time since string from the image's timestamp
      *
      * @author Nat Bat <cs1njd@bath.ac.uk>.
      * @link http://blog.natbat.co.uk/archive/2003/Jun/14/time_since
     **/
    private function timeSince() {
      
      // array of time period chunks
      $chunks = array(
        array(60 * 60 * 24 * 365  , __('year') ),
        array(60 * 60 * 24 * 30   , __('month') ),
        array(60 * 60 * 24 * 7    , __('week') ),
        array(60 * 60 * 24        , __('day') ),
        array(60 * 60             , __('hour') ),
        array(60                  , __('minute') ),
      );
      
      $now = time(); /** Current unix time  **/
      $since = $now - $this->timestamp;
      
      // $j saves performing the count function each time around the loop
      for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        
        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0) {
          // DEBUG print "<!-- It's $name -->\n";
          break;
        }
      }
      
      $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
      
      if ($i + 1 < $j) {
        // now getting the second item
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
        
        // add second item if it's greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
        }
      }
      $this->time_since = $print;
    }
  }
?>
