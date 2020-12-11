@extends('frontend.frontend_master')
@section('post_content')

      <!-- Latest Posts -->
      <main class="posts-listing col-lg-8"> 
        <div class="container">
          <div class="row">
            @foreach ($all_published_posts as $post)
            <!-- post -->
            <div class="post col-xl-6">
              <?php if ($post->post_image != NULL) { ?>
                <div class="post-thumbnail"><a href="{{ URL::to('post/'.$post->post_id) }}"><img src="{{asset($post->post_image)}}" alt="..." class="img-fluid"></a></div>
              <?php } ?>
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="date meta-last">20 May | 2016</div>
                  <div class="category"><a href="#">Business</a></div>
                </div><a href="{{ URL::to('post/'.$post->post_id) }}">
                  <h3 class="h4">{{$post->post_title}}</h3></a>
                <p class="text-muted">{!!$post->post_Short_description!!}</p>
                <div class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                    <strong>Posted By: </strong>
                    <div class="title"><span>{{$post->author_name}}</span></div></a>
                  <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <!-- Pagination -->
          <nav aria-label="Page navigation example">
            <ul class="pagination pagination-template d-flex justify-content-center">
              <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
              <li class="page-item"><a href="#" class="page-link active">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
            </ul>
          </nav>
        </div>
      </main>
      
      
   

  @endsection