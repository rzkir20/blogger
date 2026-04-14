function initProfileService() {
    const root = document.getElementById('root');
    const modeToggleButton = document.getElementById('writer-mode-toggle');
    const profileForm = document.getElementById('writer-profile-form');
    const submitButton = document.getElementById('profile-submit-button');
    const submitLabel = document.getElementById('profile-submit-label');
    const submitSpinner = document.getElementById('profile-submit-spinner');
    const avatarPreview = document.getElementById('profile-avatar-preview');
    const avatarFileComponent = document.querySelector('[data-file-component][data-input-id="profile-avatar-input"]');

    if (!profileForm) {
        return;
    }

    const fallbackAvatarUrl = avatarPreview?.dataset.fallbackAvatarUrl || '';
    const avatarInput = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.inputId) : null;
    const avatarDropzone = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.dropzoneId) : null;
    const avatarFileName = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.fileNameId) : null;
    const uploadTrigger = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.uploadTriggerId) : null;
    const removeAvatarTrigger = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.removeTriggerId) : null;
    const removeAvatarInput = avatarFileComponent ? document.getElementById(avatarFileComponent.dataset.removeInputId) : null;
    const emptyFileText = avatarFileComponent?.dataset.emptyText || 'No file selected';
    const invalidFileText = avatarFileComponent?.dataset.invalidText || 'Invalid file, please drop an image';

    if (modeToggleButton && root) {
        modeToggleButton.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            root.classList.toggle('dark-mode');
        });
    }

    if (uploadTrigger && avatarInput) {
        uploadTrigger.addEventListener('click', function () {
            avatarInput.click();
        });
    }

    if (avatarInput) {
        avatarInput.addEventListener('change', function () {
            const selectedFile = avatarInput.files && avatarInput.files[0] ? avatarInput.files[0] : null;

            if (!selectedFile) {
                if (avatarFileName) {
                    avatarFileName.textContent = emptyFileText;
                }
                return;
            }

            if (avatarFileName) {
                avatarFileName.textContent = selectedFile.name;
            }

            if (removeAvatarInput) {
                removeAvatarInput.value = '0';
            }

            if (avatarPreview) {
                avatarPreview.src = URL.createObjectURL(selectedFile);
            }
        });
    }

    if (avatarDropzone && avatarInput) {
        ['dragenter', 'dragover'].forEach(function (eventName) {
            avatarDropzone.addEventListener(eventName, function (event) {
                event.preventDefault();
                event.stopPropagation();
                avatarDropzone.classList.add('bg-gray-100', 'dark:bg-zinc-800');
            });
        });

        ['dragleave', 'drop'].forEach(function (eventName) {
            avatarDropzone.addEventListener(eventName, function (event) {
                event.preventDefault();
                event.stopPropagation();
                avatarDropzone.classList.remove('bg-gray-100', 'dark:bg-zinc-800');
            });
        });

        avatarDropzone.addEventListener('drop', function (event) {
            const droppedFiles = event.dataTransfer?.files;
            if (!droppedFiles || droppedFiles.length === 0) {
                return;
            }

            const droppedFile = droppedFiles[0];
            if (!droppedFile.type.startsWith('image/')) {
                if (avatarFileName) {
                    avatarFileName.textContent = invalidFileText;
                }
                return;
            }

            const transfer = new DataTransfer();
            transfer.items.add(droppedFile);
            avatarInput.files = transfer.files;
            avatarInput.dispatchEvent(new Event('change', { bubbles: true }));
        });
    }

    if (removeAvatarTrigger && removeAvatarInput) {
        removeAvatarTrigger.addEventListener('click', function () {
            removeAvatarInput.value = '1';
            if (avatarInput) {
                avatarInput.value = '';
            }
            if (avatarFileName) {
                avatarFileName.textContent = 'Avatar will be removed';
            }
            if (avatarPreview) {
                avatarPreview.src = fallbackAvatarUrl;
            }
        });
    }

    if (submitButton && submitLabel && submitSpinner) {
        profileForm.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitLabel.textContent = 'Saving...';
            submitSpinner.classList.remove('hidden');
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProfileService);
} else {
    initProfileService();
}
