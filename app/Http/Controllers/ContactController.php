<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function submitForm(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'message' => 'required|string|min:10'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        $phone = $request->input('phone');

        Mail::send('email.contact', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ], function ($mail) use ($email, $name) {
            $mail->from($email, $name);
            $mail->to(' [email protected]')->subject('Mensagem do formulário de contato');
        });

        return redirect()->route('contact.show')->with('success', 'Mensagem enviada com sucesso!');
    }
}
