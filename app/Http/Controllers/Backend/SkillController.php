<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or Imagick
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\Skip;

class SkillController extends Controller
{
    public function AllSkill() {
        $skills = Skill::all();

        return view('admin.backend.skill.all_skill' , compact('skills'));
    }

    public function AddSkill() {
        return view('admin.backend.skill.add_skill');
    }

    public function StoreSkill(Request $request) {
        // Accept either 'photo' or 'image'
        $request->validate([
            'title'  => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
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
        $dir = public_path('upload/skill');
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        // Process & save
        $manager = new ImageManager(new Driver());
        $name    = Str::random(16) . '.' . $file->getClientOriginalExtension();

        $img = $manager->read($file);
        $img->resize(495, 330)->save($dir . DIRECTORY_SEPARATOR . $name);

        $saveUrl = 'upload/skill/' . $name; // relative to /public

        Skill::create([
            'title'  => $request->input('title'),
            'description' => $request->input('description'),
            'photo'  => $saveUrl,
        ]);

        return redirect()->route('all.skill')->with([
            'message'    => 'Home created successfully.',
            'alert-type' => 'success',
        ]);

    }

    public function EditSkill($id) {
        $editskill = Skill::find($id);

        return view('admin.backend.skill.edit_skill' , compact('editskill'));
    }

    public function UpdateSkill (Request $request) {
         $skill_id = $request->id;
        $home = Skill::find($skill_id);

        // 3) Update simple fields first (no image yet)
        $home->update([
            'title'  => $request->title,
            'description' => $request->description,
        ]);

        // 4) Handle optional new photo
        if ($request->hasFile('photo')) {
            // Ensure dest exists
            $dir = public_path('upload/skill');
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
            $image   = $manager->read($file)->resize(495, 330); // square 100×100
            $image->save($dir . DIRECTORY_SEPARATOR . $name);

            // Save relative public path
            $home->photo = 'upload/skill/' . $name;
            $home->save();
        }

        return redirect()->route('all.skill')->with([
            'message'    => 'Skill updated successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function DeleteSkill($id) {
            $skill = Skill::findOrFail($id);

    // Delete image file if present
    if (!empty($skill->photo)) {
        // Case 1: stored via Storage disk, e.g. "homes/abc.webp"
        if (str_starts_with($skill->photo, 'skill/')) {
            Storage::disk('public')->delete($skill->photo);
        }
        // Case 2: stored directly under /public, e.g. "upload/home/abc.jpg"
        elseif (!str_starts_with($skill->photo, 'http')) {
            $publicPath = public_path($skill->photo);
            if (is_file($publicPath)) {
                @unlink($publicPath);
            }
        }
        // (If it's an external URL, do nothing)
    }

    $skill->delete();

    return redirect()->route('all.skill')->with([
        'message'    => 'skill deleted successfully.',
        'alert-type' => 'success',
    ]);
    }
}
