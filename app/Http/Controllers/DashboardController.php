<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user && $user->isAdmin()) {
            $objections = Objection::with('user')
                ->when($request->name, function($query, $name) {
                    return $query->where('full_name', 'like', '%' . $name . '%');
                })
                ->when($request->status, function($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($request->verification_status, function($query, $status) {
                    return $query->where('verification_status', $status);
                })
                ->latest('created_at')
                ->paginate(10)
                ->withQueryString();
        } else {
            $objections = $user->objections()
                ->when($request->name, function($query, $name) {
                    return $query->where('full_name', 'like', '%' . $name . '%');
                })
                ->latest('created_at')
                ->paginate(10)
                ->withQueryString();
        }
        
        return view('dashboard', compact('objections'));
    }
}
