<?php

abstract class Controller
{
    protected $_defaultAction = 'index';
    protected $_model;


    public function __construct($model)
    {
        $this->_model = $model;
    }


    public function getDefaultAction()
    {
        return $this->_defaultAction;
    }


    public function setDefaultAction(string $actionName)
    {
        $this->_defaultAction = $actionName;
    }
}
