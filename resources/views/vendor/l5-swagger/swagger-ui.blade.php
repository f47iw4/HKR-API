<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.51.1/swagger-ui.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.51.1/swagger-ui-bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.51.1/swagger-ui-standalone-preset.js"></script>
</head>
<body>
    <div id="swagger-ui"></div>
    <script>
        const ui = SwaggerUIBundle({
            url: 'storage/api-docs/api-docs.json',  
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIBundle.presets.oauth2
            ],
            layout: "StandaloneLayout"  
        })
    </script>
</body>
</html>
