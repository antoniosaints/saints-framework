<?php

namespace App\Validators;

use Exception;

/**
 * Class DatabaseValidator
 * @author Antonio
 * @package App\Validators
 * @version 1.0.0
 * @since 1.0.0
 * @license MIT
 * @copyright (c) 2022, All Rights Reserved
 * @link https://github.com/antoniosaints
 * @see https://github.com/antoniosaints
 * Regras suportadas por este validador -> required, integer, string, email, cpf, cnpj
 */
class DatabaseValidator
{
    protected static $default = [
        'required' => 'required',
        'integer' => 'integer',
        'string' => 'string'
    ];

    public static function validate(array $rule, array $data)
    {
        if (!isset($rule)) {
            return;
        }

        $validateData = [];

        foreach ($rule as $key => $value) {
            $regras = explode('|', $value);

            if (in_array('required', $regras)) {
                if (!isset($data[$key])) {
                    throw new Exception("O campo {$key} e obrigatorio", 404);
                }
                if (empty($data[$key])) {
                    throw new Exception("O campo {$key} não pode ser vazio", 404);
                }
            }

            if (isset($data[$key])) {
                if (empty($data[$key])) {
                    throw new Exception("O campo {$key} não pode ser vazio", 404);
                }

                if (in_array('email', $regras)) {
                    if (!self::is_email($data[$key])) {
                        throw new Exception("O campo {$key} deve ser um email valido");
                    }
                }

                if (in_array('integer', $regras)) {
                    if (!is_numeric($data[$key])) {
                        throw new Exception("O campo {$key} deve ser um inteiro");
                    }
                }

                if (in_array('string', $regras)) {
                    if (!is_string($data[$key])) {
                        throw new Exception("O campo {$key} deve ser uma string");
                    }
                }

                $validateData[$key] = $data[$key];
            }
        }

        return $validateData;
    }

    private static function is_email($email)
    {
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($regex, $email)) {
            return true;
        }
        return false;
    }

    private static function is_cpf($cpf)
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verificar se o CPF possui 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verificar se todos os dígitos são iguais (caso especial que não é válido)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Verificar o primeiro dígito verificador
        for ($i = 9, $j = 0, $soma = 0; $i > 0; $i--, $j++) {
            $soma += $cpf[$j] * $i;
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;

        // Verificar o segundo dígito verificador
        for ($i = 10, $j = 0, $soma = 0; $i > 1; $i--, $j++) {
            $soma += $cpf[$j] * $i;
        }
        $soma += $dv1 * 2;
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verificar se os dígitos verificadores estão corretos
        if ($cpf[9] != $dv1 || $cpf[10] != $dv2) {
            return false;
        }

        return true;
    }

    private static function is_cnpj($cnpj)
    {
        // Remover caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verificar se o CNPJ possui 14 dígitos
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verificar se todos os dígitos são iguais (caso especial que não é válido)
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Calcular o primeiro dígito verificador
        $soma = 0;
        $multiplicador = 5;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador == 2) ? 9 : $multiplicador - 1;
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;

        // Calcular o segundo dígito verificador
        $soma = 0;
        $multiplicador = 6;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador == 2) ? 9 : $multiplicador - 1;
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verificar se os dígitos verificadores estão corretos
        if ($cnpj[12] != $dv1 || $cnpj[13] != $dv2) {
            return false;
        }

        return true;
    }
}
