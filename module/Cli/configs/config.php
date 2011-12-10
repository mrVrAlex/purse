<?php
return array(
    'cli_bootstrap_class' => 'Cli\Bootstrap',
    'console_options' => array(
        'list-all|a' => 'List all defined routes',
        'match-route|m=s' => 'Match a route',
        'wm-exchange' => 'parse wm-exchanger'
    ),
    'Parse' => array('wm_exchange'=>array(
        'parse-url' => 'https://wm.exchanger.ru/asp/XMLWMList.asp?exchtype=7'
    )),
    'di' => array( 'instance' => array(
        'alias' => array(
            'cli' => 'Cli\Controller\Cli',
            'parse' => 'Cli\Controller\Parse'
        )
    )),
);
