@php
    $title = __('post.no_posts');
    $body = __('post.no_posts_message');
    $header ="<span class=\"align-self-center\">{$title}</span>";
    if (isset($category) && (!is_null($category))){
        $catlink = "<a class=\"btn btn-link\" href=\"%s\">
            %s
        </a>";
    	$catname =sprintf($catlink, route("category.view", $category->slug), $category->name);
        $header .= "<div>{$catname}</div>";
    }
@endphp

<x-card class="mb-3" :body="['text' => $body, 'class'=>'d-flex h-100 justify-content-between bg-danger text-light']"
        :header="['text' => $header, 'class'=>'d-flex h-100 justify-content-between']"></x-card>
