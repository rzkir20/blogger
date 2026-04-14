@props([
    'name',
    'value' => '',
    'id' => null,
    'placeholder' => 'Write content here...',
])

@php
    $editorId = $id ?: 'quill-editor-'.str()->random(8);
@endphp

@once
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <style>
        .quill-editor-shell .ql-toolbar.ql-snow,
        .quill-editor-shell .ql-container.ql-snow {
            border-color: #000;
        }

        .quill-editor-shell .ql-container {
            min-height: 220px;
            background: #fff;
            color: #18181b;
        }
    </style>
    <script>
        (function () {
            function initQuillEditor(wrapper) {
                if (!wrapper || wrapper.dataset.initialized === 'true') {
                    return;
                }

                const editorElement = wrapper.querySelector('[data-quill-root]');
                const inputElement = wrapper.querySelector('textarea[data-quill-input]');
                if (!editorElement || !inputElement || typeof Quill === 'undefined') {
                    return;
                }

                const imageInput = wrapper.querySelector('input[data-quill-image-input]');
                const videoInput = wrapper.querySelector('input[data-quill-video-input]');

                function insertMediaFromFile(file, embedType) {
                    if (!file) {
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const result = event.target?.result;
                        if (typeof result !== 'string') {
                            return;
                        }

                        const range = quill.getSelection(true);
                        const index = range ? range.index : quill.getLength();
                        quill.insertEmbed(index, embedType, result, 'user');
                        quill.setSelection(index + 1, 0, 'silent');
                    };
                    reader.readAsDataURL(file);
                }

                const quill = new Quill(editorElement, {
                    theme: 'snow',
                    placeholder: wrapper.dataset.placeholder || 'Write content here...',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            ['blockquote', 'code-block', 'link', 'image', 'video'],
                            ['clean'],
                        ],
                        handlers: {
                            image: function () {
                                if (imageInput) {
                                    imageInput.click();
                                }
                            },
                            video: function () {
                                if (videoInput) {
                                    videoInput.click();
                                }
                            },
                        },
                    },
                });

                if (imageInput) {
                    imageInput.addEventListener('change', function () {
                        const [file] = imageInput.files || [];
                        insertMediaFromFile(file, 'image');
                        imageInput.value = '';
                    });
                }

                if (videoInput) {
                    videoInput.addEventListener('change', function () {
                        const [file] = videoInput.files || [];
                        insertMediaFromFile(file, 'video');
                        videoInput.value = '';
                    });
                }

                const initialValue = inputElement.value;
                if (initialValue) {
                    quill.root.innerHTML = initialValue;
                }

                quill.on('text-change', function () {
                    inputElement.value = quill.root.innerHTML;
                });

                wrapper.dataset.initialized = 'true';
            }

            function initializeAllQuillEditors() {
                document.querySelectorAll('[data-quill-editor]').forEach(initQuillEditor);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeAllQuillEditors);
            } else {
                initializeAllQuillEditors();
            }

            window.addEventListener('load', initializeAllQuillEditors);
        })();
    </script>
@endonce

<div
    data-quill-editor
    data-placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'space-y-2 quill-editor-shell']) }}
>
    <textarea name="{{ $name }}" data-quill-input class="hidden">{{ $value }}</textarea>
    <input type="file" accept="image/*" data-quill-image-input class="hidden">
    <input type="file" accept="video/*" data-quill-video-input class="hidden">
    <div id="{{ $editorId }}" data-quill-root class="bg-white text-zinc-950"></div>
</div>
