<?php
return array(
    'di' => array(

        'instance' => array(
            'alias' => array(
                'contact' => 'Contact\Controller\ContactController',
            ),
            'Contact\Controller\ContactController' => array(
                'parameters' => array(
                    'contactTable' => 'Contact\Model\ContactTable',
                ),
            ),
            'Contact\Model\ContactTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),
            'Zend\Db\Adapter\Adapter' => array(
                'parameters' => array(
                    'driver' => array(
                        'driver' => 'Pdo',
                        'dsn'            => 'mysql:dbname=zf2tutorial;hostname=localhost',
                        'username'       => 'root',
                        'password'       => 'root',
                        'driver_options' => array(
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                        ),
                    ),
                )
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'contact' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);
