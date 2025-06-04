<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin_dashboard');
    }

    /**
     * Show the list of users who requested to join a forum.
     */
    public function viewDemands()
    {
        $usersWithRequests = User::whereNotNull('requested_forum_id')
            ->with('requestedForum') 
            ->get();

        return view('admin.demands', compact('usersWithRequests'));
    }

    /**
     * Show the list of users with the 'member' role.
     */
    public function viewMembers()
    {
        $members = User::where('role', 'member')->get();

        return view('admin.members', compact('members'));
    }

    /**
     * Show the list of users with the 'moderator' role.
     */
    public function viewModerators()
    {
        $moderators = User::where('role', 'moderator')->get();

        return view('admin.moderators', compact('moderators'));
    }
}
