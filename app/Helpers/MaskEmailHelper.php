<?php

if (!function_exists('maskEmail')) {
    function maskEmail($email)
    {
        $email_parts = explode('@', $email);
        $local_part = $email_parts[0];
        $domain_part = $email_parts[1];

        // Local part masking
        $local_part_length = strlen($local_part);
        $masked_local_part = substr($local_part, 0, 2) . str_repeat('*', $local_part_length - 2);

        // Return masked email
        return $masked_local_part . '@' . $domain_part;
    }
}
