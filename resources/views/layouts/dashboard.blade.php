@props([
    'pageTitle' => null,
    'pageLinkText' => null,
    'pageLinkUrl'  => null
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ Config::get('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="favicon.ico">
    <style>
        @font-face {
            font-family: 'Montserrat';
            src : url("{{ asset('assets/fonts/Montserrat-VariableFont_wght.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        * {
            font-family: Montserrat, sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    



    <x-dashboard.header></x-dashboard.header>
      
    <x-dashboard.aside></x-dashboard.aside>
      
    <div class="my-8 p-4 sm:ml-64">

        <x-flash-notifications></x-flash-notifications>

        @isset($pageTitle)
                            
            <h1 class="flex justify-between items-center font-bold text-2xl mb-3">
                <p>{!! $pageTitle !!}</p>
                
                @if ($pageLinkText != null)
                    <x-primary-link href="{{ $pageLinkUrl }}">
                        {{ $pageLinkText }}
                    </x-primary-link>
                @else
                    @isset($pageButton)
                        {{ $pageButton }}
                    @endisset
                @endif
            </h1>

        @endisset

        {{ $slot }}
    </div>
      
  
</body>
</html>
