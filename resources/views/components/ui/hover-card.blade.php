@props([
    'openDelay' => 200,
    'closeDelay' => 100,
    'side' => 'bottom',
    'align' => 'center',
    'sideOffset' => 8,
    'contentClass' => '',
])

@php
    $side = in_array($side, ['top', 'right', 'bottom', 'left'], true) ? $side : 'bottom';
    $align = in_array($align, ['start', 'center', 'end'], true) ? $align : 'center';
    $offset = max(0, (int) $sideOffset);

    $positionClass = match ($side) {
        'top' => 'bottom-full',
        'left' => 'right-full',
        'right' => 'left-full',
        default => 'top-full',
    };

    $alignClass = match ($side) {
        'top', 'bottom' => match ($align) {
            'start' => 'left-0',
            'end' => 'right-0',
            default => 'left-1/2 -translate-x-1/2',
        },
        default => match ($align) {
            'start' => 'top-0',
            'end' => 'bottom-0',
            default => 'top-1/2 -translate-y-1/2',
        },
    };

    $offsetStyle = match ($side) {
        'top' => "margin-bottom: {$offset}px;",
        'left' => "margin-right: {$offset}px;",
        'right' => "margin-left: {$offset}px;",
        default => "margin-top: {$offset}px;",
    };
@endphp

<div
    data-hover-card-root
    data-open-delay="{{ (int) $openDelay }}"
    data-close-delay="{{ (int) $closeDelay }}"
    {{ $attributes->class(['relative inline-block']) }}
>
    <div data-hover-card-trigger>
        {{ $trigger ?? '' }}
    </div>

    <div
        data-hover-card-content
        role="dialog"
        aria-hidden="true"
        class="pointer-events-none absolute {{ $positionClass }} {{ $alignClass }} z-50 w-80 rounded-md border border-zinc-200 bg-white p-4 text-zinc-950 opacity-0 scale-95 shadow-md outline-none transition-all duration-150 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 {{ $contentClass }}"
        style="{{ $offsetStyle }}"
    >
        {{ $content ?? '' }}
    </div>
</div>

@once
    <script>
        (function () {
            if (window.__hoverCardInitDone) return;
            window.__hoverCardInitDone = true;

            const roots = () => Array.from(document.querySelectorAll('[data-hover-card-root]'));

            const show = (root) => {
                const content = root.querySelector('[data-hover-card-content]');
                if (!content) return;
                content.classList.remove('pointer-events-none', 'opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');
                content.setAttribute('aria-hidden', 'false');
            };

            const hide = (root) => {
                const content = root.querySelector('[data-hover-card-content]');
                if (!content) return;
                content.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
                content.classList.remove('opacity-100', 'scale-100');
                content.setAttribute('aria-hidden', 'true');
            };

            roots().forEach((root) => {
                if (root.dataset.hoverCardReady === '1') return;
                root.dataset.hoverCardReady = '1';

                const trigger = root.querySelector('[data-hover-card-trigger]');
                const content = root.querySelector('[data-hover-card-content]');
                if (!trigger || !content) return;

                let openTimer = null;
                let closeTimer = null;
                const openDelay = Number(root.dataset.openDelay || 120);
                const closeDelay = Number(root.dataset.closeDelay || 100);

                const queueShow = () => {
                    if (closeTimer) clearTimeout(closeTimer);
                    openTimer = setTimeout(() => show(root), openDelay);
                };

                const queueHide = () => {
                    if (openTimer) clearTimeout(openTimer);
                    closeTimer = setTimeout(() => hide(root), closeDelay);
                };

                [trigger, content].forEach((el) => {
                    el.addEventListener('mouseenter', queueShow);
                    el.addEventListener('mouseleave', queueHide);
                    el.addEventListener('focusin', queueShow);
                    el.addEventListener('focusout', queueHide);
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.key !== 'Escape') return;
                roots().forEach(hide);
            });
        })();
    </script>
@endonce
