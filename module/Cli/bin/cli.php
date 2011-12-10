<?php
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_patz
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/../../../vendor'),
    realpath(__DIR__ . '/../../../vendor/ZendFramework/library'),
    get_include_path(),
)));

require_once 'Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array()));

$appConfig = include __DIR__ . '/../../../config/application.config.php';

$modules = $appConfig['modules'];
$modules[] = 'Cli';

$moduleLoader = new Zend\Loader\ModuleAutoloader($appConfig['module_paths']);
$moduleLoader->register();

$moduleManager = new Zend\Module\Manager($appConfig['modules']);
$listenerOptions = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
$moduleManager->setDefaultListenerOptions($listenerOptions);
$moduleManager->getConfigListener()->addConfigGlobPath(dirname(__DIR__) . '/config/autoload/*.config.php');
$moduleManager->loadModules();



// Get the merged config object
$config = $moduleManager->getMergedConfig();

// Create application, bootstrap, and run

$bootstrap = new $config->cli_bootstrap_class($config);
$application = new Cli\Application;
$bootstrap->bootstrap($application);
$application->run();
//$application->run()->send();