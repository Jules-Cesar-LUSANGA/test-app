<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Config::get('app.name'); }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
</head>
<body>
    <main class="flex h-screen items-center justify-center bg-white dark:bg-gray-900">
        <section>
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7" data-aos="fade-right" data-aos-delay="500" data-aos-duration="1000">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                        {{ Config::get('app.name'); }}
                    </h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        Passez vos évaluations en toute simplicité et en toute sécurité. Il suffit d'avoir le code de l'évaluation et de commencer à répondre aux questions.
                    </p>
                    
                    @guest
                        <x-primary-link href="{{ route('login') }}" class="rounded-3xl">
                            Se connecter
                        </x-primary-link>
                    @else
                        <x-primary-link href="{{ route('dashboard') }}" class="rounded-3xl">
                            Tableau de bord
                        </x-primary-link>
                    @endguest

                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex" data-aos="fade-left" data-aos-delay="500" data-aos-duration="1000">
                    <img src="{{ asset('assets/img/young-student-learning-library.jpg') }}" alt="mockup">
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>