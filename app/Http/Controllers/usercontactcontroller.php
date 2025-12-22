<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class usercontactcontroller extends Controller
{

    public function ContactPage() {
        $contacts = Contact::all();
        return view('home.homelayout.contact', compact('contacts'));
    }
    public function Contact() {
        return view('home.homelayout.contact');
    }

    public function StoreMessage(Request $request) {
       
        Contact::create([
            'name'  => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with([
            'message'    => 'contact created successfully.',
            'alert-type' => 'success',
        ]);

       

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
