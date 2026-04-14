@props([
    'image',
    'imageAlt' => 'Thumb',
    'fileRef',
    'title',
    'author',
    'date',
    'href' => '#',
])

<a href="{{ $href }}" class="block p-8 border-r-2 border-b-2 border-black group cursor-pointer">
    <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all">
        <img src="{{ $image }}" class="w-full h-full object-cover" alt="{{ $imageAlt }}">
    </div>
    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: {{ $fileRef }}</span>
    <h3 class="font-black text-2xl uppercase leading-none mb-4 group-hover:text-red-600">{{ $title }}</h3>
    <div class="flex justify-between items-center">
        <span class="font-mono text-[10px] uppercase">Author: {{ $author }}</span>
        <span class="font-mono text-[10px] uppercase">{{ $date }}</span>
    </div>
</a>
