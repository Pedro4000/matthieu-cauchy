<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Album, Photo, Type};
use Illuminate\Support\Facades\Storage;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.type.type_index',[
            'types' => $types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.type.type_create',[
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $type = new Type();
        $type->nom = $request->get('nom');
        $type->description = $request->get('type_description');

        if($type->save()) {
            return redirect()->route('admin.type.index')->with('success', 'ok type créé');
        } else {
            return redirect(url()->previous())->with('error', 'problème lors de la création');
        }

    }

 
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::find($id);
        $types = Type::all();

        return view('admin.type.type_edit',[
            'type' => $type,
            'types' => $types
        ]);
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
        $type = Type::find($request->get('id'));

        $type->nom = $request->get('nom');
        $type->description = $request->get('description');

        if($type->save()) {
            return redirect()->route('admin.type.index')->with('success', 'type modifié');
        } else {
            return redirect()->route('admin.type.index')->with('success', 'problème lors de la modif');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $typeId = $request->get('id');
        $type = Type::find($typeId);
        
        $type->delete();
        Storage::deleteDirectory('public/images/'.$type->nom_route);

        return redirect()->route('admin.type.index')->with('success', 'type supprimé');
    }
}
