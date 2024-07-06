@session('error')
    <div class="font-bold bg-blue-100 mt-1 text-red-500 p-4 border-l-4 border-red-600"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 5000)"
    >
        {{ session('error') }}
    </div>
@endsession

@session('success')
    <div class="font-bold bg-blue-100 mt-1 text-blue-500 p-4 border-l-4 border-blue-600"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 5000)"
    >
        {{ session('success') }}
    </div>
@endsession