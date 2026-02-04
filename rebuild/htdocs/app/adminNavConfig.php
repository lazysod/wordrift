<?php
// Navigation config for labels, order, and visibility
return [
    'Home' => [
        'label' => 'Home',
        'show' => true,
        'order' => 1,
        'url' => '/admin/dashboard',
    ],
    'Links' => [
        'label' => 'Links',
        'show' => true,
        'order' => 3,
        'url' => '/admin/links',
    ],
    '' => [
        'label' => 'Word List',
        'show' => true,
        'order' => 5,
        'url' => '/admin/words',
    ],
    'user_management' => [
        'label' => 'User Management',
        'show' => true,
        'order' => 2,
        'url' => '/admin/users/',
    ],
    'modules' => [
        'label' => 'Modules',
        'show' => true,
        'order' => 4,
        'url' => '/admin/modules',
        'children' => [
            'manage' => [
                'label' => 'Manage Modules',
                'url' => '/admin/modules',
                'show' => true
            ],
            'installer' => [
                'label' => 'Install New Module',
                'url' => '/admin/module-installer',
                'show' => true
            ]
        ]
    ]
    // ...other items
];
