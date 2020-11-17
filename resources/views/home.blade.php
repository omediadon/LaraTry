@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-md-10 ml-auto mr-auto">
            <form id="post-form">
                <x-textarea name="post" rows="4" id="post-content" required
                            placeholder="{{ __('app.post_remark') }}"></x-textarea>
                @csrf
                @php
                    /**
                    * @var App\Models\Category[] $categories
                    */
                    $options = [];
                    foreach($categories as $cat){
                    	$options[$cat->id] = $cat->name;
                    }
                @endphp
                <x-select name="post-category" id="post-category" :options="$options"
                          :label="['text' => __('post.categories_select'),]" :grid="['col-3', 'col-9']"
                          :group="['class' =>'align-items-center']"></x-select>
                <div class="row">
                    <div class="col-md-9" id="errors"></div>
                    <div class="col-md-3">
                        <x-link class="btn btn-primary btn-block btn-lg" id="post" text="{{ __('app.post') }}"></x-link>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="main col-md-11 ml-auto mr-auto">

        <div class="row">
            <div class="col-md-2">
                <x-headline tag="h3" text="{{ __('post.categories') }}"></x-headline>
                <ul class="list-group">
                    @foreach($categories as $cat)
                        <li class="list-group-item">
                            <a class="btn btn-link" href="{{ route("category.view", $cat->slug) }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10">
                <x-headline tag="h3" text="{{ __('app.posts_feed') }}"></x-headline>
                @forelse ( $posts as $post)
                    @include('partials.post')
                @empty
                    @include('partials.no_posts')
                @endforelse
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
		$(function(){
			$("textarea")
				.css("resize", "none");

			$("#post")
				.click(function(event){
					event.preventDefault();

					let post     = $("#post-content")
						.val();
					let category = $("#post-category")
						.val();
					let _token   = $("meta[name=\"csrf-token\"]")
						.attr("content");

					$.ajax({
						       url:  "{{ route('post.create') }}",
						       type: "POST",
						       data: {
							       post:     post,
							       category: category,
							       _token:   _token,
						       },
					       })
					 .always(function(xhr, status){
						 if(status === "error"){
							 console.log($.parseJSON(xhr.responseText));
						 }
						 else{
							 console.log(xhr);
						 }
					 })
					 .done(function(response){
						 if(response){
							 showAlert("#errors", response.message, "success", 3000);
							 $("#post-form")
								 .trigger("reset");
						 }
					 })
					 .fail(function(xhr){
						 let response = $.parseJSON(xhr.responseText);
						 if(response){
							 showAlert("#errors", response.message, "danger", 3000);
							 $("#post-form")
								 .trigger("reset");
						 }
					 });
				});
		});
    </script>
@endpush
