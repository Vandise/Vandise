<?php

  namespace System;

  class Vandise
  {

    protected static $instance = null;
    protected $data = array();

    private function __construct(){}

    public static function get_instance() : \System\Vandise
    {
      if (!isset(static::$instance))
      {
        static::$instance = new static;
        static::$instance->data['modules'] = array();
      }
      return static::$instance;
    }

    public function add_module($module) : void
    {
      array_push(static::$instance->data['modules'],
        $module);
    }

    public function __set($name, $value) : void
    {
      static::$instance->data[$name] = $value;
    }

    public function __get($name)
    {
      return static::$instance->data[$name];
    }

  }