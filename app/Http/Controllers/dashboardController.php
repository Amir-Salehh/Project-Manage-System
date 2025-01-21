<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function dashboard_page()
    {
        $projects = Project::all()->where('user_id', session('LoggedUser'));
        return view('dashboard.dashboard', compact('projects'));
    }


    public function create_project()
    {
        return view('dashboard.projects');
    }

    public function project_post(Request $request)
    {
        $request->validate([
            'projectName' => 'required',
            'projectDesc' => 'required',
            'projectDeadline' => 'required|date|after_or_equal:today',
            'projectStatus' => 'required',
        ]);
        if ($request->projectStatus == 'فعال') {
            $status = 1;
        } else {
            $status = 0;
        }
        $name = $request->input('projectName');
        $desc = $request->input('projectDesc');
        $deadline = $request->input('projectDeadline');

        DB::table('projects')->insert([
            'user_id' => session('LoggedUser'),
            'name' => $name,
            'description' => $desc,
            'deadline' => $deadline,
            'status' => $status,
        ]);

        return redirect()->route('dashboard_page');
    }

    public function project_edit()
    {
        $projects = Project::where('id', $_GET['id'])->paginate(3);
        return view('dashboard.edit', compact('projects'));
    }
    public function project_edit_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'status' => 'required',
        ]);
        $projects = $request->all();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'status' => 'required',
        ]);
        $projects = $request->all();

        $project = Project::findOrFail($request->input('id'));
        $project->name = $projects['name'];
        $project->description = $projects['description'];
        $project->deadline = $projects['deadline'];
        $project->status = $projects['status'];

        $project->save();

        return redirect()->route('dashboard_page')->with('update', 'پروژه با موفقیت به روز شد');

    }

    public function project_done()
    {
        $id = $_GET['id'];
        $project = Project::all()->where('id', $id)->first();
        $project->status = 1;
        $project->save();

        return redirect()->back();
    }

    public function delete_project()
    {
        $id = $_GET['id'];
        Project::destroy($id);

        return redirect()->back();
    }
}
