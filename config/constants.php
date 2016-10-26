<?php
return [
    'roles' => [
        'user'          => 1,
        'developer'     => 2,
        'moderator'     => 3,
        'administrator' => 4
    ],

    'permissions' => [
        'remove_user'       => 4,
        'add_role'          => 4,
        'edit_role'         => 4,
        'change_role'       => 4,
        'remove_role'       => 4,

        'edit_profile'      => 3,
        'add_category'      => 3,
        'edit_category'     => 3,
        'remove_category'   => 3,
        'ban_user'          => 3,
        'edit_image'        => 3,
        'remove_image'      => 3,
        'remove_rating'     => 3,
        'admin_controls'    => 3,
        'see_banned'        => 3
    ]
];