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
					<a href="#">Forms</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" action="{{route('update.catagory')}}">
                            @csrf
                            @method('POST')
						  <fieldset>
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
				
							<div class="control-group">
							  <label class="control-label" for="catagory_name">{{ __('Catagory Name') }}</label>
							  <div class="controls">
								<input type="hidden" name="id" value="{{$catagory->id}}">
								<input id="catagory_name" type="text" class="span6" name="catagory_name" value="{{ $catagory->catagory_name }}" required autocomplete="catagory_name">
							</div>
							</div>
							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Catagory Description</label>
							  <div class="controls">
								<textarea name="catagory_description" class="cleditor" id="textarea2" rows="3">{{ $catagory->catagory_description }}</textarea>
							  </div>
                            </div>
                           
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Category</button>
                              {{-- <button type="reset" class="btn">Cancel</button> --}}
                              <a href="{{url('/manage/catagory')}}" class="btn ">Cancel</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

			
@endsection