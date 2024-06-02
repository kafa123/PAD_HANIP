<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $student = Student::where('user_id',$user->id)->first();
            $skill = Skill::where('student_id', $student->id)->get();
            // dd($skill);
            return response()->json(['data' => $skill]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $skill = Skill::with('student.user')->findOrFail($id,'id');
            return response()->json(['data' => $skill]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $student = Student::where('user_id',$user->id)->first();
            // dd($student->id);
            $request->validate([
                'skill' => 'required',
                'achievement name' => 'required',
                'achievement type' => 'required',
                'achievement level' => 'required',
                'achievement year' => 'required',
                'description' => '',
            ]);
            $data = $request->all();
            $data['student_id'] = $student->id;

            $skill = Skill::create($data);

            return response()->json(['data' => $skill], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $student = Student::where('user_id',$user->id)->first();

            $request->validate([
                'skill' => 'required',
                'achievement name' => 'required',
                'achievement type' => 'required',
                'achievement level' => 'required',
                'achievement year' => 'required',
                'description' => '',
            ]);

            $skill = Skill::findOrFail($id);
            $data = $request->all();
            $data['student_id'] = $student->id;

            $skill->update($data);

            return response()->json(['data' => $skill], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $skill = Skill::findOrFail($id);
            $skill->delete();

            return response()->json("delete success", 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
