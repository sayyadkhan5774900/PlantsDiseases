<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />

    </head>
    <body class="antialiased">
      

        <div class="container mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Diseases</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($diseases as $disease)
                        <li class="list-group-item h6">{{ $disease->title }}</li>
                        <p class="list-group-item">{{ $disease->description }}</p>
                    @endforeach
                </ul>
            </div>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </body>
</html>
