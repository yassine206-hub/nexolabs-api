<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return response()->json($contacts);
    }

    public function markRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return response()->json(['message' => 'Marqué comme lu.']);
    }
}