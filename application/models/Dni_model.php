<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dni_model extends CI_Model {
    
    private $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InR1a2VsYWltQGdtYWlsLmNvbSJ9.zBcoykZQa1VxPb2Tqy0pctMSoEaSv-THm5JRn2Jwr-I";
    private $api_url = "https://dniruc.apisperu.com/api/v1/dni/";
    
    public function consultar_dni($dni) {
        // Configurar la petición cURL
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url . $dni,
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
