@props(['members','id'])

<div class="p-6 bg-white border-b border-gray-200">
    <a href="./project/{{ $id }}"><span style="font-weight: bold; font-size: large">{{ $slot }}</span></a>
    <div>
        {{ $members ?? 'None' }}
    </div>
</div>


