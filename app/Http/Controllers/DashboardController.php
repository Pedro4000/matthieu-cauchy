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

class DashboardController extends Controller
{
    public function __construct(){

    }
    public function dashboard(Request $request){

        $session = $request->session()->has('users');
        return view('admin.dashboard', [
        ]);
    }

}