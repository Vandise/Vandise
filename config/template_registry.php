<?php

function template_path($view){
  return TEMPLATE_PATH.'/'.$view;
}

$template_map = array_map("template_path", array(
  	'master' => 'master.haml.php'
  )
);