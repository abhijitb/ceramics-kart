<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mobinextapi {

    public function __construct() {
        $this->url = MOBINEXT_URL;
        $this->user = MOBINEXT_USER;
        $this->password = MOBINEXT_PASSWORD;
        $this->sid = MOBINEXT_SENDER_ID; // sender ID
        $this->fl = 0; // if flash message then 1 or else 0
        $this->gwid = 2; //gwid: 2 (its for Transactions route.)
    }
    		
    public function sendSms($number, $message) {
        $data = array();
        $data['user'] = $this->user;
        $data['password'] = $this->password;
        $data['msisdn'] = $number;
        $data['sid'] = $this->sid;
        $data['msg'] = $message;
        $data['fl'] = $this->fl;
        $data['gwid'] = $this->gwid;        

        $curl = curl_init();

        if ($data) {
            $url = sprintf("%s?%s", $this->url, http_build_query($data));
        } 
        
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
                return array('error' => 'Could not complete the API call');
        }
        curl_close($curl);
        return $result;
    }

    public function getDeliveryStatus($messageid) {
        //http://vas.mobinext.in/vendorsms/checkdelivery.aspx?user=KYCBOT&password=kyc@123&messageid=messageid
        $data = array();
        $data['user'] = $this->user;
        $data['password'] = $this->password;
        $data['messageid'] = $messageid;

        $curl = curl_init();

        if ($data) {
            $url = sprintf("%s?%s", $this->url, http_build_query($data));
        } 
        
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
                return array('error' => 'Could not complete the API call');
        }
        curl_close($curl);
        return $result;
    }
}


/*
Send SMS API :
http://vas.mobinext.in/vendorsms/pushsms.aspx?user=KYCBOT&password=kyc@123&msisdn=919819209855&sid=KYCBOT&msg=test%20messagethisworks&fl=0&gwid=2
Params :
for multiple messages : add comma separated mobile numbers

Response :
{
  "ErrorCode": "000",
  "ErrorMessage": "Success",
  "JobId": "5262896",
  "MessageData": [
    {
      "Number": "919819209855",
      "MessageParts": [
        {
          "MsgId": "919819209855-85ca5394035a4f32949740f8711ba429",
          "PartId": 1,
          "Text": "test message"
        }
      ]
    }
  ]
}

// 20181212211207
// http://vas.mobinext.in/vendorsms/pushsms.aspx?user=KYCBOT&password=kyc@123&msisdn=91981er09855&sid=KYCBOT&msg=test%20messagethisworks&fl=0&gwid=2
Response :
{
  "ErrorCode": "13",
  "ErrorMessage": "Invalid mobile numbers",
  "JobId": null,
  "MessageData": null
}


Check Delivery API :
http://vas.mobinext.in/vendorsms/checkdelivery.aspx?user=demo&password=demo&messageid=messageid
Response : #DELIVRD


*/