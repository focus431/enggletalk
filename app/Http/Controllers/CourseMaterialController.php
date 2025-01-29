<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    public function index()
    {
        $materials = CourseMaterial::all();
        return view('admin_course_materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin_course_materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 驗證其他字段...
        ]);

        $material = new CourseMaterial($request->all());
        $material->save();

        return redirect()->route('admin.course-materials.index')
                         ->with('success', '教材已成功創建。');
    }

    public function show(CourseMaterial $courseMaterial)
    {
        return view('admin_course_materials.show', compact('courseMaterial'));
    }

    public function edit(CourseMaterial $courseMaterial)
    {
        return view('admin_course_materials.edit', compact('courseMaterial'));
    }

    public function update(Request $request, CourseMaterial $courseMaterial)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 驗證其他字段...
        ]);

        $courseMaterial->update($request->all());

        return redirect()->route('admin.course-materials.index')
                         ->with('success', '教材已成功更新。');
    }

    public function destroy(CourseMaterial $courseMaterial)
    {
        $courseMaterial->delete();

        return redirect()->route('admin.course-materials.index')
                         ->with('success', '教材已成功刪除。');
    }
}
