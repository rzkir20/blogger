function initTagEditor(config) {
    const addButton = document.getElementById(config.addButtonId);
    const wrapper = document.getElementById(config.wrapperId);

    if (!addButton || !wrapper) {
        return;
    }

    function bindRemoveActions() {
        wrapper.querySelectorAll('.tag-remove-btn').forEach(function (button) {
            if (button.dataset.bound === 'true') {
                return;
            }

            button.dataset.bound = 'true';
            button.addEventListener('click', function () {
                const row = button.closest('.flex');
                if (!row) {
                    return;
                }

                if (wrapper.children.length === 1) {
                    const input = row.querySelector('input[name="tags[]"]');
                    if (input) {
                        input.value = '';
                    }
                    return;
                }

                row.remove();
            });
        });
    }

    addButton.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'flex items-center gap-2';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'tags[]';
        input.placeholder = 'e.g. laravel';
        input.className = 'w-full p-5 brutalist-border bg-transparent font-mono text-sm transition-all brutalist-input';
        if (config.tagListId) {
            input.setAttribute('list', config.tagListId);
        }

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'brutalist-btn tag-remove-btn';
        removeButton.textContent = 'Delete';

        row.appendChild(input);
        row.appendChild(removeButton);
        wrapper.appendChild(row);
        bindRemoveActions();
    });

    bindRemoveActions();
}

function initFileComponents() {
    const components = document.querySelectorAll('[data-file-component]');

    components.forEach(function (component) {
        const input = document.getElementById(component.dataset.inputId || '');
        const dropzone = document.getElementById(component.dataset.dropzoneId || '');
        const fileName = document.getElementById(component.dataset.fileNameId || '');
        const uploadTrigger = document.getElementById(component.dataset.uploadTriggerId || '');
        const removeTrigger = document.getElementById(component.dataset.removeTriggerId || '');
        const removeInput = document.getElementById(component.dataset.removeInputId || '');
        const emptyText = component.dataset.emptyText || 'No file selected';
        const invalidText = component.dataset.invalidText || 'Invalid file, please drop an image';

        if (!input) {
            return;
        }

        if (uploadTrigger) {
            uploadTrigger.addEventListener('click', function () {
                input.click();
            });
        }

        input.addEventListener('change', function () {
            const selectedFile = input.files && input.files[0] ? input.files[0] : null;

            if (!selectedFile) {
                if (fileName) {
                    fileName.textContent = emptyText;
                }
                return;
            }

            if (fileName) {
                fileName.textContent = selectedFile.name;
            }

            if (removeInput) {
                removeInput.value = '0';
            }
        });

        if (dropzone) {
            ['dragenter', 'dragover'].forEach(function (eventName) {
                dropzone.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    dropzone.classList.add('bg-gray-100', 'dark:bg-zinc-800');
                });
            });

            ['dragleave', 'drop'].forEach(function (eventName) {
                dropzone.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    dropzone.classList.remove('bg-gray-100', 'dark:bg-zinc-800');
                });
            });

            dropzone.addEventListener('drop', function (event) {
                const droppedFiles = event.dataTransfer?.files;
                if (!droppedFiles || droppedFiles.length === 0) {
                    return;
                }

                const droppedFile = droppedFiles[0];
                if (!droppedFile.type.startsWith('image/')) {
                    if (fileName) {
                        fileName.textContent = invalidText;
                    }
                    return;
                }

                const transfer = new DataTransfer();
                transfer.items.add(droppedFile);
                input.files = transfer.files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        }

        if (removeTrigger && removeInput) {
            removeTrigger.addEventListener('click', function () {
                removeInput.value = '1';
                input.value = '';
                if (fileName) {
                    fileName.textContent = 'File will be removed';
                }
            });
        }
    });
}

function initPostService() {
    initTagEditor({ addButtonId: 'add-tag-create', wrapperId: 'tags-wrapper-create', tagListId: 'post-create-tags-list' });
    initTagEditor({ addButtonId: 'add-tag-edit', wrapperId: 'tags-wrapper-edit', tagListId: 'post-edit-tags-list' });
    initFileComponents();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPostService);
} else {
    initPostService();
}
