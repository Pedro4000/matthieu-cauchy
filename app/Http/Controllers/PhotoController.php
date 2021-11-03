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
    public function index(Request $request, int $album_id = null)
    {
        
        $albums = Album::all();
        foreach ($albums as &$album) {
            if (!isset($album->nombre_photos)) {
                $album->nombre_photos = count($album->photos);
            };
        }

        $albums = $albums->mapWithKeys(function ($item, $key) {
            return [$item->id => $item];
        });

        $photos = Photo::paginate(20);
        foreach($photos as &$photo) {
            $photo->nombre_photos = $albums[$photo->album_id]->nombre_photos;
        }

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

        $validated = $request->validate([
            'nom' => 'required|unique:photos',
        ]);


        // todo faire un slug pour verifier que le nom nexiste pas deja de la photo 
        // sans quoi ca ecrase lancienne photo
        $photo = new Photo();
        $photo->nom = $request->get('nom');
        $photo->album_id = $request->get('album');
        $photo->description = $request->get('description');
        $photo->nom_fichier = $file->getClientOriginalName();

        if (Storage::exists('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier)) {
            return redirect(url()->previous())->with('error', 'il existe déjà une photo avec ce nom dans cet album');
        };

        if ($photo->save()) {
            $file->storeAs('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route, $photo->nom_fichier);
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
        $albums = Album::all();

        return view('admin.photo.photo_edit',[
            'photo' => $photo,
            'albums' => $albums,
        ]);      
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $photo = Photo::find($request->get('id'));
        $photo->nom = $request->get('nom');
        $photo->description = $request->get('description');
        $photo->album_id = $request->album;


        if ($photo->save()) {
            return redirect()->route('admin.photo.index')->with('success', 'la photo a bien été modifiée');
        } else {
            return redirect(url()->previous())->with('error', 'poti problème lors de la modification');
        }


    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $photo = Photo::find($request->get('id'));
        $album = Album::find($photo->album->id);

        // todo revoir si ca supprime bien 

        $files = Storage::get('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier);

        if (Storage::exists('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier)) {
            Storage::delete('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier);
            $photo->delete();
            return redirect()->route('admin.photo.index')->with('success', 'la photo est bien supprimée fraté');
        } else {
            return redirect()->route('admin.photo.index')->with('error', 'oopsie ca a buggé');        
        } 


    }


    public function createFromStorage(Request $request) {
        
        $directories =  Storage::directories('public/images');
        $types = Type::all();
        $books = $types[0];
        $works = $types[1];

        
        foreach($directories as $directory){

            $subdirectories =  Storage::directories($directory);
            foreach ($subdirectories as $subdirectory) {

                $nom_album = explode('/',$subdirectory)[3];
                $album = new Album();
                $album->nom = $nom_album;
                $album->nom_route = $nom_album;

                if(preg_match('/books/', $subdirectory)){
                    $album->type_id = $books->id; 
                } else {
                    $album->type_id = $works->id;                
                };
                $album->save();
            }
        };
        

        // on vient d'enregistrer les albums donc ne pas bouger de place
        $albums = Album::all();
        
        foreach ($albums as $album){

            $files = Storage::files('public/images/'.$album->type->nom.'/'.$album->nom);
            foreach($files as $file) {
                $nomPhoto = explode('/', $file)[4];
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
