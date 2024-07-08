<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center bg-black px-8 py-2 text-center rounded-md font-medium text-white hover:bg-opacity-90 lg:px-6 xl:px-18']) }}>
    {{ $slot }}
</button>
