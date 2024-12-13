<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-size: 16px; /* Base font size */
        }

        body {
            display: flex;
            flex-direction: column;
            font-size: 1.1rem; /* Increased base font size for body */
        }

        .container-fluid {
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 30px;
            padding-right: 30px;
        }

        header, footer {
            background-color: #02b0fa;
            padding: 15px;
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .table thead th {
            border-top: none;
        }

        /* Increase font size for various elements */
        h1 { font-size: 2.5rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.75rem; }
        .btn { font-size: 1.1rem; }
        .alert { font-size: 1.1rem; }
        .table { font-size: 1.1rem; }
    </style>
</head>
<body>

    <header>
        <h1 class="m-0">Manajemen Buku</h1>
    </header>

    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <footer>
        <p class="text-bold m-0">Manajemen Buku</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>