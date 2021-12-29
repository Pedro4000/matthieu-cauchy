<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{APropos, Photo, Type};
use Illuminate\Support\Facades\Storage;


class AProposController extends Controller
{

     /**
     *
     */
    public function index()
    {
        $aproposTous = APropos::get();

        return view('admin.apropos.a_propos_index',[
            'aproposTous' => $aproposTous,
        ]);
    }

    /**
     *
     */
    public function edit(Request $request, $id = null)
    {
        $apropos = APropos::find($id);

        return view('admin.apropos.a_propos_edit',[
            'apropos' => $apropos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $apropos = APropos::find($request->id);
        $apropos->contenu = $request->get('a_propos_editor');
        $apropos->langue = $request->get('langue');

        if($apropos->save()) {
            return redirect()->route('admin.a_propos.index')->with('success', 'apropos modifié');
        } else {
            return redirect()->route('admin.a_propos.edit')->with('error', 'problème lors de la modif');
        }    
    }

    /**
     *
     */
    public function create()
    {
        return view('admin.apropos.a_propos_create',[
        ]);
    }


    /**
     *
     */
    public function store(Request $request)
    {
        $apropos = new APropos();
        $apropos->contenu = $request->get('a_propos_editor');
        $apropos->langue = $request->get('langue');

        if($apropos->save()) {
            return redirect()->route('admin.a_propos.index')->with('success', 'apropos crée');
        } else {
            return redirect()->route('admin.a_propos.create')->with('error', 'problème lors de la création');
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
        $aproposId = $request->get('id');
        $apropos = Apropos::find($aproposId);

        if($apropos->delete()) {
            return redirect()->route('admin.a_propos.index')->with('success', 'apropos supprimé');
        } else {
            return redirect()->route('admin.a_propos.create')->with('error', 'problème lors de la suppression');
        }   
    }
}
