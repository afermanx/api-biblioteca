<?php


/**
 * Treats the document regardless of whether it is cnpj or cpf.
 */

use App\Models\Institution;

if (! function_exists('treateDocumentNumber')) {
    function generateUsername(string $name): string
    {
        $username = explode(" ", $name);
        $username = substr($username[0],0,1).substr($username[1],0,1);
        $username = strtoupper($username);
        $username = $username . uniqid(rand());
        $username = substr($username , 0, 6);
        return $username;
    }
}
