<?php
  include( SCR_ROOT."/templates/".SCR_TEMPLATE."/template_functions.inc.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  
  <head>
    <title><?php echo SCR_PAGE_NAME ?> - <?php echo $Current->title ?></title>
    <link rel="stylesheet" href="<?php echo SCR_TEMPLATE_ROOT . "/style.css" ?>" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="<?php echo SCR_AUTHOR ?>" />
    <meta name="description" content="<?php echo SCR_DESCRIPTION ?>" />
    <meta name="keywords" content="<?php echo SCR_KEYWORDS ?>" />
    <meta name="generator" content="<?php echo SCR_GENERATOR ?>" />
  </head>
  
  <body>
    <div id="header">
      <?php echo writeLinks()?>
    </div>  
    
    <h1><?php echo $Current->title ?></h1>
    
    <div id="sample">
      <div class="previous">
        <?php if($Current->previous){ ?>
          <a href="?screenshot=<?php echo $Current->previous ?>">&lt;&lt; <?php echo __('Previous') ?></a>
        <?php } ?>
      </div>
      <div class="next">
        <?php if($Current->next){ ?>
          <a href="?screenshot=<?php echo $Current->next ?>"><?php echo __('Next') ?> &gt;&gt;</a>
        <?php } ?>
      </div>
      
      <p>
        <a href="<?php echo $Current->full_file ?>" title="<?php echo $Current->title ?>">
        <img src="<?php echo $Current->sample_file ?>"
        alt="<?php echo $Current->title ?>" width="800"/></a><br />
        <?php echo $Current->description ?>
      </p>
      
    </div>
    
    <div id="thumbnails">
      <?php 
      foreach ( $Images->getSurrounding(4, $Current->base_name) as $Image) {
      ?>
        <a href="?screenshot=<?php echo $Image->base_name ?>" title="<?php echo $Image->time_since ?>">
        <img <?php echo ($Current->base_name==$Image->base_name) ? "class='current'" : ''; ?>
        src="<?php echo $Image->thumbnail_file ?>" alt="<?php echo $Image->title ?>" /></a>
      <?php
      }
      ?>
    </div>
    
    <div id="footer">
      <p><?php echo __('copyright notice'); ?></p>
    </div>
  
  </body>
</html>
