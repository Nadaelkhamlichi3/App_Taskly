<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsManager extends Controller
{

    public function contactPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::raw($request->message, function ($message) use ($request) {
            $message->to("EquipeTaskly@gmail.com")
                    ->subject("Contact us form from " . $request->name)
                    ->from($request->email, $request->name);
        });

        return back()->with('success', 'Thanks for contacting us!');
    }
}
