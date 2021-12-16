<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $funsi_delete="deleteData($data->id,'$data->name')";
                    $button = [
                        '<button title="Edit" onclick="editFormModal('.$data->id.')"
                            class="btn btn-sm btn-warning m-1" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fas fa-edit"></i>
                        </button>',
                        '<button title="Hapus" onClick="'.$funsi_delete.'"
                            class="btn btn-sm btn-warning m-1" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fas fa-trash"></i>
                        </button>',
                    ];
                    return implode("",$button);
                })
                ->rawColumns(['action'])
                ->toJson();
        }else{
            return view('app.user.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->ajax()){
            return response()->json(User::find($id));
        }else{
            return response()->json(['this route should be request from ajax'], 400);
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){

        }else{
            return response()->json(['this route should be request from ajax'], 400);
        }
    }
}
