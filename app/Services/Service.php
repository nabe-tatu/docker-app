<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class Service
{
    /**
     * メール送信
     * @param String $address
     * @param String $subject
     * @param String $message
     */
    protected function sendMail(String $address, String $subject,  String $message)
    {
        Mail::raw(
            $message,
            function($message) use ($address, $subject) {
                $message
                    ->to($address)
                    ->subject($subject);
            });
    }
}
