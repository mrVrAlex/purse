<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController;

class IndexController extends ActionController
{
    public function indexAction()
    {
        $di = $this->getLocator();
        //$app = $di->get('application');
        //print_r($di);
        return array();
    }
}
