<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PostController extends Controller
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
        $posts=DB::table('posts')->get();
        return view('backend.pages.manage_post',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $published_catagory=DB::table('catagories')->where('publication_status',1)->get();
        return view('backend.pages.add_post',['published_catagory' => $published_catagory]);
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
            'post_title' => 'required|unique:posts|max:250',
            'catagory_id' => 'required',
            'post_long_description' => 'required',
	        'publication_status' => 'required',
    	]);
        $data=array();
		$data['catagory_id']=$request->catagory_id;
		$data['post_title']=$request->post_title;
		$data['author_name']=$request->author_name;
		$data['post_Short_description']=$request->post_Short_description;
		$data['post_long_description']=$request->post_long_description;
        $data['publication_status']=$request->publication_status;
        date_default_timezone_set("Asia/Dhaka");//for timezone 
        $data['created_at']=date('Y-m-d h:i:s');
		// $success=DB::table('posts')->insert($data);
        $image=$request->file('post_image');
        // echo '<pre>';
        // print_r($image);
        // exit();
        if ($image) {
            $image_name=Str::random(10);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/images/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['post_image']=$image_url;
            $success=DB::table('posts')->insert($data);
            if($success){
                $notification=array(
                    'messege'=>'post created successfully!',
                    'alert-type'=>'success'
                );
            return redirect('/posts')->with($notification);
            }
        } else {
            $success=DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post Created successfully!',
                'alert-type'=>'success'
            );
        return  Redirect('/posts')->with($notification);
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
    {   $catagory=DB::table('catagories')->where('publication_status',1)->get();
        $post = DB::table('posts')->where('post_id',$id)->first();
        
        return view('backend.pages.edit_post',['post' => $post,'published_catagory'=>$catagory]);
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
            'post_title' => 'required|max:250',
            'catagory_id' => 'required',
            'post_long_description' => 'required',
    	]);
        $data=array();
        $post_id=$request->post_id;
        $old_image=$request->post_old_image;
		$data['catagory_id']=$request->catagory_id;
		$data['post_title']=$request->post_title;
		$data['author_name']=$request->author_name;
		$data['post_Short_description']=$request->post_Short_description;
		$data['post_long_description']=$request->post_long_description;
        date_default_timezone_set("Asia/Dhaka");//for timezone 
        $data['updated_at']=date('Y-m-d h:i:s');
        $image=$request->file('post_image');
        if ($image) {
            $image_name=Str::random(10);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/images/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['post_image']=$image_url;
            $success=DB::table('posts')->where('post_id',$post_id)->update($data);
            if ($old_image) {
                unlink($old_image);
            }
            if($success){
                $notification=array(
                    'messege'=>'Information Updated successfully!',
                    'alert-type'=>'success'
                );
            return redirect('/posts')->with($notification);
            }
        } else {
            $success=DB::table('posts')->where('post_id',$post_id)->update($data);
            $notification=array(
                'messege'=>'Information Updated successfully!',
                'alert-type'=>'success'
            );
        return  Redirect('/posts')->with($notification);
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
        $post=DB::table('posts')->where('post_id', $id)->first();
        $image=$post->post_image;
        // echo "<pre>";
        // print_r($post);
        // exit();
        $delete=DB::table('posts')->where('post_id', $id)->delete();
        if($delete){
            if ($image) {unlink($image); }
			$notification=array(
				'messege'=>'Data deleted successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}
    }
    public function publishPost($id)
    {
        $data= array();
        $data['publication_status']=1;
        $publish=DB::table('posts')
                    ->where('post_id', $id)
                    ->update($data);
        if($publish){
			$notification=array(
				'messege'=>'Post Published successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}
    }
    public function unpublishPost($id)
    {
        $data= array();
        $data['publication_status']=0;
        $publish=DB::table('posts')
                    ->where('post_id', $id)
                    ->update($data);
        if($publish){
			$notification=array(
				'messege'=>'Post Unpublished successfully!',
				'alert-type'=>'success'
			);
			return redirect()->back()->with($notification);
		}
    }
}
