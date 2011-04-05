<?php
/**
 * Copyright 2006(c) Argel Arias "Levhita"
 *
 * Email: argel.arias@levhita.net
 * URL: https://github.com/levhita/Screenshot-Gallery
 *
 * This file is part Screenshoter
 *
 * Screenshoter is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software Foundation;
 * either version 2 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
**/

  require_once('config.php');
  require_once('Images.class.php');
  
  $Images = new Images();
  
  if ( !empty($_GET['screenshot']) ) {
    if ( !$Current = $Images->search($_GET['screenshot']) ) {
      $Current = $Images->getLast();
    }
  } else {
    $Current = $Images->getLast();
  }
  if ( !empty($_GET['view']) ) {
    $view = $_GET['view'];
  }
  include( getTemplate($view) );

?>
