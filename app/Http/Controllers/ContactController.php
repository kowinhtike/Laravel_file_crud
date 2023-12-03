<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //

    public function index(){
        $contacts = Contact::all()->reverse();
        return view("contact.index",["contacts"=>$contacts]);
    }

    public function store(Request $request){
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->save();

        return response()->json([
            "message" => "Contact added successfully!",
            "contact" => $contact
        ]);

    }

    public function edit($id){
        $contact = Contact::find($id);

        return response()->json($contact);
    }

    public function update(Request $request){
        $contact = Contact::find($request->id);
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->save();
        return response()->json([
            "message" => "Contact updated successfully!",
            "contact" => $contact
        ]);
    }

    public function delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json([
            'message' => "Contacttt Deleted successfully"
        ]);
    }
}
