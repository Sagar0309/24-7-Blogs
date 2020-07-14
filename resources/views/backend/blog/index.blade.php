@extends('layouts.backend.main')

@section('title','MyBlog | Index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Display all blog posts</small>
      </h1>
      <ol class="breadcrumb">
        <li > <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> <a href="{{ route('blog.index') }} ">Blog</a></li>
        <li class="active">All Posts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-header clearfix">
              <div class="pull-left">
              <a href="{{ route('blog.create') }}" class="btn btn-success" > <i class="fa fa-plus"></i> Add New </a>
              </div>
              <div class="pull-right" style="padding:7px 0;">
              <a href="?status=own">Own [{{ $statusList['own'] }}]</a> |
              <a href="?status=all">All [{{ $statusList['all'] }}]</a> |
              <a href="?status=published">Published [{{ $statusList['published'] }}]</a> |
              <a href="?status=schedule">Schedule [{{ $statusList['scheduled'] }}]</a> |
              <a href="?status=draft">Draft [{{ $statusList['draft'] }}]</a> |
              <a href="?status=trash">Trash [{{ $statusList['trash'] }}]</a>
              </div>
              </div>
              <div class="box-body ">
                    @include('backend.blog.message') 
                    @if(! $posts->count())
                    <div class="alert alert-danger">
                    <strong>No records found.</strong>
                    </div>
                    @endif
                    @if($onlyTrashed)
                       @include('backend.blog.table-trash')
                    @else
                       @include('backend.blog.table')
                    @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
              <div class="pull-left">
              <ul class="pagination no-margin pagination-sm">
              <!-- <li><a href="#">&laquo;</a></li> -->
              {{ $posts->appends( Request::query() )->render() }}
              <!-- <li><a href="#">&raquo;</a></li> -->
              </ul>
              </div>
              <div class="pull-right">
                 <small>{{ $postCount }} {{ str_plural('Item', $postCount) }} </small>
              </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script type="text/javascript">
$('ul.pagination').addClass('no-margin pagination-sm');
</script>
@endsection


