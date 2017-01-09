<?php

define('ROOT_PATH', dirname(dirname(__FILE__)));
define('FUCHSIA_ROOT_PATH', ROOT_PATH);

define('OUT_DIRECTORY', 'public_html');
define('APPLICATION_DIRECTORY', 'src');
define('APPLICATION_PATH', ROOT_PATH.'/'.APPLICATION_DIRECTORY);

define('USE_HAML', true);
define('HAML_CACHE_PATH', ROOT_PATH.'/.haml_cache');
define('DEFAULT_TEMPLATE','master');

define('VIEW_PATH', APPLICATION_PATH.'/views');
define('TEMPLATE_PATH',APPLICATION_PATH.'/templates');
define('MODEL_PATH', APPLICATION_PATH.'/models');
define('HELPER_PATH', APPLICATION_PATH.'/helpers');
