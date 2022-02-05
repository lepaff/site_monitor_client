<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Website monitor client',
    'description' => 'Client for monitor extension',
    'category' => 'plugin',
    'author' => 'Michael Paffrath',
    'author_email' => 'michael.paffrath@gmail.com',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
