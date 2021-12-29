<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Album, Photo, Type};
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $albums = Album::all();

        return view('admin.album.album_index',[
            'albums' => $albums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.album.album_create',[
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $album = new Album();
        $album->type_id = $request->get('type');
        $album->nom = $request->get('nom');
        $album->nom_route = $request->get('nom_route');

        if($album->save()) {
            return redirect()->route('admin.album.index')->with('success', 'ok album créé');
        } else {
            return redirect(url()->previous())->with('error', 'problème lors de la création');
        }

    }

 
     /**
      * 
     */
    public function edit($id)
    {
        $album = Album::find($id);
        $types = Type::all();

        return view('admin.album.album_edit',[
            'album' => $album,
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
        $album = Album::find($request->get('id'));
        if($album->type_id != $request->get('type')) {
            $oldType = Type::find($album->type_id);
            $newType = Type::find($request->get('type'));
            Storage::move('public/images/'.$album->type->nom.'/'.$album->nom_route, 'public/images/'.$newType->nom.'/'.$album->nom_route);
        }       
        $album->type_id = $request->get('type') ;
        $album->nom = $request->get('nom');
        $album->description = $request->get('description');

        if($album->save()) {
            return redirect()->route('admin.album.index')->with('success', 'album modifié');
        } else {
            return redirect()->route('admin.album.index')->with('success', 'problème lors de la modif');
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
        $albumId = $request->get('id');
        $album = Album::find($albumId);
        $directory = Storage::deleteDirectory('public/images/'.$album->type->nom.'/'.$album->nom_route);
        
        foreach($album->photos as $photo) {
            $photo->delete();
        }
        $album->delete();

        return redirect()->route('admin.album.index')->with('success', 'album supprimé');
    }
}
