<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use App\moneyuser;
use Illuminate\Support\Facades\Auth;  // You need this Code and Add it to Controller for get Current user
use DB;

class StudentController extends Controller
{
     public function index(Request $request)   
    {
        //
        $user = Auth::user();   // Now Add this for get Current user
        
        $data['students'] = moneyuser::where('name', $user->name)->where('email', $user->email)->paginate(3); 
        if ($request->ajax()) {
            return view('student.list', $data);
        }
        return view('student.list',$data);
    }

    // I could show You how can get data from table where user is current

    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$student = new moneyuser([
            'name' => $request->post('name'),
            'email'=> $request->post('email'),
            'type' => $request->post('type'),
            'amount'=> $request->post('amount'),
            'category' => $request->post('category'),
            'mode'=> $request->post('mode'),
            'note' => $request->post('note'),
            'date'=> $request->post('date')
        ]);
		$student->save();    
        //return Response::json($student);
        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
		return view('student.view',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
		$where = array('id' => $id);
        $student  = moneyuser::where($where)->first();
 
        
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$student = moneyuser::find($request->post('hdnStudentId')); 
        $student->name = $request->post('name');
        $student->email = $request->post('email');
        $student->type = $request->post('type');
        $student->amount = $request->post('amount');
        $student->category = $request->post('category');
        $student->mode = $request->post('mode');
        $student->note = $request->post('note');
        $student->date = $request->post('date');
        $student->update();
        //return Response::json($student);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$student = moneyuser::where('id',$id)->delete();
        //return Response::json($student);
        return response()->json($student);
    }


    // Show Data ---------------------------------------------------------

    public function index1(Request $request)
    {
        $students = DB::table('moneyusers')->orderBy('id', 'DESC')->paginate(3);
        if ($request->ajax()) {
            return view('student.data', compact('students'));
        }
        return view('student.index', compact('students'));  
    }
    
    
    //   this is for show all our data from table
    function index2()
    {
       $user = Auth::user();
       $data = moneyuser::where('name', $user->name)->where('email', $user->email)->paginate(3);
       return view('student.pagination', compact('data'));
    }


    //this is for call paginate by Ajax
   function fetch_data(Request $request)
      {
    if($request->ajax())
        {
           $user = Auth::user();
           $data = moneyuser::where('name', $user->name)->where('email', $user->email)->paginate(3);
           return view('student.pagination_data', compact('data'))->render();
    }
    //  THANKS

      }
   // search   find
   public function search(Request $request){
    $search = $request->input('search');

    $members = moneyuser::where('type', 'like', "$search%")
       ->orWhere('amount', 'like', "$search%")
       ->orWhere('category', 'like', "$search%")
       ->orWhere('mode', 'like', "$search%")
       ->orWhere('note', 'like', "$search%")
       ->orWhere('date', 'like', "$search%")
       ->get();

    return view('student.result')->with('members', $members);
    }

    public function viewmember($id){

        $member = moneyuser::find($id);

        return view('student.member')->with('member', $member);
    }

    public function index3(Request $request){
        //$search = 'fffffffff';
        //$search = $request->date;
        // $search = $request->input('search');
        $user = Auth::user();
        $id = $request->date;
        //$search  = moneyuser::where($where)->first();
        $search = moneyuser::where('name', $user->name)->where('email', $user->email)->where('id', $id)->paginate(3);

    	return view('student.lis')->with('search', $search);
    }
    
    public function index4(Request $request){
        $user = Auth::user();
        $id = $request->date;
        $data = moneyuser::where('name', $user->name)->where('email', $user->email)->paginate(3);
        return view('student.pagination', compact('data'));
    }
    

    public function showview($id)
    {
        
		$where = array('id' => $id);
        $student  = moneyuser::where($where)->first();
 
        
        return response()->json($student);
        
    }

    //stuview
    public function stuview(Request $request)
    {
        //
		$data = moneyuser::where($request->post('Id'));
        // $user = Auth::user();   // Now Add this for get Current user
        
        // $data['students'] = moneyuser::where('name', $user->name)->where('email', $user->email)->paginate(3); 
        if ($request->ajax()) {
            return view('student.list', $data);
        }
        return view('student.list',$data);
		   
    }


    public function search1(Request $request){
        $search = $request->input('search');
    // this is for get data by call of Ajax
        $members = moneyuser::where('type', 'like', "$search%")
           ->orWhere('amount', 'like', "$search%")
           ->orWhere('category', 'like', "$search%")
           ->orWhere('mode', 'like', "$search%")
           ->orWhere('note', 'like', "$search%")
           ->orWhere('date', 'like', "$search%")
           ->get();
    
        return view('student.result')->with('members', $members);
        }

}
