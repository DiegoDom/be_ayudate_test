<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            return User::where('name', 'like', '%'.$request->search.'%')->with('profile')->get();
        } else {
            return User::with('profile')->get();
        }
    }

    // GET single profile
    public function show($id) {
        return User::findOrFail($id)->with('profile')->first();
    }

    public function register(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:128',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_id = $request->profile_id ? $request->profile_id : 1;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /* PUT profiles/id */
    public function update($id, Request $request) {

        $this->validate($request, [
            'name' => 'required|max:128',
            'email' => 'required|email|unique:users,email,'. $id
        ]);

        $input = $request->all();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile_id = $request->profile_id;
        $user->phone = $request->phone;
        $user->update($input);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /* DELETE profile */
    public function delete($id) {

        User::destroy($id);

        return response()->json([
            'status' => 'success',
            'data' => 'Registro eliminado correctamente'
        ]);
    }

}
