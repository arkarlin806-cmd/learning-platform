<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\ContactNotification;

class ContactController extends Controller
{
    // contact page
    public function create()
    {
        $admins = User::where('role', 1)->get();
        return view(
            'contact.create',
            compact('admins')
        );
    }

    // send contact
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $contact = Contact::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        // notification receiver
        $receiver = User::find($request->receiver_id);
        $receiver->notify(
            new ContactNotification($contact)
        );
        return back()
            ->with(
                'success',
                'Message sent successfully'
            );
    }

    // inbox
    public function inbox()
    {
        $contacts = Contact::where(
            'receiver_id',
            auth()->id()
        )
            ->with('sender')
            ->latest()
            ->get();
        return view(
            'contact.inbox',
            compact('contacts')
        );
    }

    // Reply
    public function reply(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $contact = Contact::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);




        $receiver = User::find(
            $request->receiver_id
        );
        $receiver->notify(
            new ContactNotification($contact)
        );

        return back()
            ->with(
                'success',
                'Reply sent successfully'
            );
    }

    // read notification
    public function read($id)
    {
        $contact = Contact::find($id);
        $contact->update([
            'is_read' => true
        ]);
        return redirect()->route('contact.inbox');
    }
}
