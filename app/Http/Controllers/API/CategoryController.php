<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * GET /api/admin/categories
     * يُرجع قائمة التصنيفات مع pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 20);

        $categories = Category::orderBy('name')->paginate($perPage);

        return response()->json([
            'data' => $categories->items(),
            'meta' => [
                'current_page' => $categories->currentPage(),
                'last_page'    => $categories->lastPage(),
                'per_page'     => $categories->perPage(),
                'total'        => $categories->total(),
            ],
        ], Response::HTTP_OK);
    }

    /**
     * POST /api/admin/categories
     * ينشئ تصنيفًا جديدًا
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'message'  => 'Category created successfully.',
            'category' => $category,
        ], Response::HTTP_CREATED);
    }

    /**
     * GET /api/admin/categories/{id}
     * يُرجع تفاصيل تصنيف واحد
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'data' => $category
        ], Response::HTTP_OK);
    }

    /**
     * PUT /api/admin/categories/{id}
     * يُحدّث اسم التصنيف
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->name = $request->input('name');
        $category->save();

        return response()->json([
            'message'  => 'Category updated successfully.',
            'category' => $category,
        ], Response::HTTP_OK);
    }

    /**
     * DELETE /api/admin/categories/{id}
     * يحذف التصنيف المحدد
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ], Response::HTTP_OK);
    }
}
