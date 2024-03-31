<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception, DataTables, DB, Session, Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = "Users";

            $table_header = [
                'Name',
                'Username',
                'Email',
            ];

            $create_route = route('users.create');

            return view('pages.user.index', compact('table_header', 'title', 'create_route'));
        } catch (Exception $e) {
            report($e);

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $title = 'Users';
            $action_route = route('users.store');

            return view('pages.user.createForm', compact('title', 'action_route'));
        } catch (Exception $e) {
            report($e);

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $request->flash();
            $user = new User();
            $user->role = "user";
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            Session::put('flash_message', ['Success', 'User created successfully', 'success']);

            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            Session::put('flash_message', ['Error', $e->getMessage(), 'error']);

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function index_datatables(Request $request)
    {
        $model = User::query()->where('role', '=', 'user');

        return DataTables::eloquent($model)
            ->make(true);
    }
}
