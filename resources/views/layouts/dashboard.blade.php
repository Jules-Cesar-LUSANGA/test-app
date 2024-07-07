@props([
    'pageTitle',
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
    <link rel="icon" href="favicon.ico">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}" >
    <!-- ===== Preloader Start ===== -->
    
    <div
        x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black" >
        
        <div
            class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"
        >
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        
        <x-dashboard.aside></x-dashboard.aside>

        <!-- ===== Content Area Start ===== -->
        <div
        class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
        >
        <x-dashboard.header></x-dashboard.header>
        <main>
            <div class="mx-auto max-w-screen-2xl px-4 py-3 md:px-6 md:py-4 2xl:px-10 2xl:py-8">
                <x-flash-notifications />
                <div>
                    <div class="">
                        <h2 class="flex justify-between items-center font-bold mb-3 text-black dark:text-white">
                            <p class="text-title-md2">{!! $pageTitle !!}</p>
                            
                            @if ($pageLinkText != null)
                                <a 
                                    href="{{ $pageLinkUrl }}"
                                    class="inline-flex text-lg p-2 items-center justify-center bg-primary text-center font-medium text-white hover:bg-opacity-90"
                                    >
                                    {{ $pageLinkText }}
                                </a>
                            @else
                                @isset($pageButton)
                                    {{ $pageButton }}
                                @endisset
                            @endif
                        </h2>
                    </div>

                    <div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>
  <script defer src="{{ asset('bundle.js') }}"></script></body>
</html>
