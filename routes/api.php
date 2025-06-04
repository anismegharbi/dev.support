<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JoinRequestController;
use App\Http\Controllers\API\AdminController as APIAdminController;
use App\Http\Controllers\API\ForumController;
use App\Http\Controllers\API\ProfileController as APIProfileController;
use App\Http\Controllers\API\CategoryController as APICategoryController;

Route::middleware(['auth:sanctum', 'check.role:admin'])->group(function () {
    Route::get('/admin/categories',         [APICategoryController::class, 'index']);
    Route::post('/admin/categories',        [APICategoryController::class, 'store']);
    Route::get('/admin/categories/{id}',    [APICategoryController::class, 'show']);
    Route::put('/admin/categories/{id}',    [APICategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [APICategoryController::class, 'destroy']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//AUTH______________________________________________
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    
    //__________________________________________________________________________
  });

    // 1.  join recust from user wla ktar
    Route::post('/join-request', [JoinRequestController::class, 'requestJoin'])
         ->middleware('check.role:user,member,moderator,admin');

   // ______________________________________________________________
 //_________________MANAGE PROFILE API__________________________________
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/show', [APIProfileController::class, 'show']);
    Route::patch('/profile/update', [APIProfileController::class, 'update']);
    Route::delete('/profile/destroy', [APIProfileController::class, 'destroy']);
});



Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return response()->json($request->user());
});



    // —————— (Forums CRUD) ——————

    // 1. can see index forum(Member+)
    Route::get('/forums',            [ForumController::class, 'index'])
         ->middleware('check.role:member,moderator,admin');

    // 2. can creat forum (Moderator+)
    Route::post('/forums',           [ForumController::class, 'store'])
         ->middleware('check.role:moderator,admin');

    // 3. can see forum (Member+)
    Route::get('/forums/{id}',       [ForumController::class, 'show'])
         ->middleware('check.role:member,moderator,admin');

    // 4. can edit forum (Moderator+)
    Route::put('/forums/{id}',       [ForumController::class, 'update'])
         ->middleware('check.role:moderator,admin');

    // 5. can delet forum(Admin only)
    Route::delete('/forums/{id}',    [ForumController::class, 'destroy'])
         ->middleware('check.role:admin');
   // tokknes l tests

//8|FbhQBxRWCs0u95J8A1u96hLUrqq5cpXU7KkGgOQB0b351e74 admin 
//10|ECJUTUZJevPEDHQcmW7NaiwKfuCAfXO0AYRvq48706961686 moderator
//11|S5oXzg28lEE4ajdQiCiJUdQBtgS7AnjBF0UJ5Okpcf611718  memeber
});



Route::middleware(['auth:sanctum', 'check.role:admin'])->group(function () {
     // list of requset / members / moderator wich can accses by admin
     //list members 
    Route::get('/admin/members',     [APIAdminController::class, 'viewMembers']);
    //list moderators
    Route::get('/admin/moderators',  [APIAdminController::class, 'viewModerators']);
    // 1. list requset
    Route::get('/join-request', [JoinRequestController::class, 'listRequests'])
         ->middleware('check.role:admin');
    // 2. admin yacipti
    Route::post('/join-request/{user_id}/approve', [JoinRequestController::class, 'approveRequest'])
         ->middleware('check.role:admin');
    // 3. admin refuser
    Route::post('/join-request/{user_id}/reject', [JoinRequestController::class, 'rejectRequest'])
         ->middleware('check.role:admin');
         //category crud 
Route::middleware(['auth:sanctum', 'check.role:admin'])->group(function () {
    Route::get('/admin/categories',         [APICategoryController::class, 'index']);
    Route::post('/admin/categories',        [APICategoryController::class, 'store']);
    Route::get('/admin/categories/{id}',    [APICategoryController::class, 'show']);
    Route::put('/admin/categories/{id}',    [APICategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [APICategoryController::class, 'destroy']);
});



});










