<?php
 //require_once 'dbconfig.php';
function to_lakhs($no) {
    if($no == 0) return 0;

    $val = $no/100000;
    $val = round($val, 2);
    return $val;
}

function kpi_dash_api_encrypt($plaintext, $key) {
    $key_len    = strlen($key);

    //Set the method
    $method     = 'aes-128-cbc';
    //get Requried Key length fo the Method
    $ivlen  = openssl_cipher_iv_length($method);
    $iv = substr($key, 0, $ivlen);
    //Encrypt
    $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));
    return $encrypted;
}

function get_date_range($project_data) {
    
    //Get All Date/range
    $url = "http://api.dashboard.nic.in/MDREST/api/DateRange";
    //Content type of data
    $header     = array(
        "Content-Type: application/json"
    );

    //conver array to json text
    $post_body  = json_encode($project_data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $returned = curl_exec($ch);
    curl_close ($ch);

    return json_decode($returned);
}


function push_to_kpi_dashboard($project_data) {
    $url = "http://api.dashboard.nic.in/MDREST/api/dashboard";

    //Content type of data
    $header     = array(
        "Content-Type: application/json"
    );

    //conver array to json text
    $post_body  = json_encode($project_data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $returned = curl_exec($ch);
    curl_close ($ch);

       

                
    return json_decode($returned);

        }