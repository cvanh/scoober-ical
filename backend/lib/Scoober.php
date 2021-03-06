<?php

namespace Cvanh;

class Scoober
{
    private $accestoken;
    private $headers;
    function __construct($accestoken)
    {
        $this->accestoken = $accestoken;
    }

    /**
     * make a get request to a url with some presets headers
     *
     * @return object of headers 
     */
    private function make_get_request($url)
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        // i know its bad but sue me 
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Host: shiftplanning-api.scoober.com';
        // $headers[] = 'Cookie: __cf_bm=UVta3Mc3OgMJzzFqgsnrBHLtuKbmqx7UD59.2m1qj4c-1642805815-0-AXnBSQSeFaY0xspiZ1ZWL0TYUa/vQg9hExC04zAS7c1zl0e0qiirXvDKgSK1Nf3StBW3Np3lKaDiGeaDjvq0tfApvSwRSgCJA1i+SSONmppC';
        $headers[] = 'Accept: */*';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept-Language: en-NL;q=1.0, nl-NL;q=0.9, de-NL;q=0.8, ru-NL;q=0.7';
        $headers[] = 'Agent: ios-app-v2.17.0';
        $headers[] = 'If-None-Match: W/\"2-l9Fw4VUO7kr8CvBlt4zaMCqXZ0w\"';
        $headers[] = 'User-Agent: Scoober/2.17.0 (com.takeaway.scoober; build:20211103.121233; iOS 15.2.1) Alamofire/5.4.3';
        $headers[] = "Accesstoken: {$this->accestoken}";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    /**
     * get schedule
     * @description it uses y-m-d(2000-01-24)
     * @param string $from y-m-d
     * @param string $to y-m-d
     * @return array of work schedule
     */
    function get_schedule($from, $to)
    {
        return $this->make_get_request("https://shiftplanning-api.scoober.com/api/users/plannings?fromDate={$from}&toDate={$to}");
    }

    /**
     * get openshifts
     * @description it uses y-m-d(2000-01-24)
     * @param string $from y-m-d
     * @param string $to y-m-d
     * @return array of work schedule
     */
    function get_open_shifts()
    {
        return $this->make_get_request("https://shiftplanning-api.scoober.com/api/openshift?fromDate=2022-01-24&toDate=2022-01-30");
    }

    /**
     * gets a acces token via email and password combo
     *
     * @return string
     */
    public function get_accestoken($username, $password)
    {
        if ($this->accestoken) {
            return $this->accestoken;
        } else {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.scoober.com/v2/login');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"password\":\"{$password}\",\"userName\":\"{$username}\"}");
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Host: api.scoober.com';
            $headers[] = 'Cookie: __cf_bm=kKR7Qk6mspv6zlD8d9oROBt3wmSabsNSH1fmwgIZM38-1642290080-0-AQ90SDeLW4vTfWQ4/rfQRJLF5MNkerID18MRAs++qqtaMRCrzrzF7Tp7Eqir2rY8p+rmowsVEV+NNaeR05I1nzhbXoPVHocIytTRaePL9Bi/';
            $headers[] = 'Accept: */*';
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Agent: ios-app-v2.17.0';
            $headers[] = 'User-Agent: Scoober/2.17.0 (com.takeaway.scoober; build:20211103.121233; iOS 15.2.1) Alamofire/5.4.3';
            $headers[] = 'Accept-Language: en-NL;q=1.0, nl-NL;q=0.9, de-NL;q=0.8, ru-NL;q=0.7';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            return $result;
        }
    }
}
