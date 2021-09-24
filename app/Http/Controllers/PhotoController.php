<?php

namespace App\Http\Controllers;

use App\Models\{Album, Photo, Type};
use Illuminate\Http\{Request, File, UploadedFile};
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $photos = Photo::paginate(25);

        return view('admin.photo.photo_index',[
            'photos' => $photos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::all();
        
        return view('admin.photo.photo_create',[
            'albums' => $albums,
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
        $album = Album::find($request->get('album'));

        $file = $request->file('file');

        $photo = new Photo();
        $photo->nom = $request->get('nom');
        $photo->album_id = $request->get('album');
        $photo->description = $request->get('description');
        $photo->nom_fichier = $file->getClientOriginalName();

        if ($photo->save()) {
            $file->storeAs('public/images/'.$album->nom_route, $photo->nom_fichier);
            return redirect()->route('admin.photo.create')->with('success', 'photo enregistrée');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $photo = Photo::find($id);

        return view('admin.photo.photo_show',[
            'photo' => $photo,
        ]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);

        return view('admin.photo.photo_edit',[
            'photo' => $photo,
        ]);      
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
        $photo = Photo::find($id);
        $album = Album::find($request->get('album'));

        die('ok');

        die('ok');
        Storage::delete('public/images/'.$album->nom_route, $photo->nom_fichier);
    }


    public function createFromStorage(Request $request) {

        die('ok');
        $album = Album::find(1);
        $directories =  Storage::directories('public/images');
        $types = Type::all();
        foreach($directories as &$directory){
            $directory = explode('/',$directory)[2];
            $album = new Album();
            $album->nom = $directory;
            $album->nom_route = $directory;
            if(preg_match('/coucou/', $directory)){
                // books == types[0]
                $album->type_id = $types[0]->id; 
            } else {
                $album->type_id = $types[1]->id;                
            };
            $album->save();
        };

        $albums = Album::all();

        foreach ($albums as $album){

            $files = Storage::files('public/images/'.$album->nom);
            foreach($files as $file) {
                $nomPhoto = explode('/', $file)[3];
                $photo = new Photo();
                $photo->album_id = $album->id;
                $photo->nom = $nomPhoto;
                $photo->nom_fichier = $nomPhoto;
                $photo->save();
            }         
        }


        die('ok');

    }

}
