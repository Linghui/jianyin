<?php

class Curl_model extends CI_Model
{
    public function curl_get($url)
    {
        $my_curl = curl_init();
        curl_setopt($my_curl, CURLOPT_URL, $url);
        curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($my_curl);
        curl_close($my_curl);

        return $str;
    }

    public function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $str = curl_exec($ch);
        curl_close($ch);

        return $str;
    }
}
