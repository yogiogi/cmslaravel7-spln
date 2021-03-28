<?php

namespace App\Http\Controllers;

use App\Mail\splnEmail;
use Illuminate\Support\Facades\Mail;

class kirimEmail extends Controller
{
    public function index()
    {

        Mail::to("masogiogi@gmail.com")->send(new splnEmail());

        return "Email telah dikirim";
    }
}
