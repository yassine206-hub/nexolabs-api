<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'prenom'  => 'required|string|max:100',
            'nom'     => 'required|string|max:100',
            'contact' => 'required|string|max:150',
        ]);

        $contact = Contact::create($request->only([
            'prenom', 'nom', 'contact',
            'secteur', 'service', 'message'
        ]));

        return response()->json([
            'message' => 'Demande envoyée avec succès.',
            'data'    => $contact
        ], 201);
    }
}