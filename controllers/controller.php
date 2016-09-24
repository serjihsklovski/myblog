<?php

abstract class Controller
{
    protected $_defaultAction = 'index';


    public function getDefaultAction()
    {
        return $this->_defaultAction;
    }


    public function setDefaultAction(string $actionName)
    {
        $this->_defaultAction = $actionName;
    }
}
