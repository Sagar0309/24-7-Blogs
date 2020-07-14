<!-- Sidebar Widgets Column -->
<div class="col-md-4">
    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form action="{{ route('blog') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="term" value="{{ request('term') }}" placeholder="Search for..." />
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('category',$category->slug) }}"><i class="fa fa-angle-right">{{ $category->title }}</i></a>
                    <span class="badge pull-right"> {{ $category->posts->count() }} </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- <div class="card my-4">
        <div class="card-header">
            <h4>Tweets</h4>
        </div>
        <div class="card-body" style="height: 600px; overflow-x: auto;">
            <a class="twitter-timeline" href="https://twitter.com/LogUpdateAfrica?ref_src=twsrc%5Etfw"> Tweets by LogUpdateAfrica</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div> -->

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div>
</div>
<!-- /.row -->
