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
        $apropos = APropos::get();

        return view('admin.apropos.a_propos_index',[
            'apropos' => $apropos,
        ]);
    }
    /**
     *
     */
    public function edit()
    {
        $apropos = APropos::first();

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aproposId = $request->get('id');

        $apropos = Apropos::find($aproposId);
        
        foreach($apropos->photos as $photo) {
            $photo->delete();
        }
        $apropos->delete();

        return redirect()->route('admin.apropos.index')->with('success', 'apropos supprimé');
    }
}
