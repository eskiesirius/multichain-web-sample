<?php

use App\Helpers;

/*
 * Global helpers file with misc functions.
 */
if (! function_exists('aes_encrypt')) {
    /**
     * Encrypt text in AES 256
     * @param  $message 
     * @param  $secretKey
     * @return mixed
     */
    function aes_encrypt($message,$secretKey)
    {
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        return base64_encode(openssl_encrypt($message, 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA, $iv));
    }
}

if (! function_exists('aes_decrypt')) {
    /**
     * Decrypt AES 256 text 
     * @param  $encryptedMessage 
     * @param  $secretKey
     * @return mixed
     */
    function aes_decrypt($encryptedMessage,$secretKey)
    {
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        return openssl_decrypt(base64_decode($encryptedMessage), 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA, $iv);
    }
}