<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ProgramBimbelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.program_bimbel.index');
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

        $data = DB::table('program_bimbel')
                ->insert([
                    'nama_program' => $request->nama_program,
                    'deskripsi' => $request->deskripsi,
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
        $query =  DB::table('program_bimbel')
                ->select('*')
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
        $data = DB::table('program_bimbel')
                ->where('id', $request->id)
                ->update([
                    'nama_program' => $request->nama_program,
                    'deskripsi' => $request->deskripsi,
                ]);

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

        $data = DB::table('program_bimbel')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function apiProgramBimbel()
    {
        $data = DB::table('program_bimbel')
                    ->orderBy('nama_program','asc')
                    ->get();

            return Datatables::of($data)
            ->addColumn('action', function ($data) {

                        $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Program Bimbel\" class=\"btn btn-warning  btn-xs rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Program Bimbel $data->nama_program\" class=\"btn btn-xs btn-danger rounded-circle\">
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
