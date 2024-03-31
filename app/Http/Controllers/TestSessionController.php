<?php

namespace App\Http\Controllers;

use App\Models\TestSession;
use Illuminate\Http\Request;
use Exception, DataTables, DB, Session, Hash;

class TestSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = "Test";

            $table_header = [
                'Name',
                'Test',
                'Status'
            ];

            $create_route = route('users.create');

            return view('pages.test.index', compact('table_header', 'title', 'create_route'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $model = TestSession::query();

        return DataTables::eloquent($model)
            ->make(true);
    }
}
