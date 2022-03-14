<?php

namespace MTS;

class Sms extends AbstractApi
{


    /**
     * @param  string $smsbody
     * @param  string $phone
     * @param  array $params
     * @return array
     */
    public function sendSms(string $phone, string $smsbody, array $params = []): array
    {
        $innersub = array(
            "msid" => $phone,
            "message" => $smsbody
        );
        $sendRequest = array (
            "submits" => array($innersub),
             "naming"=>"SmartFood"
        );
        $response = array();
        $resp = $this->post('/v2/messageManagement/messages', $sendRequest, array());
         switch ($resp->status) {
             case 400:
                 $response['status'] = 'error';
                 break;
             case 200:
                 $response['status'] = 'success';
                $response['message'] = $resp->submitResults;
                 break;
         }
        
        return $response;
    }
}
