<div class="form-group">
    <label for="">Title</label>
    {!! Form::text('title', isset($post->title) ? $post->title : null, ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    <label for="">Slug</label>
    {!! Form::text('slug', isset($post->slug) ? $post->slug : null, ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    <label for="">Content</label>
    {!! Form::textarea('content_html', isset($post->content_html) ? $post->content_html : null, ['class' => 'form-control', 'type'=>'text', 'rows'=>'20']); !!}
</div>
