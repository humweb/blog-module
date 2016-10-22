@section('content')
    {!! Form::open(['route' => ['post.admin.blog.posts.update', $post->id], 'id' => 'update-post']) !!}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Update Blog Post</h4></div>
        <div class="panel-body">
            @include('blog::forms.posts.fields')
        </div>
        <div class="panel-footer">
            <a href="#" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>

@endsection
