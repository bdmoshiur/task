<?php

namespace App\Http\Controllers;

use App\Models\UserSearchHistory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keyword;

class UserSearchHistoryController extends Controller
{

    public function index(Request $request) {

        $query = UserSearchHistory::where('status', 1);

        // Filter by keywords
        $keywords = $request->input('keywords');
        if ($keywords) {
            $query->whereIn('keyword_id', $keywords);
        }

        // Filter by users
        $users = $request->input('users');
        if ($users) {
            $query->whereIn('user_id', $users);
        }

        // Filter by time range
        if ($request->has('yesterday')) {
            $query->whereBetween('search_timestamp', [now()->subDay(), now()]);
        } elseif ($request->has('last_week')) {
            $query->whereBetween('search_timestamp', [now()->subWeek(), now()]);
        } elseif ($request->has('last_month')) {
            $query->whereBetween('search_timestamp', [now()->subMonth(), now()]);
        }

        // Filter by date range
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $searches = $query->get();

        return view('welcome', [
            'keywords' => Keyword::all(),
            'users' => User::all(),
            'searches' => $searches,
        ]);
    }
}

