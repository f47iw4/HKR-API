<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI', 
            ],

            'routes' => [
                /*
                 * Ruta para acceder a la interfaz de documentación de la API
                 */
                'api' => 'api/documentation', 
            ],

            'swagger_ui' => [
                'enabled' => env('SWAGGER_UI_ENABLED', true),
                'path' => 'swagger-ui', 
            ],

            'paths' => [

                    /*
                    * Ruta absoluta al lugar donde se almacenarán las anotaciones analizadas.
                    */
                    'docs' => storage_path('storage/api-docs/api-docs.json'),
                
                    'annotations' => [
                    base_path('app'),
                    base_path('app/Http/Controllers/API/ProductoController.php'),
                    base_path('app/Http/Controllers'),
                    base_path('app/Models'),
                ],


                    /*
                    * Ruta absoluta al directorio donde se exportarán las vistas.
                    */
                    'views' => base_path('resources/views/vendor/l5-swagger'),

                    'urls' => [
                        [
                            'url' => env('APP_URL') . '/api/documentation', 
                            'description' => 'API Documentation'
                        ],
                    ],

                    
                    'base' => env('L5_SWAGGER_BASE_PATH', null),

                    
                    'excludes' => [],  
                ],


                /*
                 * Ruta donde se almacenarán los archivos generados de Swagger
                 */
                'docs' => storage_path('api-docs'), // Aquí se almacenarán los archivos docs generados (json/yaml)

                /*
                 * Directorios que contienen las anotaciones de Swagger
                 */
                'annotations' => [
                    base_path('app'),
                ],

                /*
                 * Ruta para los archivos UI de Swagger
                 */
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                /*
                 * Usar rutas absolutas en los archivos de Swagger UI
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * Ruta base para la generación de la documentación
                 */
                'base' => env('L5_SWAGGER_BASE_PATH', null),

                /*
                 * Nombre del archivo JSON que contendrá la documentación generada
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * Nombre del archivo YAML que contendrá la documentación generada
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Formato de documentación a utilizar en la UI (json o yaml)
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),
            ],
        ],

    'defaults' => [
        'routes' => [
            /*
             * Rutas para acceder a la documentación generada de la API
             */
            'api' => 'api/documentation',
            'docs' => 'api/docs',
            'ui' => 'api/docs/ui', // Ruta para Swagger UI
        ],

        'publish' => [
            'config' => [
                'l5-swagger.php' => config_path('l5-swagger.php'),
                ],
            'views' => [
                'swagger-ui.blade.php' => resource_path('views/vendor/l5-swagger/swagger-ui.blade.php'),
            ],
        ],


        /*
         * Ruta de devolución de llamada para OAuth2
         */
        'oauth2_callback' => 'api/oauth2-callback',

        /*
         * Middleware para prevenir accesos inesperados a la documentación de la API
         */
        'middleware' => [
            'api' => [],
            'asset' => [],
            'docs' => [],
            'oauth2_callback' => [],
        ],

        /*
         * Opciones para el grupo de rutas
         */
        'group_options' => [],
        
        /*
         * Rutas de documentación
         */
        'urls' => [
            [
                'url' => env('APP_URL') . '/api/documentation', // URL base para la documentación
                'description' => 'API Documentation'
            ],
        ],

        /*
         * Directorios para escanear las anotaciones de Swagger
         */
        'scanOptions' => [
    'exclude' => [],  // Directorios a excluir del escaneo

    /*
     * Configuración de procesadores predeterminados para las anotaciones
     */
    'default_processors_configuration' => [],

    /*
     * Versión de la especificación OpenAPI a generar
     */
    'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION),

    /*
     * Configuración del analizador
     */
    'analyser' => null,

    /*
     * Configuración del análisis
     */
    'analysis' => null,

    /*
     * Personalización de procesadores
     */
    'processors' => [],

    /*
     * Patrón de archivos a escanear
     */
    'pattern' => '*.php',  
],

    ],

    /*
     * API security definitions. Se generará en el archivo de documentación.
     */
    'securityDefinitions' => [
        'securitySchemes' => [
            /*
             * Puedes agregar ejemplos de seguridad como OAuth2 o API Key
             */
        ],
        'security' => [
            /*
             * Definición de seguridad para la API
             */
        ],
        
    ],

    'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

    
    'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

 
    'proxy' => false,

    /*
     * URL de configuración adicional para cargar configuración externa de Swagger
     */
    'additional_config_url' => null,

    /*
     * Ordenación de las operaciones en la lista de la API (por defecto no se aplica orden)
     */
    'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

    /*
     * URL del validador para la UI de Swagger
     */
    'validator_url' => null,

    /*
     * Configuración para la UI de Swagger
     */
    'ui' => [
        'display' => [
            'dark_mode' => env('L5_SWAGGER_UI_DARK_MODE', false),
            /*
             * Controla la expansión predeterminada de las operaciones y las etiquetas
             */
            'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),

            /*
             * Activar o desactivar el filtro para las operaciones
             */
            'filter' => env('L5_SWAGGER_UI_FILTERS', true),
        ],

        'authorization' => [
            'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),

            'oauth2' => [
                /*
                 * Si se establece a true, añade PKCE al flujo de AuthorizationCodeGrant
                 */
                'use_pkce_with_authorization_code_grant' => false,
            ],
        ],
    ],

    /*
     * Definición de constantes que pueden ser usadas en las anotaciones
     */
    'constants' => [
        'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
    ],
];
