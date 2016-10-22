@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Pages</div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            {{ $post->slug }}
                        </td>
                        <td>{{ $post->statusText() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="{{ route('get.admin.blog.posts.update', $post->id) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('post.admin.blog.posts.remove', $post->id) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
