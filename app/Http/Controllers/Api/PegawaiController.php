<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::orderBy('nama','asc')->get();
        return response()->json([
            'status'=>true,
            'message'=>'data ditemukan',
            'data'=>$data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = new Pegawai;

        $rules = [
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'gagal memasukan data',
                'data'=>$validator->errors()
            ]);
        }

        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->password = $request->password;

        $post = $pegawai->save();

        return response()->json([
            'status'=>true,
            'message'=>'sukses'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pegawai::find($id);
        if($data){
            return response()->json([
                'status'=>true,
                'message'=>'data ditemukan',
                'data'=>$data
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'data tidak ditemukan'
            ]);
        }
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
        $pegawai = Pegawai::find($id);
        if(empty($pegawai)) {
            return response()->json([
                'status'=>false,
                'message'=>'data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'gagal update data',
                'data'=>$validator->errors()
            ]);
        }

        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->password = $request->password;

        $post = $pegawai->save();

        return response()->json([
            'status'=>true,
            'message'=>'sukses update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if(empty($pegawai)) {
            return response()->json([
                'status'=>false,
                'message'=>'data tidak ditemukan'
            ], 404);
        }


        $post = $pegawai->delete();

        return response()->json([
            'status'=>true,
            'message'=>'sukses delete'
        ]);
    }
}
