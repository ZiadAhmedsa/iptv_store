<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSession;
use Illuminate\Http\Request;

class SessionLogController extends Controller
{
    public function index(Request $request)
    {
        $query = UserSession::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            })->orWhere('mac_address', 'LIKE', "%{$search}%");
        }

        $sessions = $query->paginate(20);
        return view('admin.sessions.index', compact('sessions'));
    }
}
