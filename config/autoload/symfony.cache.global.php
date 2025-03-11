<?php

declare(strict_types=1);

return [
    'cache' => [
        'symfony' => [
            'filesystem' => [
                'namespace_prefix' => 'cycle',
                'default_ttl' => 0,
                'directory' => 'data/cache/cycle'
            ]
        ]
    ],
];