<?php

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // email data
    $email_data = array(
        'name' => $data['name'],
        'email' => $data['email'],
    );

    // send email with the template
    Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
        $message->to($email_data['email'], $email_data['name'])
            ->subject('Welcome to MyNotePaper')
            ->from('info@mynotepaper.com', 'MyNotePaper');
    });

    return $user;
}
}
