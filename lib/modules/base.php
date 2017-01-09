<?php

  namespace Modules;

  abstract class Base
  {
    protected $view = null;
    protected $vandise = null;
    protected $helper_name = null;
    protected $view_data = array();
    protected $view_name = null;
    protected $template_name = null;
    protected $compiled_view = null;
    protected $path_root = null;
    protected $helper = null;
    protected $out_file = null;

    public function __construct($vandise, $settings)
    {
      $this->vandise = $vandise;
      $this->view = (new \ActionView\Factory\ViewFactory)->newInstance();
      $this->view->setRegistries(
        new \ActionView\Registry\TemplateRegistry($this->vandise->views),
        new \ActionView\Registry\TemplateRegistry($this->vandise->templates)
      );
      foreach($settings as $setting_name => $value)
      {
        if (property_exists($this, $setting_name))
        {
          $this->$setting_name = $value;
        }
      }
    }

    protected function set_helper_name() : \Modules\Base
    {
      return $this;
    }

    protected function set_view_name() : \Modules\Base
    {
      return $this;     
    }

    protected function set_template_name() : \Modules\Base
    {
      return $this;     
    }

    protected function load_helper() : \Modules\Base
    {
      $helper = '\Helpers\\'.$this->helper_name;
      if (class_exists($helper) && $this->helper == null)
      {
        $this->helper = new $helper($this->vandise);
      }
      $this->view_data['view'] = $this->view;
      return $this;
    }    

    protected function set_view_data() : \Modules\Base
    {
      if ($this->helper)
      {
        $this->view_data = $this->helper->resolve();
      }
      $this->view_data['view'] = $this->view;
      return $this;
    }

    protected function compile_view() : \Modules\Base
    {
      $this->view->setLayout($this->template_name);
      $this->view->setView($this->view_name);
      $this->compiled_view = $this->view->__invoke((array)$this->view_data);
      return $this;
    }

    protected function output_view() : bool
    {
      // TODO: write file contents
      if ($this->make_path($this->out_file, true))
      {
        return file_put_contents($this->out_file, $this->compiled_view);
      }
      return false;
    }

    protected function construct_file_name() : \Modules\Base
    {
      $system_view_path = str_replace('.php', '', $this->vandise->views[$this->view_name]);
      $system_view_path = str_replace('.haml', '', $system_view_path);
      $system_view_path = str_replace(VIEW_PATH, '', $system_view_path);
      $this->out_file = OUT_DIRECTORY.$this->path_root.$system_view_path.'.html';
      return $this;    
    }

    protected function make_path(string $pathname, bool $is_filename = false, $mode = 0777) : bool
    {
      if($is_filename)
      {
        $pathname = substr($pathname, 0, strrpos($pathname, '/'));
      }
      if (is_dir($pathname) || empty($pathname))
      {
        return true;
      } 
      $pathname = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $pathname);
      if (is_file($pathname))
      {
        return false;
      }
      $next_pathname = substr($pathname, 0, strrpos($pathname, DIRECTORY_SEPARATOR));
      if ($this->make_path($next_pathname, $mode))
      {
        if (!file_exists($pathname))
        {
          return mkdir($pathname, $mode, true);
        }
      }
      return false;
    }

    public function run() : bool
    {
      return $this
                ->set_helper_name()
                ->set_view_name()
                ->set_template_name()
                ->load_helper()
                ->set_view_data()
                ->construct_file_name()
                ->compile_view()
                ->output_view();
    }

  }