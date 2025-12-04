<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Data_Skill;
use Illuminate\Http\Request;

class data_skillController extends Controller
{
    public function AllDataSkill() {
        $dataskill = Data_Skill::all();

        return view('admin.backend.data_skill.all_data_skill', compact('dataskill'));
    }

    public function AddDataSkill() {

        return view('admin.backend.data_skill.add_data_skill');
    }

    public function StoreDataSkill(Request $request) {
        Data_Skill::insert([
            'icon'  => $request->icon,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        $notification = array(
            'message'    => 'Data Skill Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.data.skill')->with($notification);
    }

    public function EditDataSkill($id) {
        $dataskill = Data_Skill::findOrFail($id);

        return view('admin.backend.data_skill.edit_data_skill', compact('dataskill'));
    }

    public function UpdateDataSkill(Request $request) {
        $data_skill_id = $request->id;

        Data_Skill::findOrFail($data_skill_id)->update([
            'icon'  => $request->icon,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        $notification = array(
            'message'    => 'Data Skill Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.data.skill')->with($notification);
    }

    public function DeleteDataSkill($id) {
        Data_Skill::findOrFail($id)->delete();

        $notification = array(
            'message'    => 'Data Skill Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.data.skill')->with($notification);
    }
}
