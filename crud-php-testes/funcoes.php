<?php
function hsc($texto) {
    if ($texto === null) {
        return '';
    }
    if (is_array($texto) || is_object($texto)) {
        // Trata arrays ou objetos
        return 'Dado inválido';
    }
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function criptografarId($id) {
    // Método simples (mas dá pra quebrar)
    return base64_encode($id * 7 + 123); 
    
    // Método melhor (usar openssl)
    // return openssl_encrypt($id, 'AES-128-ECB', 'chave_secreta');
}

function descriptografarId($idCriptografado) {
    // Método simples
    return (base64_decode($idCriptografado) - 123) / 7;
    
    // Método melhor
    // return openssl_decrypt($idCriptografado, 'AES-128-ECB', 'chave_secreta');
}

?>