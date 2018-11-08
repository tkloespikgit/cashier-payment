<?php

/*
 * common function files
 * */

function floatToInt(float $float, int $decimals = 2)
{
    return (int)bcmul($float,10^$decimals,0);
}

function formatNumber($number,int $decimals , bool $incoming = false)
{
    if ($incoming) {
        return "<font color='#006400'>".number_format($number,$decimals)."</font>";
    } else {
        return "<font color='#8b0000'>".number_format($number,$decimals)."</font>";
    }
}

/*
 * return array [httpCode int result]
 *
 * */

function curlGet($url,array $params = [],array $headers = [],$isHttps = false)
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if ($isHttps) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    if ($params) {
        if (is_array($params)) {
            $params = http_build_query($params);
        }
        curl_setopt($curl, CURLOPT_URL, $url . '?' . $params);
    } else {
        curl_setopt($curl, CURLOPT_URL, $url);
    }

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
    curl_close($curl);
    $json=json_decode($response,true);

    if ($json) {
        $response = $json;
    }else{
        libxml_disable_entity_loader(true);
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $response =  $xml;
    }

    return [
        'httpCode' => $httpCode,
        'result' => $response
    ];
}

/*
 * return array [httpCode int result]
 *
 * */


function curlPost($url,array $params = [],array $headers = [],$isHttps = false)
{
    $curl = curl_init();

    if (is_array($headers) && count($headers) > 0)
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);

    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 40);
    curl_setopt($curl, CURLOPT_TIMEOUT, 40);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if ($isHttps) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    curl_setopt($curl, CURLOPT_URL, $url);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);

    curl_close($curl);

    $json=json_decode($response,true);

    if ($json) {
        $response = $json;
    }else{
        libxml_disable_entity_loader(true);
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $response =  $xml;
    }

    return [
        'httpCode' => $httpCode,
        'result' => $response
    ];

}