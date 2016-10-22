@section('content')

        {!! Form::open(['route' => 'post.admin.blog.posts.create', 'id' => 'create-post']) !!}
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Create Blog Post</h4></div>
            <div class="panel-body">
            @include('blog::forms.posts.fields')
            </div>
            <div class="panel-footer">
                <a href="#" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
        </form>

@endsection