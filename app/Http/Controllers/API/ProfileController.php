<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ], Response::HTTP_OK);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data'    => $user
        ], Response::HTTP_OK);
    }

 

public function destroy(Request $request)
{
    $request->validate([
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    $user->tokens()->delete();

    $user->delete();

    return response()->json([
        'message' => 'deleted with secuses'
    ], Response::HTTP_OK);
}

}
