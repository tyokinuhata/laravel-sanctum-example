<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

Route::get('/hello', function() {
    return response()->json(['message' => 'hello world!']);
});

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

Route::post('/auth/signin', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|string|max:255',
        'password' => 'required|string|min:8|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::where('user_id', $request->user_id)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['token' => $token], 200);
});

Route::get('/user', function (Request $request) {
    return response()->json($request->user());
})->middleware('auth:sanctum');
