<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruc_model extends CI_Model {
    
    private $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsZXNzYW5kcm9jaGFjb24wNUBnbWFpbC5jb20ifQ.rtdfaaIeRf7T9VU-ckewRu1G2wdX4LX-0mg1TSRb9Ew";
    private $api_url = "https://dniruc.apisperu.com/api/v1/ruc/";
    
    public function consultar_ruc($ruc) {
        // Configurar la peticiÃƒÂ³n cURL
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . $ruc,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->token,
                "Accept: application/json"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            throw new Exception("Error en la consulta: " . $err);
        }
        
        return json_decode($response);
    }
}
