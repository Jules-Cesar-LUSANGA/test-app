@props(['name'])
<dialog id="{{ $name }}" class="rounded p-4">
	{{ $slot }}
</dialog>