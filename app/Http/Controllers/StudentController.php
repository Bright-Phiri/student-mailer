<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index')->with('students', Student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $saved = $student->save();
        if (!$saved) {
            return response()->json(['status' => 'Failed to add student', 'icon' => 'error']);
        } else {
            return response()->json(['status' => 'Student successfully saved', 'icon' => 'info']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('student.edit')->with('student', Student::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student = Student::find($request->id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $updated = $student->update();
        if (!$updated) {
            return response()->json(['status' => 'Failed to update student', 'icon' => 'error']);
        } else {
            return response()->json(['status' => 'Student successfully updated', 'icon' => 'info']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::onlyTrashed()->find($id);
        $deleted = $student->forceDelete();
        if (!$deleted) {
            return response()->json(['status' => 'Failed to delete student', 'icon' => 'error']);
        } else {
            return response()->json(['status' => 'Student successfully deleted', 'icon' => 'info']);
        }
    }

    public function archive($id)
    {
        $student = Student::find($id);
        $archieved = $student->delete();
        if (!$archieved) {
            return response()->json(['status' => 'Failed to archive student', 'icon' => 'error']);
        } else {
            return response()->json(['status' => 'Student added to archieved list', 'icon' => 'info']);
        }
    }

    public function mail()
    {
        return view('student.mail');
    }

    public function send(Request $request)
    {
        $data = array(
            'subject' => $request->subject,
            'message' => $request->message
        );
        $students = Student::all()->pluck('email');
        foreach ($students as $student) {
            Mail::to($student)->send(new SendMail($data));
        }
        return response()->json(['status' => 'Mail sent']);
    }

    public function restore($id)
    {
        $student = Student::onlyTrashed()->find($id);
        $restored = $student->restore();
        if (!$restored) {
            return response()->json(['status' => 'Failed to restore student', 'icon' => 'error']);
        } else {
            return response()->json(['status' => 'Student successfully restored', 'icon' => 'info']);
        }
    }

    public function trashed()
    {
        return view('student.archive')->with('students', Student::onlyTrashed()->get());
    }

    public function settings()
    {
        return view('student.settings');
    }
}