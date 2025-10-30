<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or Imagick
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function AllAbout() {
        $abouts = About::latest()->get();

        return view('admin.backend.about.all_about' , compact('abouts'));
    }

    public function AddAbout() {
        return view('admin.backend.about.add_about');
    }


    public function StoreAbout(Request $request) {

   

        // Pick whichever exists
        $file = $request->hasFile('photo')
            ? $request->file('photo')
            : ($request->hasFile('image') ? $request->file('image') : null);

        if (!$file) {
            return back()->withInput()->withErrors(['photo' => 'No file received. Check form enctype and field name.']);
        }

        // Ensure destination exists
        $dir = public_path('upload/about');
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        // Process & save
        $manager = new ImageManager(new Driver());
        $name    = Str::random(16) . '.' . $file->getClientOriginalExtension();

        $img = $manager->read($file);
        $img->resize(300 , 394)->save($dir . DIRECTORY_SEPARATOR . $name);

        $saveUrl = 'upload/about/' . $name; // relative to /public

        About::create([
            'title'  => $request->input('title'),
            'information' => $request->input('information'),
            'photo'  => $saveUrl,
        ]);

        return redirect()->route('all.about')->with([
            'message'    => 'Home created successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function EditAbout($id) {
        $abouts = About::find($id);

        return view('admin.backend.about.edit_about' , compact('abouts'));
    }

    public function UpdateAbout(Request $request) {
        $about_id = $request->id;
        $about = About::find($about_id);

        // 3) Update simple fields first (no image yet)
        $about->update([
            'title'  => $request->title,
            'information' => $request->information,
        ]);

        // 4) Handle optional new photo
        if ($request->hasFile('photo')) {
            // Ensure dest exists
            $dir = public_path('upload/about');
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            // Delete old local file (ignore external URLs)
            if (!empty($home->photo) && !str_starts_with($about->photo, 'http')) {
                $oldPath = public_path($about->photo);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // Process & save (Intervention v3 API)
            $file    = $request->file('photo');
            $name    = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file)->cover(300 , 394); // square 100×100
            $image->save($dir . DIRECTORY_SEPARATOR . $name);

            // Save relative public path
            $about->photo = 'upload/about/' . $name;
            $about->save();
        }

        return redirect()->route('all.about')->with([
            'message'    => 'about updated successfully.',
            'alert-type' => 'success',
        ]); 
    }

    public function DeleteAbout($id) {
         $about = About::findOrFail($id);

    // Delete image file if present
    if (!empty($home->photo)) {
        // Case 1: stored via Storage disk, e.g. "homes/abc.webp"
        if (str_starts_with($about->photo, 'about/')) {
            Storage::disk('public')->delete($about->photo);
        }
        // Case 2: stored directly under /public, e.g. "upload/home/abc.jpg"
        elseif (!str_starts_with($about->photo, 'http')) {
            $publicPath = public_path($about->photo);
            if (is_file($publicPath)) {
                @unlink($publicPath);
            }
        }
        // (If it's an external URL, do nothing)
    }

    $about->delete();

    return redirect()->route('all.about')->with([
        'message'    => 'About deleted successfully.',
        'alert-type' => 'success',
    ]);
    }


}
