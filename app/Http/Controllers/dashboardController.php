<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class dashboardController extends Controller
{
    public function dashboard_page()
    {
        $projects = Project::with('teamMembers')->where('user_id', session('LoggedUser'))->paginate(4);
        return view('dashboard.dashboard', compact('projects'));
    }


    public function create_project()
    {
        return view('dashboard.projects');
    }

    public function project_create_post(Request $request)
    {
        $request->validate([
            'projectName' => 'required|string|max:255',
            'projectDesc' => 'required',
            'projectDeadline' => 'required',
            'projectStatus' => 'required',
            'members.*.name' => 'required|string|max:255',
            'members.*.role' => 'required|string|max:255',

        ]);
        $deadline_jalali = ($request->input('projectDeadline'));
        if (!$deadline_jalali > Jalalian::now()) {
            return redirect()->back()->with('timePass', 'تاریخ انتخابی نمیتواند قدیمی باشد.');
        }
        $deadline_miladi = Jalalian::fromFormat('Y/m/d', $deadline_jalali)->toCarbon()->toDateString();

        $status = $request->input('projectStatus');
        $name = $request->input('projectName');
        $desc = $request->input('projectDesc');

        $project = new Project();
        $project['user_id'] = session('LoggedUser');
        $project['name'] = $name;
        $project['deadline'] = $deadline_miladi;
        $project['status'] = $status;
        $project['description'] = $desc;
        $project->save();

        if (!$request->input('members') == null) {
            $project_id = $project['id'];
            foreach ($request->input('members') as $member) {
                if (!TeamMember::where('name', $member['name'])->exists()) {
                    $teamMember = new TeamMember();
                    $teamMember['name'] = $member['name'];
                    $teamMember->save();
                }
                $project = Project::findOrFail($project_id);
                $member_id = TeamMember::where('name', $member['name'])->select('id')->first()->id;
                $members = TeamMember::findOrFail($member_id);
                $project->teamMembers()->attach($members->id, ['role' => $member['role']]);
            }
        }

        return redirect()->route('dashboard_page');
    }

    public function project_edit()
    {
        $projects = Project::find($_GET['id']);
        return view('dashboard.edit', compact('projects'));
    }
    public function project_edit_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'members.*.name' => 'required|string|max:255',
            'members.*.role' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        $deadline_jalali = $request->input('projectDeadline');
        if (!$deadline_jalali > Jalalian::now()) {
            return redirect()->back()->with('timePass', 'تاریخ انتخابی نمیتواند قدیمی باشد.');
        }

        $deadline_miladi = Jalalian::fromFormat('Y/m/d', $deadline_jalali)->toCarbon();
        $projects = $request->all();
        $project = Project::findOrFail($request->input('id'));
        $project->name = $projects['name'];
        $project->description = $projects['description'];

        $project->deadline = $deadline_miladi;

        $project->status = $projects['status'];

        $project->save();

        if (!$request->input('members') == null) {
            $project = Project::find($project['id']);
            $project->teamMembers()->detach();
                foreach ($request->input('members') as $memberInput) {
                    if (!TeamMember::where('name', $memberInput['name'])->exists()) {
                        $teamMember = new TeamMember();
                        $teamMember['name'] = $memberInput['name'];
                        $teamMember->save();
                    }
                    $member_id = TeamMember::where('name', $memberInput['name'])->select('id')->first()->id;
                    $project->teamMembers()->attach($member_id, ['role' => $memberInput['role']]);
                }
            }
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
