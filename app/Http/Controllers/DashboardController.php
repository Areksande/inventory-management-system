<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::query()
            ->when($search, fn($q) => $q->where('name', 'ilike', "%{$search}%")
                                        ->orWhere('email', 'ilike', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', [
            'users'        => $users,
            'totalUsers'   => User::count(),
            'newThisMonth' => User::whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->count(),
            'newToday'     => User::whereDate('created_at', today())->count(),
        ]);
    }
}