<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shandy
 * Date: 10.12.11
 * Time: 17:39
 * To change this template use File | Settings | File Templates.
 */
namespace Cli\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\Http\Client;


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
        $c = $config->Parse->wm_exchange->toArray();
        $client = new \Zend\Http\Client($c['parse-url']);

        $objXml = new \Zend\Config\Xml($client->send()->getBody());
        $queryArray = $objXml->WMExchnagerQuerys->query->toArray();

        $getIdinArray = function($item){ return $item['id']; };

        $queryIds = array_map($getIdinArray,$queryArray);
        
        //$table = new WmexchangQuery();
        $rowsArray = array(array('id' => 7057038)); //$table->find($queryIds)->toArray();
        if (count($rowsArray)>0) {
            $rowsId = array_map($getIdinArray,$rowsArray); //
            $uniqId = array_diff($queryIds,$rowsId);
        } else {
            $uniqId = $queryIds;
        }
        //Table->beginTransansion()
        foreach ($queryArray as $key => $value){
            if (!in_array($value['id'],$uniqId)) continue;
            unset($value['allamountin']);
            $value['type_id'] = 7;
            $value['adddate'] = new \Zend\Db\Expr('NOW()');
            //$table->insert($value);
        }

        print_r($queryIds);
        print_r('--------------');
        print_r($uniqId);

        
    }

}
