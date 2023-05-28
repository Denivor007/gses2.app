<?php

namespace App\Http\Controllers;

use App\Mail\SendRate;
use App\Mail\Subscribe;
use App\Service\EmailService;
use App\Service\RateService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Client\ClientExceptionInterface;
use function Symfony\Component\String\s;


class BtcController extends Controller
{
    protected EmailService $emailService;
    protected RateService $rateService;
    public function __construct(EmailService $emailService, RateService $rateService) {
        $this->emailService = $emailService;
        $this->rateService = $rateService;
    }



    public function getCurrentRate(): bool|string
    {
        return $this->rateService->getRate();
    }
    public function subscribeEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $unique_validator = Validator::make($request->all(), [
            'email' => 'required|unique_emails'
        ]);
/*
 ********* Я не можу зрозуміти, як взагалі программа має видавати статус 200 при намаганні розіслати всім  *********
 ********* імейлам повідомлення, якщо вона навіть не гарантує, що імейл, записаний в "базу даних" є        *********
 ********* валідним? моїм рішенням наразі стало не порушувати контракт, і нічого не викидати в такому разі *********

        $email_validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

        if($email_validator->fails()){
            return response()->json("Email is not correct", 417);
        }
*/

        if($unique_validator->fails()){
            return response()->json("ERROR, email already subscribed", 409);
        }
        $email = $request->input('email');

        $this -> emailService ->putEmailIntoDb(trim($email));
        return response()->json();
    }

    public function sendEmails(): string
    {
        $curRate = $this->rateService->getRate();
        $emails = $this->emailService->getAllEmails();
        foreach ($emails as $email){
            Mail::to($email)->send(new SendRate($email[0], $curRate));
        }
        return response()->json();

    }
}
