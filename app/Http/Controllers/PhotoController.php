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
    public function index(Request $request, int $albumId = null)
    {
        if ($albumId) {
            $photos = Photo::where('album_id', $albumId)
                ->orderBy('ordre')
                ->get();
        } else {
            $photos = Photo::get();
        }

        return view('admin.photo.index',[
            'photos' => $photos,
            'albumId' => $albumId ?? null,
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
        
        return view('admin.photo.create',[
            'albums' => $albums,
        ]);
    }


    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('photos', $filename, 'public');

            $photo = new Photo();
            $photo->filename = $filename;
            $photo->album_id = $request->album_id;
            $photo->save();

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'id' => $photo->id,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $filename = $request->input('filename');
        $photo = Photo::where('filename', $filename)->first();
        
        // Path to the picture
        $filePath = 'public/photos/' . $photo->filename;
        
        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Delete the file
            Storage::delete($filePath);
            $photo->delete();
            return response()->json([
                'message' => 'Picture deleted successfully',
                'filename' => $filename,
            ], 
                200);
        } else {
            // Return an error if the file does not exist
            return response()->json(['error' => 'Picture not found'], 404);
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

    public function saveOrder(Request $request)
    {
        $photoIds = $request->input('photoOrder');

        foreach ($photoIds as $order => $photoId) {
            $photo = Photo::find($photoId);
            $photo->ordre = $order + 1;
            $photo->save();
        }

        return response()->json(['success' => 'Order saved']);
    }

}
