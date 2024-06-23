@props([
    'title',
    'code',
    'duration',
    'description'
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! $title !!}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-mono p-5 bg-gray-300">
    <div class="bg-white p-4">
        <header class="font-bold border-b-2 border-black">
            <section class="flex justify-between">
                <div>
                    <h2>Noms : {{ Auth::user()->name }}</h2>
                </div>
                <div>
                    <h2>Date : {{ date('d/m/Y') }}</h2>
                </div>
            </section>

            <section class="text-center">
                <h1 class="text-2xl">{!! $title !!}</h1>
                <p>Code : {{ $code }}</p>
                <p>Durée : {{ $duration }} mins</p>
                <p class="font-normal mb-3">
                    {!! $description !!}
                </p>
            </section>

        </header>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>