<?php

  namespace Helpers;

  abstract class Base
  {

    protected $vandise = null;

    public function __construct($vandise)
    {
      $this->vandise = $vandise;      
    }

    abstract public function resolve() : array;

  }