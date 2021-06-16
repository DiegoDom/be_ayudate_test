<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // GET Perfiles
    public function index(Request $request) {

        if ($request->has('search')) {
            return Profile::where('name', 'like', '%'.$request->search.'%')->get();
        } else {
            return Profile::all();
        }

    }

    // GET single profile
    public function show($id) {
        return Profile::findOrFail($id);
    }

    // POST profiles
    public function store(Request $request) {

        $this->validar($request);

        $input = $request->all();

        $profile = Profile::create($input);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_id = $profile->id;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ]);
    }

    /* PUT profiles/id */
    public function update($id, Request $request) {

        $this->validar($request, $id);

        $input = $request->all();

        $profile = Profile::findOrFail($id);
        $profile->update($input);

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ]);
    }

    /* DELETE profile */
    public function delete($id) {

        Profile::destroy($id);

        return response()->json([
            'status' => 'success',
            'data' => 'Registro eliminado correctamente'
        ]);
    }

    /* STORE AND UPDATE VALIDATIONS */
    private function validar($request, $id = '') {
        $this->validate($request, [
            'name' => 'required|max:128',
            'description' => 'max:255',
            'email' => 'required|email|unique:users'.$id,
            'password' => 'required|min:8'
        ]);
    }
}
