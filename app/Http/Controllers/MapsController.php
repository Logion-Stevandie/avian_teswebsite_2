<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('maps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate(
            [
                'file_maps' => [
                    'required',
                    'mimes:csv,xls,xlsx',
                ],
            ],
            [
                'file_maps.required' => 'Harap Data Excel diisi',
                'file_maps.mimes' => 'Harap data berupa excel',
            ]
        );

        $file = $request->file('file_maps');
        //DD(Excel::toCollection(null, $file)[1][0]);
        //$nama_file = rand() . $file->getClientOriginalName();
        //$file->move('file_excel', $nama_file);


        $data = Excel::toCollection(null, $file);

        //dd($data[0][1]);

        return view('maps.showmaps', [
            'datacabang' => $data[0],
            'dataatmcat' => $data[1],
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
