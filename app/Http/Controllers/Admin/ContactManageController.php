<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactManageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $contacts = Contact::when($status, fn($q) => $q->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $counts = [
            'all'         => Contact::count(),
            'new'         => Contact::where('status', 'new')->count(),
            'in_progress' => Contact::where('status', 'in_progress')->count(),
            'completed'   => Contact::where('status', 'completed')->count(),
            'cancelled'   => Contact::where('status', 'cancelled')->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'counts', 'status'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status'         => 'required|in:new,in_progress,completed,cancelled',
            'admin_notes'    => 'nullable|string|max:500',
            'invoice_amount' => 'nullable|numeric|min:0',
        ]);

        if ($validated['status'] === 'completed' && !$contact->completed_at) {
            $validated['completed_at'] = now();
        }

        $contact->update($validated);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Data kontak berhasil dihapus.');
    }
}
