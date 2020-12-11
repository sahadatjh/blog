<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontendHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepage_posts=DB::table('posts')->where('publication_status',1)->orderBy('hit_count','desc')->take(3)->get();
        $latest_posts=DB::table('posts')->where('publication_status',1)->orderBy('post_id','desc')->take(6)->get();
        // echo "<pre>";
        // print_r($homepage_posts);
        // exit();
        return view('frontend.pages.home',['homepage_posts'=>$homepage_posts,'latest_posts'=>$latest_posts]);
    }
    public function blogPosts(){
        $latest_posts=DB::table('posts')->where('publication_status',1)->orderBy('post_id','desc')->take(5)->get();
        $all_published_posts=DB::table('posts')->where('publication_status',1)->get();
        $sidebar=1;//for show sidebar
        
        $popular_posts=DB::table('posts')->where('publication_status',1)->orderBy('hit_count','desc')->take(5)->get();
        return view('frontend.pages.blog_posts',compact('all_published_posts','latest_posts','sidebar','popular_posts'));
        // return view('frontend.pages.blog_posts',['all_published_posts'=>$all_published_posts]);
    }

    public function singlePost($id){

        $con=array();
		$con['post_id']=$id;
		$con['publication_status']=1;
        $single_post_stored=DB::table('posts')->where($con)->first();
        //hit count
        $data=array();
        $data['hit_count']=$single_post_stored->hit_count+1;
        DB::table('posts')->where('post_id',$id)->update($data);
        $single_post=DB::table('posts')->where($con)->first();

        $latest_posts=DB::table('posts')->where('publication_status',1)->orderBy('post_id','desc')->take(5)->get();
        $popular_posts=DB::table('posts')->where('publication_status',1)->orderBy('hit_count','desc')->take(5)->get();
        $sidebar=1;//for show sidebar
        return view('frontend.pages.single_posts',compact('single_post','latest_posts','popular_posts','sidebar'));
    }
    public function blogPostByCatagory($catagory_id){
        $blogPostByCatagory=DB::table('posts')->where(['publication_status'=>1,'catagory_id'=>$catagory_id])->orderBy('post_id','desc')->get();
        $latest_posts=DB::table('posts')->where('publication_status',1)->orderBy('post_id','desc')->take(5)->get();
        $all_published_posts=DB::table('posts')->where('publication_status',1)->get();
        $sidebar=1;//for show sidebar        
        $popular_posts=DB::table('posts')->where('publication_status',1)->orderBy('hit_count','desc')->take(5)->get();
        return view('frontend.pages.blog_posts',['all_published_posts'=>$blogPostByCatagory,'latest_posts'=>$latest_posts,'popular_posts'=>$popular_posts,'sidebar'=>1]);
    }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
