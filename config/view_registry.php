<?php

function view_path($view){
  return VIEW_PATH.'/'.$view;
}

$view_map = array_map("view_path", array(
	  'home' => 'index.haml.php',
	)
);