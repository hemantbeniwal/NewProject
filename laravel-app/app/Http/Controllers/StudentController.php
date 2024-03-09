<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student_qualification;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $qualification = Student_qualification::all();
        // return view ('student.index');
        return view('student.index', compact('students','qualification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'email|required',
            'dob'=> 'required',
            'phone'=> 'required',
            'gender'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'pin_code'=> 'required',
            'state'=> 'required',
            'country'=> 'required',
            'hobbies'=> 'required',
            // 'qualification'=> 'required',
            'courses'=> 'required',
        ]);
        
        $data = $request->all();
        // $request->first_name;
        // dd($data);
        $data['hobbies'] = implode(',', $data['hobbies']);
        // dd($data);
        $students = Student::create($data);
        $stId = $students->id;
        $examination = $request->examination;
        $board = $request->board;
        $percentage = $request->percentage;
        $passing_of_year = $request->year_of_passing;
        // dd($stId );
        foreach($examination as $key => $_exam){
            Student_qualification::create([
                
                'student_id' => $stId,
                'examination' => $_exam,
                'board' => $board[$key],
                'percentage'=> $percentage[$key],
                'year_of_passing'=> $passing_of_year[$key]
            ]);
        }
        return redirect()->route('student.index');
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
        //
        // echo $id;
        // $student = Student::select('name', 'email')->where('id', $id)->first();
        $student = Student::find($id);
        // $qualification = Student_qualification::where('student_id',$id)->get();
        // dd($qualification);
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $data = $request->except('_token', '_method');
        // $data= $request->all();
        // dd($data);
        $data['hobbies'] =  implode (',', $data['hobbies']);
        // $data['courses'] =  implode (',', $data['courses']);

        $student->update($data);

        $stuId = $request->stuId;
        $_board = $request->board;
        $_examination = $request->examination;
        $_percentage = $request->percentage;
        $_year_of_passing = $request->year_of_passing;
        // dd($_board);
        foreach($_examination as $key => $_exam){
            $stId = $stuId[$key];
            // dd($stId);
            Student_qualification::where('id',$stId)->update([
                'examination'=>$_exam,
                'percentage'=>$_percentage[$key],
                'year_of_passing'=>$_year_of_passing[$key],
                'board'=>$_board[$key],
                
            ]);
        }
        return redirect()->route('student.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // dd($id);
        Student::where('id',$id)->delete();
        Student_qualification::where('student_id',$id)->delete();
        return redirect()->route('student.index');
        //
        // dd($id);
    }
}
