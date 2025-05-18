<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objection;
use Illuminate\Support\Facades\Gate;

class ObjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $objections = Objection::with('user')->latest()->paginate(10);
        } else {
            $objections = auth()->user()->objections()->latest()->paginate(10);
        }
        
        return view('objections.index', compact('objections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return view('objections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'phone_number' => 'required|string|max:20',
            'passport_number' => 'required|string|max:50',
            'address' => 'required|string',
            'status' => 'required|string',
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'description' => 'required|string',
        ]);

        $documentPath = $request->file('document')->store('documents', 'public');

        $objection = auth()->user()->objections()->create([
            'full_name' => $validated['full_name'],
            'nik' => $validated['nik'],
            'phone_number' => $validated['phone_number'],
            'passport_number' => $validated['passport_number'],
            'address' => $validated['address'],
            'status' => $validated['status'],
            'document_path' => $documentPath,
            'description' => $validated['description'],
        ]);

        return redirect()->route('objections.show', $objection)
            ->with('success', 'Pengajuan keberatan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Objection $objection)
    {
        if (!Gate::allows('view', $objection)) {
            abort(403, 'Unauthorized action.');
        }
        return view('objections.show', compact('objection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, Objection $objection)
    {
        if (!Gate::allows('update', $objection)) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'verification_status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $objection->update($validated);

        return redirect()->route('objections.show', $objection)
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function filter(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = Objection::with('user');

        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $objections = $query->latest()->paginate(10);

        return view('objections.index', compact('objections'));
    }
}
