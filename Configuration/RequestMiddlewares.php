<?php

return [
    'frontend' => [
        'b13/slash_force/slash-forcer' => [
            'target' => \B13\SlashForce\Middleware\SlashForcer::class,
            'before' => [
                'typo3/cms-workspaces/preview-permissions',
                'typo3/cms-frontend/tsfe',
            ],
            'after' => [
                'typo3/cms-frontend/page-resolver',
                'typo3/cms-frontend/page-argument-validator',
            ],
        ],
    ],
];
