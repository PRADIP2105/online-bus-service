<!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>{{ $title ?? config('app.name', 'Online Bus Service') }}</title>
       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <body class="antialiased">
       <div class="min-h-screen bg-gray-100">
           @include('layouts.navigation')
           <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
               @yield('content')
           </main>
       </div>
   </body>
   </html>