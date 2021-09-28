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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        foreach($albums as &$album){
            $album->lien_image = 'storage/images/'.$album->nom_route.'/'.$album->photos[0]->nom_fichier;
        }

        return view('admin.album.album_index',[
            'albums' => $albums,
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

        return view('admin.album.album_create',[
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        dd($request->all(), $album);

        $abum->type_id = $request->get('type');
        $album->nom = $request->get('nom');
        $album->description = $request->get('description');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        die;
    }
}
