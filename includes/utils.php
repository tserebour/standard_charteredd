<?php
// includes/utils.php

function get_data()
{
    $json = file_get_contents(__DIR__ . '/../data/fixtures.json');
    return json_decode($json, true);
}

function format_currency($amount, $currency = '$')
{
    $negative = $amount < 0;
    $abs_amount = abs($amount);
    $formatted = $currency . number_format($abs_amount, 2);

    if ($negative) {
        return '<span class="text-danger">- ' . $formatted . '</span>';
    }
    return $formatted;
}

function mask_account($number)
{
    // Show last 4 digits
    if (strlen($number) < 4)
        return $number;
    return '••••' . substr($number, -4);
}

function mask_card($number)
{
    // XXXX •••• •••• 1234
    // Input might be "XXXX •••• •••• 9999" already or raw. 
    // Assuming raw or already formatted, let's just ensure end is visible.
    // Spec says: XXXX •••• •••• 1234. 
    // If input is 16 chars:
    return 'XXXX •••• •••• ' . substr($number, -4);
}
?>