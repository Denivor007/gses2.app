<?php

namespace App\Service;

class RateService
{
    private function formatResponse(string $input): string{
        $matches = [];
        $pattern = "/\d+(\.\d+)?/";
        preg_match($pattern, $input, $matches);
        return $matches[0];
    }
    public function getRate():string{

        return $this -> formatResponse(file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=BTC&" .
            "tsyms=UAH&" .
            "api_key=" . env("BTC_SERVICE_API_KEY")));
    }
}
