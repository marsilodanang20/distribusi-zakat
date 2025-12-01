<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'contact-name' => 'required',
            'contact-email' => 'required|email',
            'contact-phone' => 'required',
            'service_type' => 'required',
            'contact-message' => 'required',
        ]);

        $data = [
            'name' => $request->input('contact-name'),
            'email' => $request->input('contact-email'),
            'phone' => $request->input('contact-phone'),
            'service' => $request->input('service_type'),
            'message' => $request->input('contact-message'),
        ];

        Mail::send('emails.contact', $data, function ($message) {
            $message->to('baznaskab.cirebon@baznas.go.id')
                    ->subject('Pengajuan Kontak Baru | Website Baznas Cirebon');
        });

        return back()->with('success', 'Ajuan berhasil dikirim!');
    }
}
