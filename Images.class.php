<?php
/**
 * Deals with all the images stuff
 *
 * @author Argel Arias <levhita@gmail.com>
 * @package Screenshots Gallery
 */
  
  require_once('Image.class.php');
  
  class Images {
    
    public $Images = array();
    public $count = 0;
    
    public function __construct() {
      $files = explode("\n", `ls -r screenshot-*-thumb.png`);
      $size = count($files) -1 ;
      unset($files[$size]);
      $Previous = null;
      foreach ($files as $file) {
        try {
          $Current = new Image($file);
          if ($Previous) {
            $Previous->setNext($Current->base_name);
            $Current->setPrevious($Previous->base_name);
          }
          $this->Images[] = $Current;
          $Previous = $Current;
        } catch(RunTimeException $e) {
          debug($e->getMessage());
        }
      }
      $this->count = count($this->Images);
    }
    
    public function getLast(){
      reset($this->Images);
      return current($this->Images);
    }
    
    public function getLastN($x){
      reset($this->Images);
      $lasts= array();
      for ( $x=0; $x<$x; $x++) {
        $lasts = $this->Images[$x];
      }
      return $lasts;
    }
    
    /**
     * Get All the Images in an array
     *
     * @return array fill with images
     */
    public function getAll() {
      return $this->Images;
    }
    
    /**
     * Return the given number of elements sorrounding the base_name image
     * @param integer $elements
     * @param string $base_name
     * @return array of 'Image's
     */
    public function getSurrounding($elements, $base_name) {
      $current_index = $this->getIndex($base_name);
      if ( $current_index === false) {
        throw new RunTimeException("Couldn't find image $base_name");
      }
      if ( $elements >= $this->count ) {
        $start = 0;
        $end = $this->count -1;
      } else {
        $start  = (int) ( 1 + $current_index - $elements/2 );
        $end    = (int) ( $current_index + $elements/2 );
        if ( $start < 0 ) {
          $start = 0;
          $end = $elements - 1;
        }
        if ($end >= $this->count) {
          $end = $this->count - 1;
          $start = $end - $elements + 1;
        }
      }
      $surrounding = array();
      for ( $x=$start; $x<=$end; $x++ ) {
        $surrounding[$x] = $this->Images[$x]; 
      }
      return $surrounding;
    }
    
    public function search($base_name) {
      foreach ( $this->Images as $key => $Image ) {
        if ( $base_name == $Image->base_name ) {
          return $Image;
        }
      }
      return NULL;
    }
    
    private function getIndex($base_name) {
      foreach ( $this->Images as $key => $Image ) {
        if ( $base_name == $Image->base_name ) {
          return $key;
        }
      }
      return false;
    }
    
  }
?>
