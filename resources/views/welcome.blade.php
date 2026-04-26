<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRM Application</title>
        @vite(['resources/scss/app.scss', 'resources/ts/app.ts'])
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-4 text-primary mb-4">Professional CRM</h1>
                    <p class="lead">Environment setup complete with Laravel, TypeScript, and Bootstrap.</p>
                    <button class="btn btn-primary btn-lg mt-3">Get Started</button>
                </div>
            </div>
        </div>
    </body>
</html>
