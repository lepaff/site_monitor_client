<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Website monitor client',
    'description' => 'Client for monitor extension',
    'category' => 'plugin',
    'author' => 'Michael Paffrath',
    'author_email' => 'michael.paffrath@gmail.com',
    'state' => 'alpha',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
