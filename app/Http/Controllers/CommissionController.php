<?php

namespace App\Http\Controllers;

use App\Models\CommissionedPhoto;
use Illuminate\Http\{Request, File, UploadedFile};
use Illuminate\Support\Facades\Storage;


class CommissionController extends Controller
{

    /**
     * Display the commissions page on frontend
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $commissionedPhotos = CommissionedPhoto::orderBy('order')->get();
        
        return view('commissions', [
            'commissionedPhotos' => $commissionedPhotos,
        ]);
    }

    /**
     * Display a listing of commissioned photos in admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commissionedPhotos = CommissionedPhoto::orderBy('order')->get();
        
        return view('admin.commission.index',[
            'commissionedPhotos' => $commissionedPhotos,
        ]);
    }


    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('commissioned_photos', $filename, 'public');

            $commissionedPhoto = new CommissionedPhoto();
            $commissionedPhoto->filename = $filename;
            $commissionedPhoto->save();

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'id' => $commissionedPhoto->id,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $filename = $request->input('filename');
        $commissionedPhoto = CommissionedPhoto::where('filename', $filename)->first();
        
        // Path to the picture
        $filePath = 'public/commissioned_photos/' . $commissionedPhoto->filename;
        
        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Delete the file
            Storage::delete($filePath);
            $commissionedPhoto->delete();
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

    public function reorder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            $commissionedPhoto = CommissionedPhoto::find($item['id']);
            if ($commissionedPhoto) {
                $commissionedPhoto->order = $item['position'];
                $commissionedPhoto->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully']);
    }

}

