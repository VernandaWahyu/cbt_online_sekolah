<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.guru.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $data = DB::table('users')
                ->insert([
                    'name' => $request->nama_guru,
                    'no_guru' => $request->no_guru,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'level' => 'guru'
                ]);

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ],200);
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
        $query =  DB::table('users')
                ->select('*','name as nama_guru')
                ->where('id', $id)
                ->first();
        
        return response([
            'message' => 'Edit data berhasil!',
            'data' => $query
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if($request->password != ''){

            $data = DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->nama_guru,
                    'no_guru' => $request->no_guru,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);

        }else{

            $data = DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->nama_guru,
                    'no_guru' => $request->no_guru,
                    'email' => $request->email,
                    'username' => $request->username,
                ]);

        }

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('users')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function apiGuru()
    {
        $data = DB::table('users')
                    ->select('*','name as nama_guru')
                    ->where('level','guru')
                    ->orderBy('name','asc')
                    ->get();

            return Datatables::of($data)
            ->addColumn('action', function ($data) {

                        $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Guru\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Guru $data->nama_guru\" class=\"btn btn-xs btn-danger rounded-circle\">
                                <span class=\"fa fa-trash \"></span>
                            </button>
                            </div>
                        ";
                        return $button;
                  
                    
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
