<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessPhoto;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $photos = BusinessPhoto::orderBy('ordre')->get();
        return view('admin.business.index',[
            'photos' => $photos,
        ]);
    }

    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('business-photos', $filename, 'public');

            $photo = new BusinessPhoto();
            $photo->filename = $filename;
            $photo->save();

            return response()->json(['success' => $filename]);
        }
    }

    public function delete(Request $request) 
    {
        $filename = $request->input('filename');
        $photo = BusinessPhoto::where('filename', $filename)->first();
        
        // Path to the picture
        $filePath = 'public/business-photos/' . $photo->filename;
        
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

    public function saveOrder(Request $request)
    {
        $photoIds = $request->input('photoOrder');

        foreach ($photoIds as $index => $photoId) {
            $photo = BusinessPhoto::find($photoId);
            $photo->ordre = $index + 1;
            $photo->save();
        }

        return response()->json(['success' => 'Order saved']);
    }
}