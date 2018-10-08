<?php

function dd($item) {
    echo "<pre style='background: #222;color: #54ff00;padding: 20px;'>";
    print_r($item);
    echo "</pre>";
    die();
}

if (!function_exists('array_only')) {
    function array_only(array $sourceArray, array $allowedKeys): array {
        return array_filter(
            $sourceArray,
            function ($key) use ($allowedKeys) {
                return in_array($key, $allowedKeys);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
