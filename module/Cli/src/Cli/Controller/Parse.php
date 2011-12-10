<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shandy
 * Date: 10.12.11
 * Time: 17:39
 * To change this template use File | Settings | File Templates.
 */
namespace Cli\Controller;

use Zend\Mvc\Controller\ActionController;

class Parse extends ActionController
{
    public function indexAction()
    {
        return array('content' => 'IT WORKS!');
    }

    public function wmExchangeAction()
    {
        //$di = $this->getLocator();
        $config = \Cli\Module::getConfig(); //$di->get('config');
        print_r($config->Parse->wm_exchange->toArray());
        
    }

}
