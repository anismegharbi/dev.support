<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::all();

        return response()->json([
            'data' => $forums
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $forum = Forum::create([
            'name'       => $request->name,
            'title'=> $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Forum created successfully.',
            'data'    => $forum
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $forum = Forum::find($id);

        if (! $forum) {
            return response()->json([
                'message' => 'Forum not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'data' => $forum
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $forum = Forum::find($id);

        if (! $forum) {
            return response()->json([
                'message' => 'Forum not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $forum->update($request->only(['title', 'description']));

        return response()->json([
            'message' => 'Forum updated successfully.',
            'data'    => $forum
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $forum = Forum::find($id);

        if (! $forum) {
            return response()->json([
                'message' => 'Forum not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $forum->delete();

        return response()->json([
            'message' => 'Forum deleted successfully.'
        ], Response::HTTP_OK);
    }
}
