<?php

namespace App\Services;

use Exception;

class HttpService
{
    private $curl;
    private $baseUrl = 'http://localhost/';

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function get(string $url, array $headers = [])
    {
        $this->setOptions($this->baseUrl . $url, 'GET', $headers);

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($this->curl));
        }

        return $this->parseResponse($response);
    }

    public function post(string $url, array $data = [], array $headers = [])
    {
        $this->setOptions($this->baseUrl . $url, 'POST', $headers);

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($this->curl));
        }

        return $this->parseResponse($response);
    }

    public function put(string $url, array $data = [], array $headers = [])
    {
        $this->setOptions($this->baseUrl . $url, 'PUT', $headers);

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($this->curl));
        }

        return $this->parseResponse($response);
    }

    public function patch(string $url, array $data = [], array $headers = [])
    {
        $this->setOptions($this->baseUrl . $url, 'PATCH', $headers);

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($this->curl));
        }

        return $this->parseResponse($response);
    }

    public function delete(string $url, array $headers = [])
    {
        $this->setOptions($this->baseUrl . $url, 'DELETE', $headers);

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception('Erro na requisição: ' . curl_error($this->curl));
        }

        return $this->parseResponse($response);
    }

    private function setOptions(string $url, string $method, array $headers)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->buildHeaders($headers));
    }

    private function buildHeaders(array $headers): array
    {
        $defaultHeaders = [
            'Content-Type: application/json',
        ];

        return array_merge($defaultHeaders, $headers);
    }

    private function parseResponse($response)
    {
        return json_decode($response, true);
    }
}
