@props([
    'name' => 'file',
    'idPrefix' => 'file',
    'accept' => 'image/*',
    'dropText' => 'Drop file here or click to browse',
    'helperText' => null,
    'uploadButtonText' => 'Upload',
    'removeButtonText' => 'Remove',
    'emptyFileText' => 'No file selected',
    'invalidFileText' => 'Invalid file, please drop an image',
    'removeFieldName' => 'remove_file',
    'removeValue' => '0',
])

@php
    $dropzoneId = $idPrefix.'-dropzone';
    $inputId = $idPrefix.'-input';
    $fileNameId = $idPrefix.'-file-name';
    $uploadTriggerId = $idPrefix.'-upload-trigger';
    $removeTriggerId = $idPrefix.'-remove-trigger';
    $removeInputId = $idPrefix.'-remove-input';
@endphp

<div
    data-file-component
    data-empty-text="{{ $emptyFileText }}"
    data-invalid-text="{{ $invalidFileText }}"
    data-input-id="{{ $inputId }}"
    data-dropzone-id="{{ $dropzoneId }}"
    data-file-name-id="{{ $fileNameId }}"
    data-upload-trigger-id="{{ $uploadTriggerId }}"
    data-remove-trigger-id="{{ $removeTriggerId }}"
    data-remove-input-id="{{ $removeInputId }}"
    class="space-y-6 w-full"
>
    <x-ui.label id="{{ $dropzoneId }}" for="{{ $inputId }}" class="p-12 border-2 border-dashed border-zinc-900 dark:border-zinc-300 flex flex-col items-center justify-center space-y-4 hover:bg-gray-50 dark:hover:bg-zinc-900 transition-colors cursor-pointer">
        <iconify-icon icon="lucide:upload-cloud" class="text-4xl text-zinc-950 dark:text-zinc-50"></iconify-icon>
        <p class="font-mono text-xs font-black uppercase tracking-widest text-center">{{ $dropText }}</p>
        @if ($helperText)
            <p class="font-mono text-[10px] font-bold opacity-40 uppercase">{{ $helperText }}</p>
        @endif
    </x-ui.label>

    <x-ui.input id="{{ $inputId }}" type="file" name="{{ $name }}" accept="{{ $accept }}" class="hidden" />

    <p id="{{ $fileNameId }}" class="font-mono text-[10px] font-black uppercase opacity-40">
        {{ $emptyFileText }}
    </p>

    @error($name)
        <p class="font-mono text-[10px] font-black uppercase text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror

    <div class="flex flex-wrap gap-4">
        <x-ui.button type="button" id="{{ $uploadTriggerId }}" class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-8 py-3 font-mono text-xs font-black uppercase tracking-widest hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 border-2 border-zinc-900 dark:border-zinc-300 transition-all">{{ $uploadButtonText }}</x-ui.button>
        <x-ui.button type="button" id="{{ $removeTriggerId }}" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-3 font-mono text-xs font-black uppercase tracking-widest hover:bg-red-500 hover:text-white hover:border-red-500 transition-all text-zinc-950 dark:text-zinc-50">{{ $removeButtonText }}</x-ui.button>
        <x-ui.input type="hidden" name="{{ $removeFieldName }}" id="{{ $removeInputId }}" value="{{ $removeValue }}" />
    </div>
</div>
