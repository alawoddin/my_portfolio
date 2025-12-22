<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function AllContact() {
        $contacts = Contact::all();
        return view('admin.backend.contact.all_contact', compact('contacts'));
    }

    
}
