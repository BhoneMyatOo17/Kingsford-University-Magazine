<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContactRequest;
use App\Notifications\AdminRespondedToContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Public: Create contact form
    public function create()
    {
        return view('contact.create');
    }

    // Public: Store contact request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = new Contact($validated);

        if (Auth::check()) {
            $user = Auth::user();
            $contact->user_id   = $user->id;
            $contact->user_role = $user->role;
        }

        $contact->save();

        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewContactRequest($contact));
        }

        return redirect()->route('contact.create')
            ->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }

    // Admin: List all contacts
    public function index(Request $request)
    {
        abort_unless(Auth::user()->hasAnyPermission(['view contacts', 'manage contacts']), 403);

        $query = Contact::with('user')->latest();

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $contacts = $query->paginate(15);
        $stats = [
            'total'       => Contact::count(),
            'pending'     => Contact::pending()->count(),
            'in_progress' => Contact::inProgress()->count(),
            'resolved'    => Contact::resolved()->count(),
        ];

        return view('contact.index', compact('contacts', 'stats'));
    }

    // Admin: Show single contact
    public function show(Contact $contact)
    {
        abort_unless(Auth::user()->hasAnyPermission(['view contacts', 'manage contacts']), 403);
        $contact->load('user');
        return view('contact.show', compact('contact'));
    }

    // Admin: Show edit form
    public function edit(Contact $contact)
    {
        abort_unless(Auth::user()->hasPermissionTo('manage contacts'), 403);
        return view('contact.edit', compact('contact'));
    }

    // Admin: Update contact (respond)
    public function update(Request $request, Contact $contact)
    {
        abort_unless(Auth::user()->hasPermissionTo('manage contacts'), 403);

        $validated = $request->validate([
            'status'         => 'required|in:pending,in_progress,resolved',
            'admin_response' => 'nullable|string',
        ]);

        $wasResponded = !$contact->admin_response && $request->filled('admin_response');

        if ($request->filled('admin_response')) {
            $validated['responded_at'] = now();
            if ($validated['status'] === 'pending') {
                $validated['status'] = 'resolved';
            }
        }

        $contact->update($validated);

        // Notify the contact's user if admin just added a response
        if ($wasResponded && $contact->user) {
            $contact->user->notify(new AdminRespondedToContact($contact));
        }

        return redirect()->route('contact.index')
            ->with('success', 'Contact updated successfully.');
    }

    // Admin: Delete contact
    public function destroy(Contact $contact)
    {
        abort_unless(Auth::user()->hasPermissionTo('delete contacts'), 403);
        $contact->delete();

        return redirect()->route('contact.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
