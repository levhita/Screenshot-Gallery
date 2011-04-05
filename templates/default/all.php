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
    <base href="<?php echo SCR_WEB_ROOT ?>" />
  </head>
  
  <body>
    <div id="header">
      <?php echo writeLinks()?>
    </div>
    
    <h1><?php echo __('All') ?></h1>
    
    <div id="thumbnails">
      <?php 
      foreach ( $Images->getAll() as $Image) {
      ?>
        <a href="s-<?php echo $Image->base_name ?>" title="<?php echo $Image->time_since ?>">
        <img src="<?php echo $Image->thumbnail_file ?>" alt="<?php echo $Image->title ?>" /></a>
      <?php
      }
      ?>
    </div>
    
    <div id="footer">
      <p><?php echo __('copyright notice'); ?></p>
    </div>
  
  </body>
</html>
