<?php

function get_file_name($class, $dir) : string
{
  $class = strtolower(preg_replace('/\B([A-Z])/', '_$1', $class));
  $fragments = explode( '\\', $class );
  return ROOT_PATH.$dir.
    implode( '', 
      array_map( 
        function($fragment, $i) use ($class){
          return "/$fragment"; 
        }, $fragments, array_keys($fragments)
      )
    ).'.php';
}

function system_load($class) : bool
{
  if(file_exists(get_file_name($class, '/lib/')))
  {
    require_once get_file_name($class, '/lib/');
    return true;
  }
  else if (file_exists(get_file_name($class, '/lib/')))
  {
    require_once get_file_name($class, '/'.APPLICATION_DIRECTORY.'/');
    return true;
  }
  return false;
}
spl_autoload_register('system_load');