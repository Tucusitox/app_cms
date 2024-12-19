<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EmailController;

class ContactController
{
    public function contactSend(Request $request)
    {
        $request->validate([
            'ContactName' => 'required|string|min:4',
            'ContacEmail' => 'required|string|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/',
            'ContactMensaje' => 'required|string|min:10',
        ]);

        $EmailController = new EmailController;
        $EmailController->contactForm(
            $request->post('ContactName'),
            $request->post('ContacEmail'),
            $request->post('ContactMensaje'),
        );

        return redirect()->route('contactanos')->with('success','Mensaje enviado con éxito');
    }
}
