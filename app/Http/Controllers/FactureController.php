<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with(['patient', 'consultation'])
            ->latest()->paginate(10);
        return view('admin.factures.index', compact('factures'));
    }

    public function show(Facture $facture)
    {
        $facture->load(['patient', 'consultation.medecin']);
        return view('admin.factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        return view('admin.factures.edit', compact('facture'));
    }

    public function update(Request $request, Facture $facture)
    {
        $request->validate([
            'statut' => 'required|in:impayee,payee,annulee',
            'mode_paiement' => 'nullable|in:especes,carte,virement',
        ]);

        $facture->update($request->all());

        return redirect()->route('admin.factures.index')
            ->with('success', 'Facture mise à jour avec succès !');
    }

    public function create()
    {
        return view('admin.factures.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.factures.index');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('admin.factures.index')
            ->with('success', 'Facture supprimée avec succès !');
    }
}