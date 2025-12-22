<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function AllWork() {
        $allwork = Work::all();

        return view('admin.backend.work.all_work', compact('allwork'));
    }

    public function AddWork() {
        return view('admin.backend.work.add_work');
    }

    public function StoreWork(Request $request)
{
    if ($request->file('image')) {
        $image = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(320, 213)->save(public_path('upload/work/'.$name_gen));
        $save_url = 'upload/work/'.$name_gen;

        // Create Brand
        $brand = Work::create([
            'link'  => $request->link,
            'image' => $save_url
        ]);

    }

    $notification = [
        'message' => 'Work Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.work')->with($notification);
    }

    public function EditWork($id) {
        $work = Work::findOrFail($id);
        return view('admin.backend.work.edit_work', compact('work'));
    }

    public function UpdateWork(Request $request) {
        $work_id = $request->id;
        $work = Work::findOrFail($work_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(320, 213)->save(public_path('upload/work/'.$name_gen));
            $save_url = 'upload/work/'.$name_gen;

            // Delete old image
        if (file_exists(public_path($work->image))) {
            @unlink(public_path($work->image));
        }

            Work::findOrFail($work_id)->update([
                'link'  => $request->link,
                'image' => $save_url
            ]);

        } else {
            Work::findOrFail($work_id)->update([
                'link'  => $request->link,
            ]);
        }

        $notification = [
            'message' => 'Work Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.work')->with($notification);
    }

    public function DeleteWork($id) {
        $work = Work::findOrFail($id);
        $img = $work->image;
        unlink($img);

        Work::findOrFail($id)->delete();

        $notification = [
            'message' => 'Work Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.work')->with($notification);
    }
}
