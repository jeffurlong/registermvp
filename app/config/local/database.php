<?php
$slug = subdomain() ?: 'www';

return array(

    'connections' => array(
        'default' => 'default',


        'default' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'registermvp_dev_'.$slug,
            'username'  => 'mvp_site',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        'root' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'registermvp_dev_demo',
            'username'  => 'root',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),







    ),
);
