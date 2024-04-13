<?php
namespace App\Services;

use Exception;

class JwtService
{
    private static function base64url_encode($data)
    {
        return str_replace(['+','/','='], ['-','_',''], base64_encode($data));
    }
 
    private static function base64_decode_url($string) 
    {
        return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    }
 
    /**
     * Cria um token
     */
    public static function encode(array $payload, string $secret, int $expire = null): string
    {
        $header = json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]);
        $payload['iat'] = time();
        $payload['exp'] = $expire !== null ? time() + $expire : null; // Adicione o tempo de expiração ao payload, se fornecido

        $payload = json_encode($payload);
     
        $header_payload = static::base64url_encode($header) . '.'. 
                            static::base64url_encode($payload);
 
        $signature = hash_hmac('sha256', $header_payload, $secret, true);
         
        return 
            static::base64url_encode($header) . '.' .
            static::base64url_encode($payload) . '.' .
            static::base64url_encode($signature);
    }
 
    /**
     * Retorna payload em formato array, ou lança um Exception
     */
    public static function decode(string $token, string $secret): array
    {
        $token = explode('.', $token);

        $payload = static::base64_decode_url($token[1]);
        $signature = static::base64_decode_url($token[2]);
 
        $header_payload = $token[0] . '.' . $token[1];
 
        if (hash_hmac('sha256', $header_payload, $secret, true) !== $signature) {
            throw new Exception('Invalid signature');
        }
        return json_decode($payload, true);
    }

    /**
     * Retorna payload em formato array, ou lança um Exception
     */
    public static function verify(string $token, string $secret): array
    {
        $tokenParts = explode('.', $token);
        if (count($tokenParts) !== 3) {
            throw new Exception('Token JWT inválido: formato incorreto');
        }

        $payload = static::base64_decode_url($tokenParts[1]);
        $signature = static::base64_decode_url($tokenParts[2]);

        $header_payload = $tokenParts[0] . '.' . $tokenParts[1];

        if (hash_hmac('sha256', $header_payload, $secret, true) !== $signature) {
            throw new Exception('Token JWT inválido: assinatura inválida');
        }

        $payloadArray = json_decode($payload, true);

        // Verifica se o campo 'exp' está presente e se o token está expirado
        if (isset($payloadArray['exp']) && time() >= $payloadArray['exp']) {
            throw new Exception('Token JWT expirado');
        }

        return $payloadArray;
    }
 
}
