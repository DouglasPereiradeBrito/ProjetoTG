<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Prateleira Digital',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Prateleira</b>Digital',

    'logo_mini' => '<b>P</b>D',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'green',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        [
            'text'      => 'Funcionário',
            'icon'      => 'address-card',
            'can'       => 'SCA', 'L',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => 'usuario/cadastrar'
                ],
                [
                    'text'  => 'Listar',
                    'url'   => 'usuario/listar' 
                ]
            ]   
        ],
        [
            'text'        => 'Marca',
            'icon'        => 'star',
            'can'       => 'SCA', 'L',
            'submenu' => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => '/marca/cadastrar',
                    'can'       => 'SCA'
                ],
                [
                    'text'  => 'Listar',
                    'url'   => '/marca/listar',
                    'can'       => 'L'
                ]
            ]
        ],
        [
            'text'      => 'Categoria',
            'icon'      => 'shirtsinbulk',
            'can'       => 'SCA', 'L',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => '/categoria/cadastrar'
                ],
                [
                    'text'  => 'Listar',
                    'url'   => 'categoria/listar'
                ]
            ]
        ],
        [
            'text'      => 'Gôndola',
            'icon'      => 'map',
            'can'       => 'SCA', 'L',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => 'gondola/cadastrar'
                ],
                [
                    'text'  => 'Listar',
                    'url'   => 'gondola/listar'
                ]
            ]
        ],
        [
            'text'      => 'Sessão',
            'icon'      => 'map-pin',
            'can'       => 'SCA', 'L',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => 'sessao/cadastrar'
                ],
                [
                    'text'  => 'Listar',
                    'url'   => 'sessao/listar'
                ]
            ]
        ],
        [
            'text'      => 'Produto',
            'icon'      => 'archive',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => 'produto/cadastrar',
                    'can'       => 'SCA'
                ],
                [   
                    'text'  => 'Listar',
                    'url'   => 'produto/listar',
                    'can'       => 'L'
                ]
            ]
        ],
        [   
            'text'      => 'Tag',
            'icon'      => 'tags',
            'submenu'   => [
                [
                    'text'  => 'Cadastrar',
                    'url'   => 'tag/cadastrar'
                ]
            ]
        ],
        [
            'text'      => 'Histórico',
            'icon'      => 'database',
            'can'       => 'SCA', 'L',
            'submenu'   => [
                [
                    'text'  => 'Listar',
                    'url'   => 'historico/listar'
                ]
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
    ],
];