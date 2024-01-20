<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\LastEducation;
use App\Models\TrainingHistory;
use App\Models\User;
use App\Models\WorkHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('users.id', 'b.name', 'b.birth_date', 'b.position_applied')
            ->leftJoin('biodatas as b', function ($join) {
                $join->on('users.id', '=', 'b.user_id');
            })
            ->where('is_admin', false)
            ->when($request->name, fn ($q) => $q->where('b.name', 'LIKE', "%$request->name%"))
            ->when($request->birth_date, fn ($q) => $q->where('b.birth_date', 'LIKE', "%$request->birth_date%"))
            ->when($request->position_applied, fn ($q) => $q->where('b.position_applied', "LIKE", "%$request->position_applied%"))
            ->get();

        return view('user.index', compact('users'));
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $biodata = Biodata::where('user_id', auth()->user()->id)->first();
        return view('user.profile', compact('biodata', 'user'));
    }

    public function edit_biodata($id)
    {
        $user = User::find($id);
        $biodata = Biodata::where('user_id', $id)->first();
        return view('user.profile', compact('biodata', 'user'));
    }

    public function update_profile(Request $request)
    {
        $data = $request->only(['name', 'email']);

        if ($request->password) $data['password'] = bcrypt($request->password);

        User::find(auth()->user()->id)->update($data);

        return back()->with('success1', 'Profile Berhasil diupdate');

    }

    public function update_biodata(Request $request, $id)
    {
        $biodata = Biodata::where('user_id', $id)->first();

        $data = $request->only(
            'position_applied',
            'name',
            'no_ktp',
            'birth_date',
            'golongan_darah',
            'gender',
            'religion',
            'email',
            'no_telp',
            'status',
            'related_person',
            'ktp_address',
            'address',
            'job_placement_confirmation',
            'skills',
            'salary_expecation'
        );

        $data['job_placement_confirmation'] = $request->job_placement_confirmation == 'true' ? true : false;

        if ($biodata) {
            $biodata->update($data);
            $biodata->last_educations()->delete();
            $biodata->training_histories()->delete();
            $biodata->work_histories()->delete();
        } else {
            $data['user_id'] = $id;
            $biodata = Biodata::create($data);
        }

        foreach ($request->education_namme ?? [] as $key => $education_name) {
            LastEducation::create([
                'biodata_id' => $biodata->id,
                'education_namme' => $education_name,
                'institution' => $request->institution[$key],
                'major' => $request->major[$key],
                'graduation_date' => $request->graduation_date[$key],
                'ipk' => $request->ipk[$key]
            ]);
        }

        foreach ($request->training_name ?? [] as $key => $training) {
            TrainingHistory::create([
                'biodata_id' => $biodata->id,
                'name' => $training,
                'certificate' => $request->certificate[$key] == 'true' ? 1 : 0,
                'graduation_date' => $request->graduation_date_training[$key]
            ]);
        }

        foreach ($request->company_name ?? [] as $key => $company_name) {
            WorkHistory::create([
                'biodata_id' => $biodata->id,
                'company_name' => $company_name,
                'last_position' => $request->last_position[$key],
                'last_salary' => $request->last_salary[$key],
                'work_date' => $request->work_date[$key]
            ]);
        }

        return back()->with('success2', 'Biodata Berhasil diupdate');
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
