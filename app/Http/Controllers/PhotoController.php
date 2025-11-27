<?php

namespace App\Http\Controllers;

use App\Models\{Album, Photo, Type};
use Illuminate\Http\{Request, File, UploadedFile};
use Illuminate\Support\Facades\{Storage, Log};


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
            $album = Album::find($albumId);
            if (!$album) {
                return redirect()->route('admin.album.index');
            }
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

    public function coverAlbum(Request $request)
    {
        $photoId = $request->photoId;
        $albumId = $request->albumId;
        $photo = Photo::find($photoId);
        
        $previousCovers = Photo::where('cover', 1)
            ->where('album_id', $albumId)
            ->get();
        
        foreach($previousCovers as $cover) {
            $cover->cover = false;
            $cover->save();
        }

        $photo->cover = true;
        $photo->save();

        return response()->json(['success' => 'Cover saved'], 200);
    }

    public function coverSite(Request $request)
    {
        $photoId = $request->photoId;
        $photo = Photo::find($photoId);
        
        $previousLandingImages = Photo::where('landing', 1)
            ->get();
        
        foreach($previousLandingImages as $landing) {
            $landing->landing = false;
            $landing->save();
        }

        $photo->landing = true;
        $photo->save();

        return response()->json(['success' => 'Landing saved'], 200);
    }
    

    public function saveOrder(Request $request)
    {
        $photoIds = $request->input('photoOrder');

        if (!$photoIds || !is_array($photoIds)) {
            return response()->json(['error' => 'Invalid photo order data'], 400);
        }

        foreach ($photoIds as $order => $photoId) {
            $photo = Photo::find($photoId);
            
            if (!$photo) {
                \Log::warning("Photo not found when saving order: ID {$photoId}");
                continue; // Skip this photo and continue with the rest
            }
            
            $photo->ordre = $order + 1;
            $photo->save();
        }

        return response()->json(['success' => 'Order saved']);
    }


    public function hidePhoto(Request $request)
    {
        $photoId = $request->photoId;
        $photo = Photo::find($photoId);
        
        $photo->is_hidden = !($photo->is_hidden);
        $photo->save();

        return response()->json(['success' => 'Order saved']);
    }

}
