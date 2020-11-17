@php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    /**
    * @var App\Models\Post $post
    */
    /**
    * @var User $user
    */
    $user = Auth::user();
    $likec = $user->hasLiked($post)? ' press' : '';
    $likes= $post->likes()->count();
    $comments= $post->comments()->count();
    $id = $post->id;
    $time = $post->toLocalTime('created_at')['for_human'] ;
    $footer   = "<span class=\"align-self-center\">{$time}</span>";
    $footer  .= "
    <div class='row'>
        <div class='post-action'>
            <span id=\"comments-{$id}\" class=\"action-counter\">{$comments}</span>
            <div class=\"comment-btn float-right\" data-id=\"{$id}\">
                <i class=\"fas fa-comments\"></i>
            </div>
        </div>
        <div class='post-action'>
            <span id=\"likes-{$id}\" class=\"action-counter\">{$likes}</span>
            <div class=\"like-btn float-right{$likec}\" data-id=\"{$id}\">
                <i class=\"fas fa-heart{$likec}\"></i>
                <span class=\"{$likec}\">liked!</span>
            </div>
        </div>
    </div>
    ";

    $name = $post->user->name;
    $catlink = "<a class=\"btn btn-link\" href=\"%s\">
            %s
        </a>";
    if ((is_null($post->category))) {
    	$catname =__('post.uncategorised');
    }
    else {
    	$catname =sprintf($catlink, route("category.view", $post->category->slug), $post->category->name);
    }
    $header ="<span class=\"align-self-center\">{$name}</span>";
    $header .= "<div>{$catname}</div>";
@endphp
<x-card class="mb-3" id="pid-{{ $post->id }}" :body="['text' => $post->text]"
        :header="['text' => $header, 'class'=>'d-flex h-100 justify-content-between']"
        :footer="['text' => $footer, 'class'=>'d-flex h-100 justify-content-between']"></x-card>

@once
@push('js')
    <script>
		$(function(){
			$(".like-btn")
				.click(function(){
					let $this  = $(this);
					let like   = $(this)
						             .hasClass("press") ? "-" : "+";
					let id     = $this
						.data("id");
					let _token = $("meta[name=\"csrf-token\"]")
						.attr("content");

					$.ajax({
						       url:  "{{ route('post.create') }}/" + id,
						       type: "PUT",
						       data: {
							       id:     id,
							       like:   like,
							       _token: _token,
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
							 $this
								 .toggleClass("press", 1000);
							 $this
								 .children("span")
								 .toggleClass("press", 1000);
							 $this
								 .children("i")
								 .toggleClass("press", 1000);
							 $("#likes-" + id)
								 .text(response.likes);
						 }
					 })
					 .fail(function(xhr){
						 let response = $.parseJSON(xhr.responseText);
						 if(response){
							 alert(response.message);
							 $("#likes-" + id)
								 .text(response.likes);
						 }
					 });

				});
		});
    </script>
@endpush
@endonce
