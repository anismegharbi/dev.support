<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Http\Request;


class JoinRequestController extends Controller
{
    public function requestJoin(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'forum_id' => 'required|integer|exists:forums,id',
        ]);

        $user->requested_forum_id = $request->forum_id;
        $user->save();

        return response()->json([
            'message' => 'Join request submitted successfully.'
        ], Response::HTTP_OK);
    }

    public function listRequests()
    {
        $usersWithRequests = User::whereNotNull('requested_forum_id')
                                ->with('requestedForum')
                                ->get(['id','name','email','requested_forum_id']);

        return response()->json([
            'data' => $usersWithRequests
        ], Response::HTTP_OK);
    }

    public function approveRequest($userId)
    {
        $user = User::find($userId);
        if (! $user || is_null($user->requested_forum_id)) {
            return response()->json([
                'message' => 'No valid request found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->role = 'member';
        $user->requested_forum_id = null;
        $user->save();

        return response()->json([
            'message' => 'Join request approved, and user has been promoted to member.'
        ], Response::HTTP_OK);
    }

    public function rejectRequest($userId)
    {
        $user = User::find($userId);
        if (! $user || is_null($user->requested_forum_id)) {
            return response()->json([
                'message' => 'No valid request found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->requested_forum_id = null;
        $user->save();

        return response()->json([
            'message' => 'Join request has been rejected.'
        ], Response::HTTP_OK);
    }
}
