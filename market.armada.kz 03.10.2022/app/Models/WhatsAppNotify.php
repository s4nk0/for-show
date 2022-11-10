<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class WhatsAppNotify
{
   private string $instance_id;
   private string $token;

    private string $BASE_URL = "https://eu289.chat-api.com/instance";

    /**
     * @param string $instance_id
     * @param string $token
     * @param array $data
     */
    public function __construct()
    {
        $this->instance_id = env('WHATSAPP_API_INSTANCE_ID');
        $this->token = env('WHATSAPP_API_TOKEN');
    }



    public function sendFile(array $data): \Illuminate\Http\Client\Response
    {
        return Http::post($this->BASE_URL.$this->instance_id."/sendFile?token=".
            $this->token,$data);
    }

    public function sendMessage(array $data): \Illuminate\Http\Client\Response
    {
        return Http::post($this->BASE_URL.$this->instance_id."/sendMessage?token=".
            $this->token,$data);
    }




}
