<?php

/**
 * Redirect the user to a different URL.
 * 
 * @param string $url The URL to redirect to.
 */
function redirectTo($url)
{
    header("Location: $url");
    exit; // It's important to stop further script execution after a redirect.
}

/**
 * Render a view or template file.
 * 
 * @param string $path The path to the view or template file.
 * @param array $data The data to pass to the view (optional).
 * @param bool $templates Whether to use the templates folder or views folder (optional, defaults to false).
 */
function render($path, $data = [], $templates = false)
{
    // If templates are enabled, load from the "templates" folder.
    // Otherwise, load from the "views" folder.
    if ($templates) {
        require "App/templates/$path.php";
    } else {
        require "App/views/$path.php";
    }
}