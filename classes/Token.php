<?php
class Token{
    public function AuthToken($token)
    {
        $data = [
            'secret' => Config::get('google_recaptcha/private_key'),
            'response' => $token,
            'remoteip' => Config::get('client_id/ip_address')
        ];
        $options = array(
                'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                // 'ignore_errors' => true,
                'content' => http_build_query($data)   
                )
            );
        $context = stream_context_create($options);
        try
        {
            $response = file_get_contents(Config::get('google_recaptcha/token_verification_site'), false, $context);
            if(empty($response))
            {
                return "no connection";
            }
        }
        catch (Exception $e) 
        {
            return $e;
        }
        $res = json_decode($response, true);
        if ($res['success'] == true && $res['score'] >= 0.5)
        {
            return "success";
        }
        else
        {
            return "bot detected";
        }
    }

    public function FormToken($token)
    {
        $data = [
            'secret' => Config::get('google_recaptcha/private_key'),
            'response' => $token,
            'remoteip' => Config::get('client_id/ip_address')
        ];
        $options = array(
            'http' => array(
             'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                 'method' => 'POST',
                 'content' => http_build_query($data)
             )
        );
        $context = stream_context_create($options);
        $response = file_get_contents(Config::get('google_recaptcha/token_verification_site'), false, $context);
        $res = json_decode($response, true);
        if ($res['success'] == true && $res['score'] >= 0.5)
        {
            echo "success";
        }
        else{
            echo "error";
        } 
    }
}