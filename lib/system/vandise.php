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
      }
      return static::$instance;
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