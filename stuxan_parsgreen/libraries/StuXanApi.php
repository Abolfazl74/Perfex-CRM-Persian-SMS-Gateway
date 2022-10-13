<?php

class StuXanApi
{
    
    public $url;
    public $apiKey;
    
    public function __construct(
        $MainUrl,
        $apikey)
    {
        // INIT vars
        $this->url = $MainUrl;
        $this->apikey = $apikey;        
    }
    
    public function call($_method, $urlpath, $req)
    {
		
        $this->url =  $this->url . '/Apiv2/' . $urlpath;
        $ch = curl_init($this->url);
        $jsonDataEncoded = json_encode($req);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $header =array('authorization: BASIC APIKEY:'. $this->apikey,'Content-Type: application/json;charset=utf-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        $result = curl_exec($ch);
        if($result === FALSE)
        {
            echo curl_error($ch);
            return NULL;
        }
        return json_decode($result, true);
    }
    public function get($url, $body="")
    {
        return $this->call("GET", $url, $body);
    }
    public function post($url, $body)
    {
        return $this->call("POST", $url, $body);
    }

}
?>