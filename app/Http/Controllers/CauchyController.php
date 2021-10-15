<?php

namespace App\Http\Controllers;

use App\Models\{Serie, Album, Photo, Type, APropos};
use Illuminate\Support\Facades\App;
use Illuminate\Http\{Request, Response};
use function PHPUnit\Framework\stringContains;
use Illuminate\Support\Facades\{Storage, File, DB};
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\ImageManagerStatic;

class CauchyController extends Controller
{
    public function __construct(){

    }
    public function landing(Request $request){

        $types= Type::all();

        $session = $request->session()->has('users');
<<<<<<< HEAD
        dd($session);


        return view('landing', [
=======
        return view('home', [
            "types" => $types,
>>>>>>> 6f01cfc66a19b09f6cdbf4d5182891f37f24b4b8
        ]);
    }

    public function album(string $album) {

        $types= Type::all();
        $album = Album::where('nom', $album)->get()->first();

        return view('album', [
            "album" => $album,
            "types" => $types,
        ]);
    }

<<<<<<< HEAD
    public function works(){
  //      $allFiles=Storage::allFiles('public/images/martha1/');
  //      $allFiles=Storage::allFiles('public/images/martha1/');
/*        foreach ($allFiles as $allFile) {
            $image = Storage::get($allFile);
            $img = ImageManagerStatic::make($image);
            $img->resize(720,720);
            $img->save('public/images/'.explode('/',$allFile)[2].'/720x720_'.explode('/',$allFile)[3]);
           Storage::put('public/images/'.explode('/',$allFile)[2].'/720/'.explode('/',$allFile)[3],$img);
        } */

        $image = Storage::get("public/images/martha1/03_15_10_2016-copy.jpg");

        return view('works',[]);
    }
=======
    public function aPropos(Request $request) {
>>>>>>> 6f01cfc66a19b09f6cdbf4d5182891f37f24b4b8

        $types= Type::all();
        $apropos = APropos::first();

        return view('a_propos', [
            "apropos" => $apropos,
            "types" => $types,
        ]);
    }    


    public function getImages(){
        $imgLinks = [];
        $homepage = file_get_contents('http://matthieucauchy.com/coucou-magazine/');

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
            $content = file_get_contents($img);
            Storage::put('public/images/'.explode('/',$img)[5].'/'.explode('/',$img)[6],$content);
        }

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