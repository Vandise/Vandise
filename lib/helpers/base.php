<?php

  namespace Helpers;

  abstract class Base
  {

    protected $vandise = null;
    protected $stylesheets = array();
    protected $javascripts = array();

    public function __construct($vandise)
    {
      $this->vandise = $vandise;      
    }

    public function add_stylesheet($href, $rel='stylesheet') : void
    {
      array_push($this->stylesheets,
        '<link rel="'.$rel.'" href="'.$href.'">');
    }

    public function add_javascript($href, $async=false) : void
    {
      array_push($this->javascripts,
        '<link async="'.$async.'" href="'.$href.'"></script>');      
    }

    public function stylesheet_tags() : string
    {
      return implode("\n", $this->stylesheets);
    }

    public function javascript_tags() : string
    {
      return implode("\n", $this->javascripts);
    }

    abstract public function resolve() : array;

  }