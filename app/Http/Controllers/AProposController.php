<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{APropos, Photo, Type};
use Illuminate\Support\Facades\Storage;


class AProposController extends Controller
{

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $apropos = APropos::first();
        if(!$apropos){
            $apropos = new Apropos();
            $apropos->save();
        }

        return view('admin.apropos.a_propos_edit',[
            'apropos' => $apropos,
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
        $apropos = APropos::first();
        $apropos->contenu = $request->get('contenu') ;

        if($apropos->save()) {
            return redirect()->route('admin.a_propos.edit')->with('success', 'apropos modifié');
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
        Storage::deleteDirectory('public/images/'.$apropos->nom_route);

        return redirect()->route('admin.apropos.index')->with('success', 'apropos supprimé');
    }
}
