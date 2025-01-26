<?php

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/termwind.php';

use function Termwind\render;

if ($argc > 1) {
    $type    = $argv[1];
    $message = $argv[2];
    $error   = $argv[3] ?? null;

    renderCLI($message, $type, $error);
}

/**
 * render success message
 */
function renderCLI(
    string $message,
    string $type,
    ?string $error
): void {
    switch ($type) {
        case 'success':
            $icon = '✔️';

            break;
        case 'error':
            $icon = '❌';

            break;
        default:
            $icon = '⚠️';

            break;
    }

    $contentError = $error ? "<code>{$error}</code>" : '';

    render(<<<HTML
        <div class="my-1">
            <span class="px-1 mx-1"> $icon </span>
            <span>{$message}</span>
            {$contentError}
        </div>
    HTML);
}
