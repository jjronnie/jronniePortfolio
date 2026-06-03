<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderByDesc('created_at')->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact): View
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return to_route('admin.contacts.index')->with('status', 'Contact deleted successfully.');
    }
}
