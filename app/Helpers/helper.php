<?php
if (!function_exists('formatFileSize')) {
    function formatFileSize($bytes)
    {
        $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes >= 1024 && $i < count($sizes) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $sizes[$i];
    }
}
