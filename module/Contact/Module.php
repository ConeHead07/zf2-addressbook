<?php

namespace Contact;

use Zend\Form\View\HelperLoader as FormHelperLoader;
use Contact\Model\ContactTable;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfiguration()
    {
        return array(
            'factories' => array(
                'contact-table' =>  function($sm) {
                    $dbAdapter = $sm->get('db-adapter');
                    $table = new ContactTable($dbAdapter);
                    return $table;
                },
            ),
        );
    }

}
