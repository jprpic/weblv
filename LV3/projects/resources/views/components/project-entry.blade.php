@props(['members'])

<div class="p-6 bg-white border-b border-gray-200">
    <span style="font-weight: bold; font-size: large">{{ $slot }}</span>
    <div>
        {{ $members ?? 'None' }}
    </div>
</div>


