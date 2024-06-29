<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
 
    @livewireStyles
    <style>
        .btn-google {
    display: inline-block;
    background-color: #dd4b39; 
    color: #fff;
    border-radius: 4px;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-google:hover {
    background-color: #c23321;
}

.btn-google i {
    margin-right: 10px;
}
.btn-phonepe {
    display: inline-block;
    background-color: #ffcc33;
    color: #000;
    border-radius: 4px;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-phonepe:hover {
    background-color: #e6b800;
}

.btn-phonepe img {
    width: 20px; /* Adjust size as needed */
    vertical-align: middle;
    margin-right: 10px;
}

    </style>
</head>
<body>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

 
    @yield('script')
    @livewireScripts
</body>
</html>