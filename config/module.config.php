<?php
namespace AdminPlus;

use Psr\Container\ContainerInterface;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
];