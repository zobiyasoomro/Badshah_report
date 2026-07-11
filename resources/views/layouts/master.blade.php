<!-- In your main layout file (app.blade.php or similar) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional internal CSS for exact match */
        .navbar {
            padding: 0.75rem 0;
        }
        .nav-link {
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            color: #fbbf24 !important;
            transform: translateY(-1px);
        }
        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
        }
    </style>
</head>
<body>
    @include('components.navbar')
    
    @yield('content')
</body>
</html>