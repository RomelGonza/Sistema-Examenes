<?php

namespace Firebase\JWT;

class JWT {
    public static function encode($payload, $key, $alg = 'HS256') {
        $header = json_encode(['typ' => 'JWT', 'alg' => $alg]);
        $payload = json_encode($payload);

        // Asegurarse de que header y payload no sean null antes de base64_encode
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header) ?? '');
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload) ?? '');
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature) ?? '');
        
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public static function decode($jwt, $key, $allowed_algs = ['HS256']) {
        $tks = explode('.', $jwt);
        if (count($tks) != 3) {
            throw new \Exception('Wrong number of segments');
        }
        list($headb64, $payloadb64, $cryptob64) = $tks;
        $header = json_decode(base64_decode(strtr($headb64, '-_', '+/')), true);
        if ($header === null) {
            throw new \Exception('Invalid segment encoding');
        }
        if (empty($header['alg'])) {
            throw new \Exception('Empty algorithm');
        }
        if (!in_array($header['alg'], $allowed_algs)) {
            throw new \Exception('Algorithm not allowed');
        }
        $sig = base64_decode(strtr($cryptob64, '-_', '+/'));
        if ($sig !== hash_hmac('sha256', "$headb64.$payloadb64", $key, true)) {
            throw new \Exception('Signature verification failed');
        }
        $payload = json_decode(base64_decode(strtr($payloadb64, '-_', '+/')), true);
        if ($payload === null) {
            throw new \Exception('Invalid segment encoding');
        }
        return $payload;
    }
}
?>
