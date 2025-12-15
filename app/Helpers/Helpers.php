<?php

if (!function_exists('clean_output')) {
    function clean_output($data) {
        return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
    }
}
