<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\InspiringQuoteMail;

Artisan::command('inspire', function () {
    $quote = Inspiring::quote();
    $users = \App\Models\User::all();
    foreach ($users as $user) {
        Mail::to($user->email)->send(new InspiringQuoteMail($quote));
    }
    $this->comment('Inspiring quote sent to all users!');
})
->purpose('Send an inspiring quote to users every hour')
->hourly();  
