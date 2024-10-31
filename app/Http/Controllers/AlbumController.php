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
        $covers = Photo::where('cover', 1)->get();

        $albumCoversIndexedByAlbumId = [];
        foreach ($covers as $cover) {
            $albumCoversIndexedByAlbumId[$cover->album_id] = $cover;
        }

        return view('admin.album.index',[
            'albums' => $albums,
            'albumCoversIndexedByAlbumId' => $albumCoversIndexedByAlbumId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.album.create',[
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $album = new Album();
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $album->name = $request->get('name');
        $album->description = $request->get('description');
        $album->display = isset($request->display) ?? false;

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
        return view('admin.album.edit',[
            'album' => $album,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $album = Album::find($id);
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $album->name = $request->get('name');
        $album->description = $request->get('description');
        $album->display = isset($request->display) ?? false;

        $album->save();

        if($album->save()) {
            return redirect()->route('admin.album.index')->with('success', 'album modified');
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
        dd($album->photos);
        
        foreach($album->photos as $photo) {
            $photo->delete();
        }
        $album->delete();

        return redirect()->route('admin.album.index')->with('success', 'album supprimé');
    }
}
