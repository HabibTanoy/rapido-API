<?php

namespace App\Tools;

use Exception;
use Illuminate\Support\Facades\Http;

class FetchTraceUsers
{
    private $api_key;
    public function setApiKey($API_KEY)
    {
        $this->api_key = $API_KEY;
        return $this;
    }

    public function get()
    {
        try {
            return Http::get("https://barikoi.xyz/v1/api/trace/company/users?api_key=$this->api_key")->json()['info']['users'];
        }catch (Exception $exception) {
            throw new Exception('Error in fetching trace users.',500);
        }
    }
}
