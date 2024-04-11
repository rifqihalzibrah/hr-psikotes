<?php

namespace App\Http\Controllers;

use App\Models\DataPengajuanPromosi;
use App\Models\Test;
use App\Models\TestSession;
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
                'Actions',
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
    public function edit(string $id, Request $request)
    {
        try {
            $request->flash();
            $title = 'Users';
            $model = User::findOrFail($id);
            $action_route = route('users.update', ['user' => $id]);

            return view('pages.user.editForm', compact('title', 'model', 'action_route'));
        } catch (Exception $e) {
            report($e);
            dd($e);
            return redirect()->route('users.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            DB::commit();

            Session::put('flash_message', ['Success', 'User updated successfully', 'success']);
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            Session::put('flash_message', ['Error', $e->getMessage(), 'error']);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();
            Session::flash('status', ['success', 'User deleted successfully']);
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            Session::flash('status', ['error', 'Something went wrong. Please try again.']);
            return redirect()->back();
        }
    }

    public function pengajuanPromosiForm(string $id, Request $request)
    {
        try {
            $request->flash();
            $title = 'Form Pengajuan Promosi';
            $data_user = User::findOrFail($id);
            $data_pengajuan = DataPengajuanPromosi::where('user_id', $id)->first();
            $action_route = route('users.promosi.post');

            return view('pages.user.pengajuanPromosiForm', compact('title', 'data_user', 'data_pengajuan', 'action_route'));
        } catch (Exception $e) {
            report($e);
            dd($e);
            return redirect()->route('users.index');
        }
    }

    public function pengajuanPromosiPost(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'pendidikan' => 'required|string',
            'posisi' => 'required|string',
            'unit_divisi' => 'required|string',
            'departemen' => 'required|string',
            'tanggal_join' => 'required|string',
            'jabatan_saat_ini' => 'required|string',
            'jabatan_tujuan' => 'required|string',
            'golongan_saat_ini' => 'required|string',
            'golongan_tujuan' => 'required|string',
            'gaji_saat_ini' => 'required|numeric',
            'gaji_tujuan' => 'required|numeric',
            'alasan_promosi' => 'required|string',
            'evaluasi_atasan' => 'required|string',
            'rewards_prestasi' => 'required|string',
            'punishment_sanksi' => 'required|string',
            'riwayat_performance_tahun_pertama' => 'required|string',
            'riwayat_performance_tahun_kedua' => 'required|string',
            'riwayat_performance_tahun_ketiga' => 'required|string',
            'user_pengusul' => 'required|string',
            'atasan_pengusul' => 'required|string',
            'direktur_unit' => 'required|string',
            'hrd' => 'required|string',
            'pm' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $user_id = $request->input('user_id');
            $model = DataPengajuanPromosi::where('user_id', $user_id)->first();

            if (!$model) {
                $model = new DataPengajuanPromosi();
                $model->user_id = $user_id;
            }

            $model->nik = $request->input('nik');
            $model->tanggal_lahir = $request->input('tanggal_lahir');
            $model->pendidikan = $request->input('pendidikan');
            $model->posisi = $request->input('posisi');
            $model->unit_divisi = $request->input('unit_divisi');
            $model->departemen = $request->input('departemen');
            $model->tanggal_join = $request->input('tanggal_join');
            $model->jabatan_saat_ini = $request->input('jabatan_saat_ini');
            $model->jabatan_tujuan = $request->input('jabatan_tujuan');
            $model->golongan_saat_ini = $request->input('golongan_saat_ini');
            $model->golongan_tujuan = $request->input('golongan_tujuan');
            $model->gaji_saat_ini = $request->input('gaji_saat_ini');
            $model->gaji_tujuan = $request->input('gaji_tujuan');
            $model->alasan_promosi = $request->input('alasan_promosi');
            $model->evaluasi_atasan = $request->input('evaluasi_atasan');
            $model->rewards_prestasi = $request->input('rewards_prestasi');
            $model->punishment_sanksi = $request->input('punishment_sanksi');
            $model->riwayat_performance_tahun_pertama = $request->input('riwayat_performance_tahun_pertama');
            $model->riwayat_performance_tahun_kedua = $request->input('riwayat_performance_tahun_kedua');
            $model->riwayat_performance_tahun_ketiga = $request->input('riwayat_performance_tahun_ketiga');
            $model->user_pengusul = $request->input('user_pengusul');
            $model->atasan_pengusul = $request->input('atasan_pengusul');
            $model->direktur_unit = $request->input('direktur_unit');
            $model->hrd = $request->input('hrd');
            $model->pm = $request->input('pm');

            $model->save();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Data updated successfully.');
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            dd($e);
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function setScheduleForm(string $id, Request $request)
    {
        try {
            $request->flash();
            $title = 'Set Schedule';
            $data_user = User::findOrFail($id);
            $data_pengajuan = DataPengajuanPromosi::where('user_id', $id)->first();
            $tests = Test::get();
            $action_route = route('users.setschedule.post');

            return view('pages.user.setScheduleForm', compact('title', 'data_user', 'data_pengajuan', 'tests', 'action_route'));
        } catch (Exception $e) {
            report($e);
            dd($e);
            return redirect()->route('users.index');
        }
    }

    public function setSchedulePost(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'user_id' => 'required|numeric',
                'test_ids' => 'required|array',
                'test_ids.*' => 'numeric', // Validate each item in the test_ids array as numeric
            ]);

            foreach ($request->test_ids as $test_id) {
                $test_session_data = [
                    'user_id' => $request->user_id,
                    'test_id' => $test_id,
                    'status' => 'OPEN',
                ];
                TestSession::create($test_session_data);
            }

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Test Sessions Created successfully.');
        } catch (Exception $e) {
            report($e);
            dd($e);
            return redirect()->route('users.index');
        }
    }

    public function index_datatables(Request $request)
    {
        $model = User::with(['pengajuan'])->where('role', '=', 'user');

        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                if ($row->pengajuan === null) {
                    // Handle the case where $row->pengajuan is null
                    // For example, you can set $setSchedule to a default value or handle it differently
                    $setSchedule = '<div style="cursor: not-allowed;" href="#" class="dropdown-item d-flex align-items-center"><i class="bx bx-time-five me-2"></i>Set Schedule</div>';
                } else {
                    // Continue with your existing logic
                    $setSchedule = ($row->pengajuan->user_pengusul == 1 && $row->pengajuan->atasan_pengusul == 1 && $row->pengajuan->direktur_unit == 1 && $row->pengajuan->hrd == 1 && $row->pengajuan->pm == 1) ? '<a href="' . route('users.setschedule.form', $row->id) . '" class="dropdown-item d-flex align-items-center"><i class="bx bx-time-five me-2"></i>Set Schedule</a>'  : '<div style="cursor: not-allowed;" href="#" class="dropdown-item d-flex align-items-center"><i class="bx bx-time-five me-2"></i>Set Schedule</div>';
                }
                $actionBtn = '<td class="d-inline-flex align-items-center">
                              <a href="' . route('users.edit', $row->id) . '" class="btn btn-sm btn-icon me-1"><i class="bx bx-edit"></i></a>
                              <form method="POST" action="' . route('users.destroy', $row->id) . '" class="d-inline me-1">
                                  ' . csrf_field() . '
                                  ' . method_field('DELETE') . '
                                  <button type="submit" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>
                              </form>
                              <div class="btn-group d-inline">
                                  <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a href="' . route('users.promosi.form', $row->id) . '" class="dropdown-item d-flex align-items-center">
                                        <i class="bx bx-task me-2"></i>Form Pengajuan Promosi
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <i class="bx bx-history me-2"></i>Histori
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    ' . $setSchedule . '
                                  </div>
                              </div>
                          </td>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
