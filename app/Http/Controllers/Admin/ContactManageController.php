<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactManageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $contacts = Contact::when($status, fn($q) => $q->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Optimasi 5 query count terpisah menjadi 1 single conditional aggregation query
        $rawCounts = Contact::select([
            DB::raw('COUNT(*) as total_all'),
            DB::raw("COUNT(CASE WHEN status = 'new' THEN 1 END) as total_new"),
            DB::raw("COUNT(CASE WHEN status = 'in_progress' THEN 1 END) as total_in_progress"),
            DB::raw("COUNT(CASE WHEN status = 'completed' THEN 1 END) as total_completed"),
            DB::raw("COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as total_cancelled"),
        ])->first();

        $counts = [
            'all'         => (int) ($rawCounts->total_all ?? 0),
            'new'         => (int) ($rawCounts->total_new ?? 0),
            'in_progress' => (int) ($rawCounts->total_in_progress ?? 0),
            'completed'   => (int) ($rawCounts->total_completed ?? 0),
            'cancelled'   => (int) ($rawCounts->total_cancelled ?? 0),
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
