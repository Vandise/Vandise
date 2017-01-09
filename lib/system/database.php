<?php

  \ActiveRecord\Config::initialize(function($cfg)
  {
    $connections = array();
    $configs = Symfony\Component\Yaml\Yaml::parse(file_get_contents(CONFIG_PATH.'/database.yml'));
    
    foreach($configs['environments'] as $env => $cfgs)
    {
      if(is_array($cfgs))
      {
        switch($cfgs['adapter'])
        {
          case 'sqlite':
            $connections[$env] = 'sqlite://'.$cfgs['name'];
            break;
          default:
            $connections[$env] = $cfgs['adapter'].'://'.$cfgs['user'].':'.$cfgs['pass'].'@'.$cfgs['host'].'/'.$cfgs['name'];
        }
      }
    }
    $cfg->set_connections($connections);
    $cfg->set_model_directory(MODEL_PATH);  
    $cfg->set_default_connection($configs['environments']['default_database']);
  });