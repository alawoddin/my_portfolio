<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or Imagick
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function AllHome()
    {
        $homes = Home::latest()->get();

        

        return view('admin.backend.home.all_home', compact('homes'));
    }

    //end method 

    public function AddHome()
    {

        return view('admin.backend.home.add_home');
    }

    public function StoreHome(Request $request)
    {
        // Accept either 'photo' or 'image'
        $request->validate([
            'title'  => ['required', 'string', 'max:255'],
            'button' => ['required', 'string', 'max:255'],
            'photo'  => ['required_without:image'],
        ]);

        // Pick whichever exists
        $file = $request->hasFile('photo')
            ? $request->file('photo')
            : ($request->hasFile('image') ? $request->file('image') : null);

        if (!$file) {
            return back()->withInput()->withErrors(['photo' => 'No file received. Check form enctype and field name.']);
        }

        // Ensure destination exists
        $dir = public_path('upload/home');
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        // Process & save
        $manager = new ImageManager(new Driver());
        $name    = Str::random(16) . '.' . $file->getClientOriginalExtension();

        $img = $manager->read($file);
        $img->resize(400, 458)->save($dir . DIRECTORY_SEPARATOR . $name);

        $saveUrl = 'upload/home/' . $name; // relative to /public

        Home::create([
            'title'  => $request->input('title'),
            'button' => $request->input('button'),
            'photo'  => $saveUrl,
        ]);

        return redirect()->route('all.home')->with([
            'message'    => 'Home created successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function EditHome($id)
    {
        $homes = Home::find($id);


        return view('admin.backend.home.edit_home', compact('homes'));
    }

    public function UpdateHome(Request $request)
    {
        $home_id = $request->id;
        $home = Home::find($home_id);

        // 3) Update simple fields first (no image yet)
        $home->update([
            'title'  => $request->title,
            'button' => $request->button,
        ]);

        // 4) Handle optional new photo
        if ($request->hasFile('photo')) {
            // Ensure dest exists
            $dir = public_path('upload/home');
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            // Delete old local file (ignore external URLs)
            if (!empty($home->photo) && !str_starts_with($home->photo, 'http')) {
                $oldPath = public_path($home->photo);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // Process & save (Intervention v3 API)
            $file    = $request->file('photo');
            $name    = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file)->cover(400, 458); // square 100×100
            $image->save($dir . DIRECTORY_SEPARATOR . $name);

            // Save relative public path
            $home->photo = 'upload/home/' . $name;
            $home->save();
        }

        return redirect()->route('all.home')->with([
            'message'    => 'Home updated successfully.',
            'alert-type' => 'success',
        ]);
    }

   public function DeleteHome($id)
{
    $home = Home::findOrFail($id);

    // Delete image file if present
    if (!empty($home->photo)) {
        // Case 1: stored via Storage disk, e.g. "homes/abc.webp"
        if (str_starts_with($home->photo, 'homes/')) {
            Storage::disk('public')->delete($home->photo);
        }
        // Case 2: stored directly under /public, e.g. "upload/home/abc.jpg"
        elseif (!str_starts_with($home->photo, 'http')) {
            $publicPath = public_path($home->photo);
            if (is_file($publicPath)) {
                @unlink($publicPath);
            }
        }
        // (If it's an external URL, do nothing)
    }

    $home->delete();

    return redirect()->route('all.home')->with([
        'message'    => 'Home deleted successfully.',
        'alert-type' => 'success',
    ]);
}
}
