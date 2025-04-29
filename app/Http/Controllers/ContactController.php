<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::firstOrCreate([], ['content' => '']);
        return view('admin.contact.edit', compact('contact'));
    }


    public function edit()
    {
        $contact = Contact::firstOrCreate([], ['content' => '']);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $contact = Contact::first();
        $contact->update(['content' => $request->content]);

        return redirect()->route('admin.contact.edit')->with('success', 'Contact page updated successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image', // Max 2MB
        ]);

        $path = $request->file('upload')->store('uploads', 'public');

        return response()->json([
            'url' => asset("storage/{$path}"),
        ]);
    }
}