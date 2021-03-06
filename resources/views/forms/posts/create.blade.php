@section('content')

    {!! Form::open(['route' => 'post.admin.blog.posts.create', 'id' => 'create-post']) !!}
    <div class="card card-default">
        <div class="card-header"><h4>Create Blog Post</h4></div>
        <div class="card-body">
            @include('blog::forms.posts.fields')
        </div>
        <div class="card-footer">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
    </form>

@endsection
