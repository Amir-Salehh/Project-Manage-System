<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class dashboardController extends Controller
{
    public function dashboard_page()
    {
        $projects = Project::where('user_id', session('LoggedUser'))->paginate(4);
        return view('dashboard.dashboard', compact('projects'));
    }


    public function create_project()
    {
        return view('dashboard.projects');
    }

    public function project_create_post(Request $request)
    {
        $request->validate([
            'projectName' => 'required',
            'projectDesc' => 'required',
            'projectDeadline' => 'required',
            'projectStatus' => 'required',
        ]);
        $deadline_jalali = ($request->input('projectDeadline'));
        $deadline_miladi = Jalalian::fromFormat('Y/m/d', $deadline_jalali)->toCarbon();
        if ($deadline_miladi < Carbon::now()) {
            return redirect()->back()->with('timePass', 'تاریخ انتخابی نمیتواند قدیمی باشد.');
        }

        $status = $request->input('projectStatus');
        $name = $request->input('projectName');
        $desc = $request->input('projectDesc');

        DB::table('projects')->insert([
            'user_id' => session('LoggedUser'),
            'name' => $name,
            'description' => $desc,
            'deadline' => $deadline_miladi,
            'status' => $status,
        ]);

        return redirect()->route('dashboard_page');
    }

    public function project_edit()
    {
        $projects = Project::all()->where('id', $_GET['id'])->first();
        return view('dashboard.edit', compact('projects'));
    }
    public function project_edit_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $deadline_jalali = ($request->input('projectDeadline'));
        $deadline_miladi = Jalalian::fromFormat('Y/m/d', $deadline_jalali)->toCarbon();
        if ($deadline_miladi < Carbon::now()) {
            return redirect()->back()->with('timePass', 'تاریخ انتخابی نمیتواند قدیمی باشد.');
        }

        $projects = $request->all();
        $project = Project::findOrFail($request->input('id'));
        $project->name = $projects['name'];
        $project->description = $projects['description'];

        $project->deadline = $deadline_miladi;

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
