<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic;
use function PHPUnit\Framework\stringContains;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class CauchyController extends Controller
{
    public function __construct(){

    }
    public function home(Request $request){

        $session = $request->session()->has('users');
        return view('home', [
        ]);
    }

    public function index($category){

        return view('index', [
            'bla'=>"bzzz"
        ]);
    }

    public function works(Request $request){
        $allFiles=Storage::allFiles('public/images/martha1/');
        $allFiles=Storage::allFiles('public/images/martha1/');
        foreach ($allFiles as $allFile) {
            $image = Storage::get($allFile);
            $img = ImageManagerStatic::make($image);
            $img->resize(720,720);
            $img->save('public/images/'.explode('/',$allFile)[2].'/720x720_'.explode('/',$allFile)[3]);
           Storage::put('public/images/'.explode('/',$allFile)[2].'/720/'.explode('/',$allFile)[3],$img);
        }
 
         $image = Storage::get("public/images/martha1/03_15_10_2016-copy.jpg");

        return view('works',[]);
    }

    public function work($work){
        $i=0;
        $allFiles=Storage::allFiles('public/images/'.$work.'1/');
        foreach ($allFiles as $allFile) {
            if (!str_contains($allFile,'540')){
                unset($allFiles[$i]);
            } else {
                $allFiles[$i]=explode('images/',$allFile)[1];
            }
            $i++;
        }
        $allFiles = array_values($allFiles);

        return view('work', [
            "allFiles"=> $allFiles,
            "work" => $work
        ]);
    }

    public function getImages(){
        $imgLinks = [];
        //$album = 'silence';
        //$album = 'martha';
        //$album = 'coucou-magazine';
        //$album = '/coucou-magazine/tomorrowland';
        $album = '/coucou-magazine/33-midi';
        $homepage = file_get_contents('http://matthieucauchy.com/'.$album);

        preg_match_all("{<img\s[^>]*?src\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>}ims", $homepage, $matchesimg1, PREG_SET_ORDER);
        preg_match_all("{<a\s[^>]*?href\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>}ims", $homepage, $matchesimg2, PREG_SET_ORDER);
        $matchesimg = array_merge($matchesimg1, $matchesimg2);


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

        return ('ok');
        
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