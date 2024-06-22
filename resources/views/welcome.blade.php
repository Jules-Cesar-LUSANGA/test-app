<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Config::get('app.name'); }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main>
        <section class="grid grid-cols-2 gap-6 h-screen">
            <div class="flex items-center">
                <article class="p-2">
                    <h2 class="font-bold text-2xl">APP NAME</h2>
                    <p class="text-lg my-3">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam ad amet beatae recusandae atque placeat impedit fugit dolore. Sunt deserunt libero, vero eos dolores et quibusdam ea veritatis voluptatum qui.
                    </p>
                    <a href="{{ route('login') }}" class="text-white bg-black hover:bg-gray-700 font-black p-3 inline-block rounded-md">Se connecter</a>
                </article>
            </div>
            <div class="bg-blue-500">
            </div>
        </section>
    </main>
</body>
</html>