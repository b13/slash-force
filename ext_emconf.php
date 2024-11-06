<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Slash Forcer',
    'description' => 'Forces a slash on all URLs under a matching site configuration by redirecting.',
    'category' => 'fe',
    'state' => 'stable',
    'author' => 'Daniel Goerz',
    'author_email' => 'typo3@b13.com',
    'author_company' => 'b13 GmbH',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
