<?php
function createRandomToken($length = 32) {
    // Generate a random binary string
    $randomBytes = openssl_random_pseudo_bytes($length);

    // Convert to hexadecimal format
    $token = bin2hex($randomBytes);

    return $token;
}
?>