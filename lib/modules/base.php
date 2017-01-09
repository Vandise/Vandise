<?php

  namespace Modules;

  class Base
  {
    protected $view = null;
    protected $vandise = null;
    protected $helper_name = null;
    protected $stylesheets = array();
    protected $view_data = array();
    protected $view_name = null;
    protected $template_name = null;
    protected $compiled_view = null;

    public function __construct($vandise)
    {
      $this->vandise = $vandise;
      $this->view = (new \ActionView\Factory\ViewFactory)->newInstance();
      $this->view->setRegistries(
        new \ActionView\Registry\TemplateRegistry($this->vandise->views),
        new \ActionView\Registry\TemplateRegistry($this->vandise->templates)
      );
    }

    protected function set_view_name() : \Modules\Base
    {
      return $this;     
    }

    protected function set_template_name() : \Modules\Base
    {
      return $this;     
    }

    protected function get_view_data() : \Modules\Base
    {
      $helper = '\Helpers\\'.$helper_name;
      if (class_exists($helper))
      {
        $this->view_data = (new $helper())->run();
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
      return true;
    }

    public function run() : bool
    {
      return $this
                ->set_view_name()
                ->set_template_name()
                ->get_view_data()
                ->compile_view()
                ->output_view();
    }

  }