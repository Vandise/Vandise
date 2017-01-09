<?php

function view_path($view){
  return VIEW_PATH.'/'.$view;
}

$view_map = array_map("view_path", array(
	  'home' => 'home_page.haml.php',
	)
);