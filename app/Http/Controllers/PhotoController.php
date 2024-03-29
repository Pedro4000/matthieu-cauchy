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

        if($album_id){
            $photos = Photo::where('album_id', $album_id)
            ->orderBy('ordre')
            ->get();
        } else {
            $photos = Photo::get();
        }


        foreach($photos as &$photo) {
            $photo->nombre_photos = $albums[$photo->album_id]->nombre_photos;
        }
        return view('admin.photo.photo_index',[
            'photos' => $photos,
            'albumId' => $album_id ?? null,
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
                $albumRedirection = $request->get('albumRedirection');

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

        if (!$album->type) {
            return redirect(url()->previous())->with('error', 'il faut que cet album appartienne à un type de contenu');
        }
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
    public function edit(Request $request, $id)
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

        if ($photo->nom != $request->get('nom') || $photo->album_id != $request->album) {

            $nouvelAlbum = Album::find($request->get('album'));
            Storage::move(
                'public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier, 
                'public/images/'.$nouvelAlbum->type->nom.'/'.$nouvelAlbum->nom_route.'/'.$request->get('nom')
            );
        }

        $photo->nom = $request->get('nom');
        $photo->nom_fichier = $request->get('nom');
        $photo->description = $request->get('description');
        $photo->album_id = $request->album;        

        if ($photo->save()) {
            if (isset($albumRedirection)) {
                return redirect()->route('admin.photo.index', [ 'album_id' => $photo->album_id ])->with('success', 'la photo a bien été modifiée');
            } else {
                return redirect()->route('admin.photo.index', [ 'album_id' => $photo->album_id ])->with('success', 'la photo a bien été modifiée');
            }
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
        $albumRedirection = $request->get('albumRedirection');
        $numeroPage = $request->get('page') ?? 1;        

        $files = Storage::get('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier);

        if (Storage::exists('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier)) {

            Storage::delete('public/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier);
            $photo->delete();
            if (isset($albumRedirection)) {
                return redirect()->route('admin.photo.index', [ 'album_id' => $albumRedirection, 'page' => $numeroPage ])->with('success', 'la photo est bien supprimée fraté');
            } else {
                return redirect()->route('admin.photo.index', [ 'page' => $numeroPage ])->with('success', 'la photo a bien été modifiée');
            }
        } else {
            return redirect()->route('admin.photo.index')->with('error', 'oopsie ca a buggé');        
        } 


    }

    public function massEdit(Request $request) {

        $masseEditArray = [];
        $albumId = null;

        foreach ($request->post() as $input => $value) {
            if (!$albumId) {
                //dd($photo->album());
            }
            if (str_contains($input, 'ordre')) {
                
                $id = explode('ordre', $input)[1];
            }
        }

        foreach ($request->all() as $inputName => $inputValue) {

            if(in_array(explode('_', $inputName)[0] ,['accueil', 'couverture', 'ordre'])) {    
                            
                $photoId = explode('_', $inputName)[1];
                $masseEditArray[$photoId][explode('_', $inputName)[0]] = $inputValue;
            }
        }

        foreach ($masseEditArray as $photoId => $photoInputs) {

            $photo = Photo::find($photoId);

            // si on a un input avec 1 pour la photo d'accueil, on enleve tous les autres, pour eviter les doublons, attention cependant cest le 
            // dernier id qui prend, donc si on est sur la même page avec deux oui, cest juste la derniere photo qui prendra
            if (isset($photoInputs['accueil'])) {
                $photoInputs['accueil'] = 1;
                $anciennesPhotoAccueil = Photo::where('accueil', '=', 1)->get();
                foreach ($anciennesPhotoAccueil as $anciennePhotoAccueil) {
                    if ($anciennePhotoAccueil->id != $photo->id) {
                        $anciennePhotoAccueil->accueil = 0;
                        $anciennePhotoAccueil->save();       
                    }
                }
            } else {
                $photoInputs['accueil'] = 0;
            }
            if (isset($photoInputs['couverture'])) {
                $photoInputs['couverture'] = 1;
                $anciennesPhotoCouvertures = Photo::where('couverture', '=', 1)->where('album_id', $photo->album->id)->get();
                foreach ($anciennesPhotoCouvertures as $anciennePhotoCouvertures) {
                    if ($anciennePhotoCouvertures->id != $photo->id) {
                        $anciennePhotoCouvertures->couverture = 0;
                        $anciennePhotoCouvertures->save();       
                    }
                }
            } else {
                $photoInputs['couverture'] = 0;
            }

            $photo->accueil = $photoInputs['accueil'];
            $photo->couverture = $photoInputs['couverture'];
            $photo->ordre = $photoInputs['ordre'];
            $photo->save();
        }

        return redirect()->back();
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
        die('fini');
    }

}
