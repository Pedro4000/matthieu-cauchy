<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\{Serie, Album, Photo, Type, APropos};
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\{Storage, File, DB, App, Mail};
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Filters\FilterInterface;
use function PHPUnit\Framework\stringContains;

class CauchyController extends Controller
{
    public function __construct(){

    }
    public function home(Request $request){

        $types= Type::all();

        $session = $request->session()->has('users');
        $albums = Album::all();
        $photoAccueil = Photo::where('accueil', 1)->get()->first();

        $photosCouv = Photo::where('couverture', 1)->get();
        $photosCouv = $photosCouv->mapWithKeys(function ($item, $key) {
            return [$item->album_id => $item];
        });


        $idsBooks = Album::select('id')->where('type_id', Type::where('nom', 'books')->first()->id ?? '')->get()->toArray();

        $albumTries = [];
        foreach ($albums as &$album) {
            if(isset($photosCouv[$album->id])){
                $album->couv = $photosCouv[$album->id];
            }
            if ($album->type){
                $albumTries[$album->type->nom][$album->nom] = $album;
            }
        }
        $albums = $albumTries;
        $AllAPropos = APropos::all();

        $planets = Storage::files('public/favicon/planets');

        foreach ($planets as &$planet) {
            $planet = str_replace('public', 'storage', $planet);
        }

        return view('home', [
            'types' => $types,
            'albums' => $albums,
            'AllAPropos' => $AllAPropos,
            'planets' => $planets,
            'photoAccueil' => $photoAccueil,
        ]);
    }

    public function album(string $album_nom) {

        $types= Type::all();
        $album = Album::where('nom', $album_nom)->get()->first();

        return view('album', [
            'album' => $album,
            'types' => $types,
        ]);
    }

    public function contact(Request $request) {

        $validated = $request->validate([
            'contact_name' => 'required|string',
            'contact_message' => 'required|string',
        ]);

        Mail::to('Mattcau@msn.com')
            ->cc('P.brickley@hotmail.fr')
            ->send(new ContactMail($validated['contact_name'], $validated['contact_message']));
        // return new ContactMail($validated['contact_name'], $validated['contact_message']);

        return redirect()->route('home' ,[
            'section_display' => 'contact',
            'message' => 'ok',
        ]);

    } 


    public function getImages(){

        $albums = [
            ['nom' => 'silence', 'lien' => 'silence', 'type' => 'works'],
            ['nom' => 'martha', 'lien' => 'martha', 'type' => 'works'],
            ['nom' => 'tomorrowland', 'lien' => 'coucou-magazine/tomorrowland/', 'type' => 'books'],
            ['nom' => 'premiere classe', 'lien' => 'coucou-magazine/', 'type' => 'books'],
            ['nom' => '33 midi', 'lien' => 'coucou-magazine/33-midi/', 'type' => 'books'],
        ];

        foreach($albums as $album) {

            $matchesimg = [];
            $imgLinks = [];
            $matchesa = [];

            $homepage = file_get_contents('http://matthieucauchy.com/'.$album['lien']);

            preg_match_all("{<img\s[^>]*?src\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>}ims", $homepage, $matchesimg, PREG_SET_ORDER);
            preg_match_all("{<a\s[^>]*?href\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>}ims", $homepage, $matchesa, PREG_SET_ORDER);
            $matchesimg = array_merge($matchesimg,$matchesa);

            foreach ($matchesimg as $val) {
    //            preg_match_all('{([0-9]{1,3})x([0-9]{1,3})}ims',$val[1],$minimatch,PREG_SET_ORDER);
                $explodedLink = explode('/', $val[1]);
                if (is_array($explodedLink) && count($explodedLink) > 2 && $explodedLink[1] == 'storage') {
                    array_push($imgLinks, 'http://matthieucauchy.com' . $val[1]);
                }
            }

            foreach ($imgLinks as $img) {
                $nomPhoto = explode('/',$img)[6];
                $content = file_get_contents($img);
                Storage::put('public/images/'.$album['type'].'/'.$album['nom'].'/'.$nomPhoto,$content);
            }
        }


        die('ok');
        return view('showImages', [
            'imgLinks' => $imgLinks
        ]);
    }

    public function ajax(){
        $i=0;
        $allFiles=Storage::allFiles('public/images/');
        foreach ($allFiles as $allFile) {
            if (!str_contains($allFile,'540') || str_contains($allFile,'txt')){
                unset($allFiles[$i]);
            } else {
                $allFiles[$i]=explode('images/',$allFile)[1];
            }
            $i++;
        }
        $allFiles= array_values($allFiles);
        $allFiles = json_encode($allFiles);
        return response()->json($allFiles);
    }
}