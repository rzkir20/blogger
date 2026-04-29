function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') || '' : '';
}

function setHidden(el, hidden) {
    if (!el) return;
    el.classList.toggle('hidden', hidden);
}

function showWriterAiError(message) {
    const errorEl = document.getElementById('writer-ai-error');
    if (!errorEl) return;
    errorEl.textContent = message;
    setHidden(errorEl, !message);
}

async function fetchActiveWriterAiConfigurations() {
    const res = await fetch('/writer/ai-configurations/active', {
        method: 'GET',
        headers: { Accept: 'application/json' },
    });

    if (!res.ok) {
        throw new Error('Gagal memuat konfigurasi AI.');
    }

    return res.json();
}

async function generateWriterAiDraft({ configurationId, prompt }) {
    const csrfToken = getCsrfToken();

    const res = await fetch('/writer/ai/generate', {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            configuration_id: configurationId,
            prompt,
        }),
    });

    const data = await res.json().catch(() => ({}));
    if (!res.ok) {
        const baseMsg = data?.error ? String(data.error) : 'Gagal generate draft dari AI.';
        const statusText = res && typeof res.status === 'number' ? ` (HTTP ${res.status})` : '';

        // backend biasanya kirim: { error: string, details: string|object }
        const details = data?.details ?? data;
        let detailsText = '';
        if (details) {
            if (typeof details === 'string') {
                detailsText = details;
            } else {
                try {
                    detailsText = JSON.stringify(details);
                } catch (e) {
                    detailsText = String(details);
                }
            }
        }

        const msg = detailsText
            ? `${baseMsg}${statusText}\n${detailsText}`
            : `${baseMsg}${statusText}`;

        throw new Error(msg.slice(0, 2000));
    }

    return data;
}

function bindWriterAiDialog(dialog) {
    if (!dialog || dialog.dataset.writerAiDialogBound === 'true') return;
    dialog.dataset.writerAiDialogBound = 'true';

    const openDialog = function () {
        dialog.classList.remove('hidden');
        dialog.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');
    };

    const closeDialog = function () {
        dialog.classList.add('hidden');
        dialog.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-dialog-trigger="writer-with-ai-dialog"]').forEach(function (trigger) {
        if (trigger.dataset.dialogUiBound === 'true') return;
        trigger.dataset.dialogUiBound = 'true';
        trigger.addEventListener('click', openDialog);
    });

    dialog.querySelectorAll('[data-dialog-close]').forEach(function (closer) {
        closer.addEventListener('click', closeDialog);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !dialog.classList.contains('hidden')) {
            closeDialog();
        }
    });
}

function tryParseJson(text) {
    if (typeof text !== 'string') return null;
    const trimmed = text.trim();
    if (!trimmed) return null;

    try {
        return JSON.parse(trimmed);
    } catch (e) {
        // Try extract the first JSON object inside text
        const match = trimmed.match(/\{[\s\S]*\}/);
        if (!match) return null;
        try {
            return JSON.parse(match[0]);
        } catch (e2) {
            return null;
        }
    }
}

function extractJsonStringField(text, key) {
    const escapedKey = key.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const match = text.match(new RegExp(`"${escapedKey}"\\s*:\\s*"([\\s\\S]*?)"\\s*(,|\\})`));
    if (!match || !match[1]) return '';

    return match[1]
        .replace(/\\"/g, '"')
        .replace(/\\\\/g, '\\')
        .trim();
}

function extractJsonArrayField(text, key) {
    const escapedKey = key.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const match = text.match(new RegExp(`"${escapedKey}"\\s*:\\s*\\[([\\s\\S]*?)\\]`));
    if (!match || !match[1]) return [];

    return match[1]
        .split(',')
        .map(function (item) {
            return item.trim().replace(/^"/, '').replace(/"$/, '');
        })
        .map(function (item) {
            return item
                .replace(/\\"/g, '"')
                .replace(/\\\\/g, '\\')
                .trim();
        })
        .filter(Boolean);
}

function tryParseDraft(text) {
    const parsed = tryParseJson(text);
    if (parsed && typeof parsed === 'object') return parsed;

    if (typeof text !== 'string') return null;
    const trimmed = text.trim();
    if (!trimmed.startsWith('{')) return null;

    const fallbackDraft = {
        title: extractJsonStringField(trimmed, 'title'),
        category: extractJsonStringField(trimmed, 'category'),
        description: extractJsonStringField(trimmed, 'description'),
        thumbnail_image: extractJsonStringField(trimmed, 'thumbnail_image'),
        content_image: extractJsonStringField(trimmed, 'content_image'),
        image: extractJsonStringField(trimmed, 'image'),
        content: extractJsonStringField(trimmed, 'content'),
        tags: extractJsonArrayField(trimmed, 'tags'),
    };

    const hasAnyField = Object.values(fallbackDraft).some(function (value) {
        if (Array.isArray(value)) return value.length > 0;
        return Boolean(value);
    });

    return hasAnyField ? fallbackDraft : null;
}

function dispatchInputEvent(el) {
    if (!el) return;
    el.dispatchEvent(new Event('input', { bubbles: true }));
    el.dispatchEvent(new Event('change', { bubbles: true }));
}

function normalizeTags(tags) {
    if (Array.isArray(tags)) {
        return tags
            .map(function (tag) {
                return typeof tag === 'string' ? tag.trim() : String(tag || '').trim();
            })
            .filter(Boolean);
    }

    if (typeof tags === 'string') {
        return tags
            .split(',')
            .map(function (tag) {
                return tag.trim();
            })
            .filter(Boolean);
    }

    return [];
}

function deriveTagsFromDraft(draft) {
    const candidates = [
        draft?.category ? String(draft.category) : '',
        draft?.title ? String(draft.title) : '',
        draft?.description ? String(draft.description) : '',
    ]
        .join(' ')
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/gi, ' ')
        .split(/\s+/)
        .filter(Boolean)
        .filter(function (word) {
            return word.length >= 4;
        });

    const seen = new Set();
    const result = [];
    for (let i = 0; i < candidates.length; i += 1) {
        const word = candidates[i];
        if (seen.has(word)) continue;
        seen.add(word);
        result.push(word);
        if (result.length >= 5) break;
    }

    return result;
}

function normalizeDraftData(draft) {
    if (!draft || typeof draft !== 'object') return null;

    const normalizedTags = normalizeTags(draft.tags);
    const fallbackTags = deriveTagsFromDraft(draft);

    return {
        ...draft,
        tags: normalizedTags.length ? normalizedTags : fallbackTags,
    };
}

function renderTagInput(tag, listId) {
    const listAttr = listId ? ` list="${listId}"` : '';
    return `
        <div class="flex items-center gap-2">
            <input
                type="text"
                name="tags[]"
                value="${tag.replace(/"/g, '&quot;')}"
                class="w-full p-5 brutalist-border bg-transparent font-mono text-sm transition-all brutalist-input"
                placeholder="e.g. laravel"${listAttr}
            >
            <button type="button" class="brutalist-btn tag-remove-btn">Delete</button>
        </div>
    `;
}

function bindTagRemoveActions(wrapper) {
    if (!wrapper) return;

    wrapper.querySelectorAll('.tag-remove-btn').forEach(function (button) {
        if (button.dataset.bound === 'true') return;

        button.dataset.bound = 'true';
        button.addEventListener('click', function () {
            const row = button.closest('.flex');
            if (!row) return;

            if (wrapper.children.length === 1) {
                const input = row.querySelector('input[name="tags[]"]');
                if (input) {
                    input.value = '';
                    dispatchInputEvent(input);
                }
                return;
            }

            row.remove();
        });
    });
}

function applyTagsToForm(tags) {
    const normalizedTags = normalizeTags(tags);
    const wrapper = document.getElementById('tags-wrapper-create') || document.getElementById('tags-wrapper-edit');
    if (!wrapper) return;

    const listId = wrapper.id === 'tags-wrapper-create' ? 'post-create-tags-list' : 'post-edit-tags-list';
    const tagsToRender = normalizedTags.length ? normalizedTags : [''];

    wrapper.innerHTML = tagsToRender
        .map(function (tag) {
            return renderTagInput(tag, listId);
        })
        .join('');

    wrapper.querySelectorAll('input[name="tags[]"]').forEach(function (input) {
        dispatchInputEvent(input);
    });

    bindTagRemoveActions(wrapper);
}

function formatAiDraftPreview(draft) {
    const title = draft?.title ? String(draft.title) : '';
    const category = draft?.category ? String(draft.category) : '';
    const description = draft?.description ? String(draft.description) : '';
    const thumbnailImage = draft?.thumbnail_image ? String(draft.thumbnail_image) : '';
    const contentImage = draft?.content_image ? String(draft.content_image) : '';
    const content = draft?.content ? String(draft.content) : '';
    const tags = normalizeTags(draft?.tags);

    return [
        title ? `Title: ${title}` : null,
        category ? `Category: ${category}` : null,
        description ? `Description: ${description}` : null,
        thumbnailImage ? `Thumbnail Image: ${thumbnailImage}` : null,
        contentImage ? `Content Image: ${contentImage}` : null,
        tags.length ? `Tags: ${tags.join(', ')}` : null,
        content ? `Content:\n${content}` : null,
    ].filter(Boolean).join('\n\n');
}

function escapeHtml(text) {
    return String(text)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

function normalizeContentHtml(content) {
    if (!content) return '';

    const normalized = String(content).trim();
    if (!normalized) return '';

    if (/<\/?(h1|h2|h3|p)\b/i.test(normalized)) {
        return normalized;
    }

    return normalized
        .replace(/\r\n/g, '\n')
        .split(/\n\s*\n+/)
        .map(function (block) {
            const text = block.trim();
            if (!text) return '';
            return `<p>${escapeHtml(text).replace(/\n/g, '<br>')}</p>`;
        })
        .filter(Boolean)
        .join('');
}

function normalizeImageUrl(image) {
    const value = typeof image === 'string' ? image.trim() : '';
    if (!value) return '';

    // Guard: reject the old hardcoded sample image URL.
    if (value === 'https://images.pexels.com/photos/37191585/pexels-photo-37191585.jpeg') {
        return '';
    }

    if (/^https:\/\/images\.pexels\.com\/.+/i.test(value)) {
        return value;
    }

    return '';
}

function resolveContentImageUrl(draft) {
    return normalizeImageUrl(draft?.content_image) || normalizeImageUrl(draft?.image);
}

function resolveThumbnailImageUrl(draft) {
    return normalizeImageUrl(draft?.thumbnail_image) || normalizeImageUrl(draft?.content_image) || normalizeImageUrl(draft?.image);
}

function updateThumbnailPreview(draft, previewEl, previewWrapEl) {
    if (!previewEl || !previewWrapEl) return;

    const thumbnailUrl = resolveThumbnailImageUrl(draft);
    if (!thumbnailUrl) {
        previewEl.removeAttribute('src');
        setHidden(previewWrapEl, true);
        return;
    }

    previewEl.src = thumbnailUrl;
    setHidden(previewWrapEl, false);
}

function buildEditorContent(draft) {
    const image = resolveContentImageUrl(draft);
    const content = normalizeContentHtml(draft?.content);
    const imageBlock = image ? `<p><img src="${image.replace(/"/g, '&quot;')}" alt="${escapeHtml(draft?.title || 'AI image')}"></p>` : '';

    return `${imageBlock}${content}`;
}

async function applyThumbnailToForm(draft) {
    const thumbnailUrl = resolveThumbnailImageUrl(draft);
    if (!thumbnailUrl) return;

    const thumbnailInput = document.querySelector('input[type="file"][name="thumbnail"]');
    if (!thumbnailInput) return;

    const csrfToken = getCsrfToken();
    const response = await fetch('/writer/ai/proxy-image', {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ url: thumbnailUrl }),
    });

    const data = await response.json().catch(() => ({}));
    if (!response.ok) {
        const error = data?.error ? String(data.error) : `Gagal mengambil thumbnail dari URL AI (HTTP ${response.status}).`;
        throw new Error(error);
    }

    const base64 = typeof data?.data_base64 === 'string' ? data.data_base64 : '';
    if (!base64) {
        throw new Error('Respons proxy thumbnail tidak valid.');
    }

    const binary = atob(base64);
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < binary.length; i += 1) {
        bytes[i] = binary.charCodeAt(i);
    }

    const contentType = typeof data?.content_type === 'string' ? data.content_type : 'image/jpeg';
    const blob = new Blob([bytes], { type: contentType });
    if (!contentType.startsWith('image/')) {
        throw new Error('URL thumbnail AI bukan file gambar yang valid.');
    }

    const extension = (contentType.split('/')[1] || 'jpg').replace(/[^a-z0-9]/gi, '').toLowerCase() || 'jpg';
    const file = new File([blob], `ai-thumbnail.${extension}`, { type: contentType });
    const transfer = new DataTransfer();
    transfer.items.add(file);

    thumbnailInput.files = transfer.files;
    dispatchInputEvent(thumbnailInput);

    const fileComponent = thumbnailInput.closest('[data-file-component]');
    if (fileComponent) {
        const fileNameId = fileComponent.dataset.fileNameId || '';
        const removeInputId = fileComponent.dataset.removeInputId || '';
        const fileNameEl = fileNameId ? document.getElementById(fileNameId) : null;
        const removeInput = removeInputId ? document.getElementById(removeInputId) : null;

        if (fileNameEl) {
            fileNameEl.textContent = file.name;
        }
        if (removeInput) {
            removeInput.value = '0';
        }
    }
}

async function applyAiDraftToForm(draft) {
    const title = draft?.title ? String(draft.title) : '';
    const category = draft?.category ? String(draft.category) : '';
    const description = draft?.description ? String(draft.description) : '';
    const content = buildEditorContent(draft);

    const titleInput = document.querySelector('input[name="title"]');
    if (titleInput && title) {
        titleInput.value = title;
        dispatchInputEvent(titleInput);
    }

    const categoryInput = document.querySelector('input[name="category"]');
    if (categoryInput && category) {
        categoryInput.value = category;
        dispatchInputEvent(categoryInput);
    }

    const descriptionTextarea = document.querySelector('textarea[name="description"]');
    if (descriptionTextarea && description) {
        descriptionTextarea.value = description;
        dispatchInputEvent(descriptionTextarea);
    }

    // For Quill editor: textarea[data-quill-input] is submitted; update it too.
    const contentTextarea = document.querySelector('textarea[name="content"][data-quill-input]');
    if (contentTextarea && content) {
        contentTextarea.value = content;
        dispatchInputEvent(contentTextarea);

        const editorWrapper = contentTextarea.closest('[data-quill-editor]');
        const quillRoot = editorWrapper ? editorWrapper.querySelector('[data-quill-root]') : null;
        if (quillRoot) {
            quillRoot.innerHTML = content;
            quillRoot.dispatchEvent(new Event('input', { bubbles: true }));
        }
    }

    applyTagsToForm(draft?.tags);
    await applyThumbnailToForm(draft);
}

async function initWriterWithAiDialog() {
    const dialog = document.getElementById('writer-with-ai-dialog');
    if (!dialog) return;

    const selectEl = document.getElementById('writer-ai-configuration-select');
    const noConfigEl = document.getElementById('writer-ai-no-config');
    const promptEl = document.getElementById('writer-ai-prompt');
    const outputEl = document.getElementById('writer-ai-output');
    const generateBtn = document.getElementById('writer-ai-generate-btn');
    const applyBtn = document.getElementById('writer-ai-apply-btn');
    const thumbnailPreviewEl = document.getElementById('writer-ai-thumbnail-preview');
    const thumbnailPreviewWrapEl = document.getElementById('writer-ai-thumbnail-preview-wrap');

    if (!selectEl || !promptEl || !outputEl || !generateBtn || !applyBtn) return;

    let latestDraft = null;

    const hydrateConfigurations = async function () {
        setHidden(noConfigEl, true);
        selectEl.innerHTML = '<option value="">Loading configurations...</option>';

        try {
            const data = await fetchActiveWriterAiConfigurations();
            const configs = data?.configurations || [];

            if (!configs.length) {
                selectEl.innerHTML = '<option value="">No active configurations</option>';
                setHidden(noConfigEl, false);
                return;
            }

            selectEl.innerHTML = configs
                .map(function (conf) {
                    const label = conf.ai_models ? conf.ai_models : 'Unnamed model';
                    const status = conf.status ? String(conf.status) : '';
                    const statusSuffix = status ? ` (${status})` : '';
                    return `<option value="${conf.id}">${label}${statusSuffix}</option>`;
                })
                .join('');
        } catch (e) {
            showWriterAiError(e && e.message ? e.message : 'Gagal memuat konfigurasi AI.');
            selectEl.innerHTML = '<option value="">Failed to load</option>';
        }
    };

    bindWriterAiDialog(dialog);
    await hydrateConfigurations();

    applyBtn.addEventListener('click', async function () {
        if (!latestDraft) {
            showWriterAiError('Belum ada draft AI yang bisa diisi ke form.');
            return;
        }

        showWriterAiError('');
        const previousText = applyBtn.textContent;
        applyBtn.disabled = true;
        applyBtn.textContent = 'Applying...';

        try {
            await applyAiDraftToForm(latestDraft);
        } catch (e) {
            showWriterAiError(e && e.message ? e.message : 'Gagal mengisi draft ke form.');
        } finally {
            applyBtn.disabled = false;
            applyBtn.textContent = previousText;
        }
    });

    generateBtn.addEventListener('click', async function () {
        showWriterAiError('');
        latestDraft = null;
        applyBtn.disabled = true;
        updateThumbnailPreview(null, thumbnailPreviewEl, thumbnailPreviewWrapEl);

        const configurationId = selectEl.value;
        const prompt = (promptEl.value || '').trim();

        if (!configurationId) {
            showWriterAiError('Pilih konfigurasi AI terlebih dahulu.');
            return;
        }

        if (!prompt) {
            showWriterAiError('Instruction / topic wajib diisi.');
            return;
        }

        const previousText = generateBtn.textContent;
        generateBtn.disabled = true;
        generateBtn.textContent = 'Generating...';

        try {
            const data = await generateWriterAiDraft({ configurationId, prompt });
            const rawOutput = data?.output ? String(data.output) : '';
            const parsed = normalizeDraftData(tryParseDraft(rawOutput));

            if (parsed && typeof parsed === 'object') {
                latestDraft = parsed;
                applyBtn.disabled = false;
                outputEl.value = formatAiDraftPreview(parsed);
                updateThumbnailPreview(parsed, thumbnailPreviewEl, thumbnailPreviewWrapEl);
            } else {
                outputEl.value = rawOutput;
            }
        } catch (e) {
            showWriterAiError(e && e.message ? e.message : 'Gagal generate draft.');
        } finally {
            generateBtn.disabled = false;
            generateBtn.textContent = previousText;
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWriterWithAiDialog);
} else {
    initWriterWithAiDialog();
}