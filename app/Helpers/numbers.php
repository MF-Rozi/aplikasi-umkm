<?php

if (!function_exists('rupiah')) {
    function rupiah($number)
    {
        return 'Rp'.number_format($number, 0, ',', '.');
    }
}
