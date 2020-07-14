@if(isset($categoryName))
<h1 class="my-4">
    Category:
    <small>{{ $categoryName }}</small>
</h1>
@endif @if(isset($authorName))
<h1 class="my-4">
    Author:
    <small>{{ $authorName }}</small>
</h1>
@endif @if(isset($tagName))
<h1 class="my-4">
    Tag:
    <small>{{ $tagName }}</small>
</h1>
@endif @if($term=request('term'))
<h1 class="my-4">
    Search result for:
    <small>{{ $term }}</small>
</h1>
@endif @if(! $posts->count())
<div class="alert alert-warning">
    <h1 class="my-4">Nothing Found</h1>
</div>
@endif
