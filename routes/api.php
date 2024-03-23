<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/signup', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'user_id' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:8|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::create([
        'name' => $request->name,
        'user_id' => $request->user_id,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['token' => $token], 201);
});

Route::get('/hello', function() {
    return response()->json(['message' => 'hello world!']);
});
