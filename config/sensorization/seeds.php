<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Main supported countries
    |--------------------------------------------------------------------------
    |
    | Description
    | 
    | 
    |
    */

	"countries" => ['United State', 'Bulgaria', 'Serbia', 'Ukraine', 'UK', 'Turkey', 'Japan', 'India'],

	/*
    |--------------------------------------------------------------------------
    | Super-admin & normal-admin
    |--------------------------------------------------------------------------
    |
    | Description
    | 
    | 
    |
    */

    "super_admin" => [
    	"name" => "super admin account",
    	"email_address" => "super-admin@sen.com",
    	"password" => "123456",
        "company_name" => "Demo Sensorization",
        "secret_question" => "",
        "secret_answer" => ""
    ],

    "normal_admin" => [
    	"name" => "normal admin account",
    	"email_address" => "normal-admin@sen.com",
    	"password" => "123456",
    	"roles" => [1, 3, 7],
    ],

    /*
    |--------------------------------------------------------------------------
    | Admins roles
    |--------------------------------------------------------------------------
    |
    | Description
    | 
    | 
    |
    */

    "admins_roles" => [
        [
            "name" => "create_products",
            "description" => "description of create_products"
        ],
        [
            "name" => "edit_products",
            "description" => "description of edit_products"
        ],
        [
            "name" => "delete_products",
            "description" => "description of delete_products"
        ],
        [
            "name" => "products_live_status",
            "description" => "description of products_live_status"
        ],
        [
            "name" => "products_carousel_controls",
            "description" => "description of products_carousel_controls"
        ],
        [
            "name" => "delete_users",
            "description" => "description of delete_users"
        ],
        [
            "name" => "carts_controls",
            "description" => "description of carts_controls"
        ],
        [
            "name" => "tags_controls",
            "description" => "description of tags_controls"
        ]
    ],

];