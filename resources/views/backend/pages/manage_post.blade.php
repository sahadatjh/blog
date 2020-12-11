@extends('backend.backend_master')
@section('content')

			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="{{route('home')}}">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Catagories</a></li>
			</ul>
		
				    <a href="{{route('add.post')}}" class="btn btn-success pull-right" style="margin:10px"><i class=" halflings-icon white plus"></i> Add New</a>
               
            
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Posts manage here</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sl No</th>
								  <th>Photo</th>
								  <th>Title</th>
								  <th>Author Name</th>
								  <th>Posted At</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							  @foreach ($posts as $row)
							<tr>
								<td>{{$row->post_id}}</td>
								<td class="center">
									<?php if ($row->post_image != NULL) { ?>
										<img src="{{asset($row->post_image)}}" alt="post image" style="height: 50px;">
									<?php } else{ echo 'No Image'; }?>

								</td>
								<td class="center">{{$row->post_title}}</td>
								<td class="center">{{$row->author_name}}</td>
								<td class="center">{{$row->created_at}}</td>
								<td class="center">
									@if ($row->publication_status === 1)
										<span class="label label-success">Published</span>
									@elseif ($row->publication_status === 0)
										<span class="label ">Unpublished</span>
									@endif
								</td>
								<td class="center">
										@if ($row->publication_status === 0)
											<a class="btn btn-success" href="{{ URL::to('publish/post/'.$row->post_id) }}" title="Click for publish">
												<i class="halflings-icon white thumbs-up"></i> 
											</a>
										@elseif ($row->publication_status === 1)
											<a class="btn btn-warning" href="{{ URL::to('unpublish/post/'.$row->post_id) }}" title="Click for unpublish">
												<i class="halflings-icon white thumbs-down"></i>
											</a> 
										@endif
									
									<a class="btn btn-info" href="{{URL::to('edit/post/'.$row->post_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{ URL::to('delete/post/'.$row->post_id) }}" onclick="return checkDelete()">
										<i class="halflings-icon white trash" ></i> 
									</a>
								</td>
							</tr>
							@endforeach
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			
    
    
@endsection