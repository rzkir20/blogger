<button
    type="button"
    data-theme-toggle
    data-theme-on="false"
    role="switch"
    aria-label="{{ $label ?? 'Toggle dark mode' }}"
    aria-checked="false"
    {{ $attributes->merge([
        'class' => 'theme-switch h-8 w-14 shrink-0',
    ]) }}
>
    <span class="theme-switch__track"></span>
    <span class="theme-switch__thumb">
        <svg data-theme-icon-sun class="theme-switch__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <circle cx="12" cy="12" r="4"></circle>
            <line x1="12" y1="2" x2="12" y2="5"></line>
            <line x1="12" y1="19" x2="12" y2="22"></line>
            <line x1="2" y1="12" x2="5" y2="12"></line>
            <line x1="19" y1="12" x2="22" y2="12"></line>
            <line x1="4.93" y1="4.93" x2="7.05" y2="7.05"></line>
            <line x1="16.95" y1="16.95" x2="19.07" y2="19.07"></line>
            <line x1="16.95" y1="7.05" x2="19.07" y2="4.93"></line>
            <line x1="4.93" y1="19.07" x2="7.05" y2="16.95"></line>
        </svg>
        <svg data-theme-icon-moon class="theme-switch__icon theme-switch__icon--hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3c.5 0 .75.6.39.95A7 7 0 0 0 20.05 12.4c.35-.36.95-.11.95.39Z"></path>
        </svg>
    </span>
</button>

@once
    <style>
        .theme-switch {
            position: relative;
            display: inline-flex;
            padding: 0;
            border: 1px solid #d4d4d8;
            border-radius: 9999px;
            background: #e4e4e7;
            cursor: pointer;
            transition: background-color 180ms ease, border-color 180ms ease;
        }

        .theme-switch__track {
            position: absolute;
            inset: 0;
            border-radius: 9999px;
        }

        .theme-switch__thumb {
            position: absolute;
            top: 3px;
            left: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 9999px;
            background: #ffffff;
            color: #3f3f46;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.18);
            transition: left 180ms ease, background-color 180ms ease, color 180ms ease;
        }

        .theme-switch__icon {
            font-size: 12px;
            line-height: 1;
        }

        .theme-switch__icon--hidden {
            display: none;
        }

        .theme-switch[data-theme-on='true'] {
            background: #27272a;
            border-color: #3f3f46;
        }

        .theme-switch[data-theme-on='true'] .theme-switch__thumb {
            left: calc(100% - 27px);
            background: #09090b;
            color: #e4e4e7;
        }
    </style>

    <script>
        (function () {
            function isDarkModeEnabled() {
                const root = document.getElementById('root');
                return document.body.classList.contains('dark-mode') || Boolean(root && root.classList.contains('dark-mode'));
            }

            function setSwitchState(isDarkMode) {
                document.querySelectorAll('[data-theme-toggle]').forEach(function (toggleButton) {
                    const sunIcon = toggleButton.querySelector('[data-theme-icon-sun]');
                    const moonIcon = toggleButton.querySelector('[data-theme-icon-moon]');

                    toggleButton.dataset.themeOn = isDarkMode ? 'true' : 'false';
                    toggleButton.setAttribute('aria-checked', isDarkMode ? 'true' : 'false');

                    if (sunIcon) {
                        sunIcon.classList.toggle('theme-switch__icon--hidden', isDarkMode);
                    }

                    if (moonIcon) {
                        moonIcon.classList.toggle('theme-switch__icon--hidden', !isDarkMode);
                    }
                });
            }

            function toggleTheme() {
                const root = document.getElementById('root');
                document.body.classList.toggle('dark-mode');

                if (root) {
                    root.classList.toggle('dark-mode');
                }

                setSwitchState(isDarkModeEnabled());
            }

            document.addEventListener('click', function (event) {
                const toggleButton = event.target.closest('[data-theme-toggle]');
                if (!toggleButton) {
                    return;
                }

                toggleTheme();
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function () {
                    setSwitchState(isDarkModeEnabled());
                });
            } else {
                setSwitchState(isDarkModeEnabled());
            }
        })();
    </script>
@endonce
