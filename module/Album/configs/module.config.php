<?php

$default = array(
    'di' => array('instance' => array(
            'alias' => array(
                'album' => 'Album\Controller\AlbumController',
            ),
            'Album\Controller\AlbumController' => array(
                'parameters' => array(
                    'albums' => 'Album\Model\Albums',
                ),
            ),
            'Album\Model\Albums' => array(
                'parameters' => array(
                    'config' => 'Zend\Db\Adapter\Mysqli',
            )),
            'Zend\Db\Adapter\Mysqli' => array(
                'parameters' => array(
                    'config' => array(
                        'host' => 'localhost',
                        'username' => 'vronskiy_purse',
                        'password' => 'purse123',
                        'dbname' => 'vronskiy_purse',
                    ),
                ),
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options' => array(
                        'script_paths' => array(
                            'Album' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
    )),
);

// published environments
$production = $default;
$staging = $default;
$testing = $default;
$development = $default;

$config = compact('production', 'staging', 'testing', 'development');
return $config;
