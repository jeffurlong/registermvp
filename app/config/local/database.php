<?php
$slug = Request::subdomain() ?: 'main';

return array(

    'connections' => array(

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'mvpreg_dev_'.$slug,
            'username'  => 'mvp_site',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

    ),
);
