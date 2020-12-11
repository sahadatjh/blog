<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CatagoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $catagories=DB::table('catagories')
                    ->get();
        return view('backend.pages.manage_catagory',['catagories' => $catagories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.add_catagory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'catagory_name' => 'required|unique:catagories',
	        'publication_status' => 'required',
    	]);
		$data=array();
		$data['catagory_name']=$request->catagory_name;
		$data['catagory_description']=$request->catagory_description;
        $data['publication_status']=$request->publication_status;
        date_default_timezone_set("Asia/Dhaka");//for timezone 
        $data['created_at']=date('Y-m-d h:i:s');
		$success=DB::table('catagories')->insert($data);
		
		if($success){
			$notification=array(
				'messege'=>'Catagory created successfully!',
				'alert-type'=>'success'
			);
			return redirect('/manage/catagory')->with($notification);
		}else{
			$notification=array(
				'messege'=>'Something wents wrong!!!',
				'alert-type'=>'error'
			);
			return redirect('/manage/catagory')->with($notification);
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
        $catagory = DB::table('catagories')->where('id',$id)->first();
        
        return view('backend.pages.edit_catagory',['catagory' => $catagory]);
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
        $validatedData=$request->validate([
            'catagory_name' => 'required',
    	]);
		$data=array();
		$id=$request->id;
		$data['catagory_name']=$request->catagory_name;
        $data['catagory_description']=$request->catagory_description;
        date_default_timezone_set("Asia/Dhaka");//for timezone 
        $data['updated_at']=date('Y-m-d h:i:s');
		$success=DB::table('catagories')->where('id',$id)->update($data);
		
		if($success){
			$notification=array(
				'messege'=>'Catagory updated successfully!',
				'alert-type'=>'success'
			);
			return redirect('/manage/catagory')->with($notification);
		}else{
			$notification=array(
				'messege'=>'Nothing to update!!!',
				'alert-type'=>'warning'
			);
			return redirect('/manage/catagory')->with($notification);
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
        $delete=DB::table('catagories')->where('id', $id)->delete();
        if($delete){
			$notification=array(
				'messege'=>'Data deleted successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}else{
			$notification=array(
				'messege'=>'Something wents wrong!!!',
				'alert-type'=>'error'
			);
			return redirect()->back()->with($notification);
		}
    }
    public function publishCatagory($id)
    {
        $data= array();
        $data['publication_status']=1;
        $publish=DB::table('catagories')
                    ->where('id', $id)
                    ->update($data);
        if($publish){
			$notification=array(
				'messege'=>'Catagory Published successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}else{
			$notification=array(
				'messege'=>'Something wents wrong!!!',
				'alert-type'=>'error'
			);
			return redirect()->back()->with($notification);
		}
    }
    public function unpublishCatagory($id)
    {
        $data= array();
        $data['publication_status']=0;
        $publish=DB::table('catagories')
                    ->where('id', $id)
                    ->update($data);
        if($publish){
			$notification=array(
				'messege'=>'Catagory Unpublished successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}else{
			$notification=array(
				'messege'=>'Something wents wrong!!!',
				'alert-type'=>'error'
			);
			return redirect()->back()->with($notification);
		}
    }
}
