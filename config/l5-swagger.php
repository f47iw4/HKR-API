<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
                // Aquí añades la anotación @OA\Info
                'info' => [
                    'title' => 'My API', // Título del API
                    'version' => '1.0.0', // Versión del API
                    'description' => 'API para manejar productos y servicios', // Descripción del API
                    'termsOfService' => 'https://example.com/terms', // (opcional) Enlace a términos de servicio
                    'contact' => [
                        'email' => 'support@example.com', // Correo de contacto (opcional)
                    ],
                    'license' => [
                        'name' => 'MIT', // Licencia (opcional)
                        'url' => 'https://opensource.org/licenses/MIT', // URL de la licencia (opcional)
                    ],
                ],
            ],

            'routes' => [
                /*
                 * Route for accessing api documentation interface
                 */
                'api' => 'api/documentation',
            ],
            'generate_always' => env('SWAGGER_GENERATE_ALWAYS', true),
            'annotations' => [
                base_path('app/Swagger/swagger-info.php'),
                base_path('app/Swagger'),
                base_path('routes/api.php'),
                base_path('app/Http/Controllers/API'),
            ],

            'paths' => [
                /*
                 * Edit to include full URL in UI for assets
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * Edit to set path where swagger UI assets should be stored
                 */
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                /*
                 * File name of the generated json documentation file
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * File name of the generated YAML documentation file
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Set this to `json` or `yaml` to determine which documentation file to use in UI
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Absolute paths to directory containing the swagger annotations are stored.
                 */
                'annotations' => [
                    base_path('app'),
                ],

                /*
                 * Directory where the documentation files should be saved.
                 */
                'docs' => storage_path('api-docs'),

                /*
                 * Optionally exclude some directories from being scanned for annotations
                 */
                'excludes' => [
                    base_path('vendor'), // Directorio que se desea excluir, vendor es ejemplo
                ],

                /*
                 * Base path for the documentation generation (por ejemplo, el directorio raíz del proyecto)
                 */
                'base' => base_path(),
            ],
        ],
    ],
    'defaults' => [
        //...
    ],
];
