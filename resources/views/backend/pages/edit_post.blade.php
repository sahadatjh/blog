@extends('backend.backend_master')
@section('content')
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Update Post</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Post Information</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
							
						@if ($errors->any())								
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
							</ul>										
						</div>
					@endif
				
						<form class="form-horizontal" method="POST" action="{{route('update.post')}}" enctype="multipart/form-data" name="post_edit_form">
                            @csrf
                            @method('POST')
						  <fieldset>
							
							<div class="control-group">
							  	<label class="control-label" for="post_title">{{ __('Post title') }}</label>
							  	<div class="controls">
									<input id="post_title" type="text" class="span5" name="post_title" value="{{$post->post_title}}" required  autocomplete="post_title" autofocus>
									<input type="hidden" name="author_name" value="{{Auth::user()->name}}" >
									<input type="hidden" name="post_id" value="{{$post->post_id}}" >
								</div>
                            </div>
                            <div class="control-group">
								<label class="control-label" for="catagory">Category</label>
								<div class="controls">
								  <select id="catagory" data-rel="chosen" class="span4" name="catagory_id"> 
                                      <option value="">Select One</option>
									@foreach ($published_catagory as $item)
									    <option value="{{$item->id}}" <?php if ($item->id==$post->catagory_id) {echo "selected";}?>>{{$item->catagory_name}}</option>
                                      @endforeach
								  </select>
								</div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="post_Short_description">Post Short Description</label>
							  <div class="controls">
								<textarea name="post_Short_description" class="cleditor" id="post_Short_description" rows="3">{{$post->post_Short_description}}</textarea>
							  </div>
                            </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="post_long_description">Post long Description</label>
							  <div class="controls">
								<textarea name="post_long_description" class="cleditor" id="post_long_description" rows="3">{{$post->post_long_description}}</textarea>
							  </div>
                            </div>
                            <div class="control-group">
								<label class="control-label">Post Image</label>
								<div class="controls">
								  <input type="file" name="post_image" >
								  <input type="hidden" name="post_old_image" value="{{$post->post_image}}" >
								  <img src="{{asset($post->post_image)}}" alt="" srcset="" height="120px" width="150px">
								</div>
							</div>
                            
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Post</button>
                              {{-- <button type="reset" class="btn">Cancel</button> --}}
                              <a href="{{url('/posts')}}" class="btn ">Cancel</a>
							</div>
						  </fieldset>
						</form>   
						
					</div>
					
				</div><!--/span-->

			</div><!--/row-->			
@endsection