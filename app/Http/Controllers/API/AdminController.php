<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    
    public function viewMembers()
    {
        $members = User::where('role', 'member')->get(['id', 'name', 'email', 'created_at']);

        return response()->json([
            'data' => $members
        ], Response::HTTP_OK);
    }

    
    public function viewModerators()
    {
        $moderators = User::where('role', 'moderator')->get(['id', 'name', 'email', 'created_at']);

        return response()->json([
            'data' => $moderators
        ], Response::HTTP_OK);
    }
}
