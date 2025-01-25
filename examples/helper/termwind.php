<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use function Termwind\render;

/**
 * render success message
 */
function renderSuccess(string $message, string $gateway, ?string $content = ''): void
{
    $aditionalContent = $content ? "<hr><code>{$content}</code>" : '';

    render(<<<HTML
        <div class="my-1">
            <span class="px-1 mx-1 bg-indigo-800">{$gateway}</span>
            <span>{$message}</span>
            {$aditionalContent}
        </div>
    HTML);
}

/**
 * render error message
 */
function renderError(string $message, string $gateway, ?string $content): void
{
    $aditionalContent = $content ? "<hr><code>{$content}</code>" : '';

    render(<<<HTML
        <div class="my-1">
            <span class="px-1 mx-1 bg-red">{$gateway}</span>
            <span>{$message}</span>
            {$aditionalContent}
        </div>
    HTML);
}

/**
 * render info message
 */
function renderMessage(string $message, string $gateway, ?string $content): void
{
    $aditionalContent = $content ? "<hr><code>{$content}</code>" : '';

    render(<<<HTML
        <div class="my-1">
            <span class="px-1 mx-1 bg-green">{$gateway}</span>
            <span>{$message}</span>
            {$aditionalContent}
        </div>
    HTML);
}
