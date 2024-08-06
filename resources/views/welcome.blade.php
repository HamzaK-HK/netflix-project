<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Uncomment this line if you need CSRF protection for your JavaScript apps --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Netflix</title>
        <!-- The 'icons' attribute is not valid for <link> tags, so it should be removed or corrected if it's meant to link to an icon -->
        <!-- Example: <link rel="icon" href="/n-logo.png" type="image/png"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Vite Scripts and Styles -->
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="font-sans">
        <div id="app"></div>
        {{-- <script src="https://js.stripe.com/v3/"></script> --}}
    </body>
</html>

