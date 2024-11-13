<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Sistema de Compensações',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Sis - </b>Comp',
    'logo_img' => 'vendor/adminlte/dist/img/ins03.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SisComp',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-secondary',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card card-outline card-danger',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn bg-lightblue',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-danger elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false,
    'password_reset_url' => false,
    'password_email_url' => false,
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */


    'menu' => [

        // Sidebar items:
        [
            'text' => 'DASHBOARD',
            'url'  => 'home',
            'icon' => 'fas fa-fw fa-chalkboard',
        ],
        [
            'text' => 'CADASTROS',
            'icon' => 'fas fa-fw fa-keyboard',
            'can'  => 'is_user',
            'submenu' => [
                               
                [
                    'text' => 'Fonte',
                    'icon' => 'fas fa-fw fa-hospital',
                    'url'  => 'fontes/list',
                    'can'  => 'is_admin',
                ], 
                [
                    'text' => 'Gestão',
                    'url' => 'gestaos/list',
                    'icon' => 'fas fa-fw fa-network-wired', // Ícone de gráfico para gestão
                    'can' => 'is_admin',
                ],
                [
                    'text' => 'Gerência',
                    'url' => 'gerencias/list',
                    'icon' => 'fas fa-fw fa-network-wired', // Ícone de tarefas para gerência
                    'can' => 'is_admin',
                ],
                [
                    'text' => 'Secretária',
                    'icon' => 'fas fa-fw fa-users',
                    'url'  => 'administracaos/list',
                    'can'  => 'is_admin',
                ], [
                    'text' => 'Recepção',
                    'icon' => 'fas fa-fw fa-users',
                    'url'  => 'recepcaos/list',
                    'can'  => 'is_admin',
                ],  
                [
                    'text' => 'Projecto',
                    'icon' => 'fas fa-fw fa-window-restore',
                    'url'  => 'projectos/list',
                    'can'  => 'is_admin',
                ],
                [
                    'text' => 'Participante',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'participantes/list',
                    'can'  => 'is_user'
                ],
                
            ]
        ],
        [
            'text' => 'OPERAÇÕES',
            'icon' => 'fas fa-fw fa-code',
            'can'  => 'is_user',
            'submenu' => [
                [
                    'text' => 'Proposta',
                    'icon' => 'fas fa-fw fa-file', // Alterado para ícone de documento
                    'url'  => 'propostas/list',
                    'can'  => 'is_admin',
                ],
                
                [
                    'text' => 'Desembolso do INS',
                    'icon' => 'fas fa-fw fa-credit-card',// Ícone alterado para representar transação
                    'url'  => 'desembolsoinsfontes/lis',
                    'can'  => 'is_admin',
                ], 
                [
                    'text' => 'Desembolso à DAF',
                    'icon' => 'fas fa-fw fa-credit-card', // Ícone alterado para representar transação
                    'url'  => 'desembolsodafs/list',
                    'can'  => 'is_admin',
                ],
                [
                    'text' => 'Desembolso à CISPOC',
                    'icon' => 'fas fa-fw fa-credit-card', // Ícone alterado para representar transação
                    'url'  => 'desembolsos/list',
                    'can'  => 'is_admin',
                ], 
                [
                    'text' => 'Distribuição',
                    'icon' => 'fas fa-fw fa-money-bill',
                    'url'  => 'distribuicaos/list',
                    'can'  => 'is_admin',
                ], 
                [
                    'text' => 'Requisição Recepão',
                    'icon' => 'fas fa-fw fa-file', // Alterado para ícone de documento
                    'url'  => 'requisicaos/list',
                    'can'  => 'is_user',
                ], 
                [
                    'text' => 'Requisição CISPOC',
                    'icon' => 'fas fa-fw fa-file', // Alterado para ícone de documento
                    'url'  => 'requisicaocispos/list',
                    'can'  => 'is_admin',
                ], 
                
                [
                    'text' => 'Despesas',
                    'icon' => 'fas fa-fw fa-money-bill',
                    'url'  => 'dispensas/list',
                    'can'  => 'is_user',
                ],
            ]
        ],
        [
            'text' => 'RELATORIOS',
            'icon' => 'fas fa-fw fa-chart-pie',
            'can'  => 'is_admin',
            'submenu' => [
                [
                    'text' => 'Projecto',
                    'icon' => 'fas fa-fw fa-window-restore',
                    'submenu' => [
                        [
                            //'text' => 'Por Local', // TINHA => ANUAL
                            'text' => 'Por Projecto',
                            'url'  => 'relatorios/projecto/ano',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                        [
                            //'text' => 'Por Projecto', // TINHA => TODOS PROJECTOS
                            'text' => 'Por Local',
                            'url'  => 'relatorios/projecto/anos',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                    ],
                ],
                [
                    'text' => 'DAF',
                    'icon' => 'fas fa-fw fa-user',
                    'submenu' => [
                        [
                            'text' => 'Por Projecto',
                            'url'  => 'relatorios/fontedaf/ano',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                        
                        [
                            'text' => 'Por Local',
                            'url'  => 'relatorios/fontedaf/anos',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                    ],
                ],

                [
                    'text' => 'Secretária',
                    'icon' => 'fas fa-fw fa-user',
                    'submenu' => [
                        [
                            'text' => 'Por Projectos',
                            'url'  => 'relatorios/administracao/ano',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                        [
                            'text' => 'Todos os Projecto',
                            'url'  => 'relatorios/administracao/anos',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                    ],
                ],
                [
                    'text' => 'Recepção',
                    'icon' => 'fas fa-fw fa-user',
                    'submenu' => [
                        
                        [
                            'text' => 'Por Projecto',
                            'url'  => 'relatorios/recepcao/anos',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                        [
                            'text' => 'Por Local',
                            'url'  => 'relatorios/recepcao/ano',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                    ],
                ],
                
                [
                    'text' => 'Participante',
                    'icon' => 'fas fa-fw fa-calendar',
                    'submenu' => [
                        [
                            'text' => 'Por Projecto',
                            'url'  => 'relatorios/participanteDN/anoN',
                            'icon' => 'fas fa-fw fa-calendar',
                        ],
                        //[
                        //   'text' => 'Por Local',
                        //    'url'  => 'relatorios/participanteDV/anoV',
                        //    'icon' => 'fas fa-fw fa-calendar',
                        //],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Users',
            'url'  => 'users/list',
            'icon' => 'fas fa-fw fa-user',
            'can'  => 'is_super',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
