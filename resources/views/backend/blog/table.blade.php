<table class="table table-bordered">
                    <thead>
                    <tr>
                    <td width="80">Action</td>
                    <td>Title</td>
                    <td width="120">Author</td>
                    <td width="150">Category</td>
                    <td width="150">Date</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $request=request(); ?>
                    @foreach( $posts as $post )
                    <tr>
                    <td>
                    {!! Form::open(['method'=>'DELETE','route'=>['blog.destroy',$post->id]]) !!}
                    @if(check_user_permission($request, "Blog@edit", $post->id))
                    <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i></a>
                    @else
                        <a href="#" class="btn btn-xs btn-default disabled">
                        <i class="fa fa-edit"></i></a>
                    @endif
                    @if(check_user_permission($request, "Blog@destroy", $post->id))
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                    @else
                    <button type="submit" onclick="return false;" class="btn btn-xs btn-danger disabled"><i class="fa fa-times"></i></button>
                    @endif
                    <!-- <a href="{{ route('blog.destroy', $post->id) }}" class="btn btn-xs btn-danger"></a> -->
                    
                    {!! Form::close() !!}
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td> <abbr title="{{ $post->dateFormatted(true) }}"> {{ $post->dateFormatted() }}</abbr> | {!! $post->publicationLabel() !!} </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>