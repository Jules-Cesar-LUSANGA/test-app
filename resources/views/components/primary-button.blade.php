<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-primary px-8 py-2 text-center font-medium text-white hover:bg-opacity-90 lg:px-6 xl:px-18']) }}>
    {{ $slot }}
</button>
