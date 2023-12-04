<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.user.index', [
            'title' => 'User',
            'subtitle' => '',
            'active' => 'user',
            'datas' => User::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.user.create', [
            'title' => 'User',
            'subtitle' => 'Add User',
            'active' => 'user',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'role' => 'required|in:admin,bidang,dinas',
                'email' => 'required|email|unique:users,email',
                'new_password' => 'required|string|min:6',
                'confirm_new_password' => 'required',
            ],
        );


        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => $request->new_password,
        ]);

        return redirect()->route('admin.user')->with('success', 'User has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.user.edit', [
            'title' => 'User',
            'subtitle' => 'Edit User',
            'active' => 'user',
            'data' => User::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'role' => 'required|in:admin,bidang,dinas',
                'email' => 'required|email|unique:users,email',
            ],
        );

        $user = User::findOrFail($id);

        if ($request->new_password != null) {
            $user->Update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => $request->new_password,
            ]);
        }else
        {
            $user->Update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
            ]);
        }
        

        return redirect()->route('admin.user')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = User::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.user')->with('success', 'User has been deleted!');
    }
}
