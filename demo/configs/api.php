<?php
return array(
    'type' => 'hessian',
    'http' => array(
        'url' => 'http://192.168.1.120:8080/ssh-rest/sshmobile.json',
        'timeout' => 30
    ),
    'hessian' => array(
        'zookeeperAddress' => '192.168.1.120:2181',
        'dubboAddress' => array(
            array(
                'ip' => '192.168.1.246:20892',
                'weight' => 5
            ),
            array(
                'ip' => '192.168.1.121:20891',
                'weight' => 5
            )
        ),
        'type' => 'dubbo',
        'timeout' => 15
    )
)?>


