<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->paginate(5);

        return \view('users.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return \view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|string|email|max:255',
            'alamat' => 'required|min:5|max:255'
        ]);

        $user = User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Update users berhasil'
        ], 200);
    }

    public function pagePassword()
    {
        return view('users.password');
    }
    public function ubahPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:5',
            'password' => 'required|string|min:5|confirmed',
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'alamat' => 'required|string|min:5'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            // return redirect()->route('login')->with('success','Password Is Chanage Successfuly');

            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diupdate'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Password tidak sama'
            ], 400);
        }

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Update password berhasil'
        // ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Users berhasil dihapus'
        ], 200);
    }
}
