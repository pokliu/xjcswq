@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="type" value="{{ $post->type }}">
            <div class="form-group row">
                <label for="title" class="col-md-2 form-control-label">{{ $post->type_name }}：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="title" placeholder="填写{{ $post->type_name}}" value="{{ $post->title }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-md-2 form-control-label">内容：</label>
                <div class="col-md-10">
                    <textarea type="text" class="form-control" name="content" rows="20" placeholder="填写内容">{{ $post->content }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-md-2 form-control-label">图片：</label>
                <div class="col-md-10">
                    <input multiple id="uploader" type="file" name="images[]"/>
                    @if (!is_null($post->images) && count($post->images) > 0)
                        <p style="color:sandybrown">当前编辑的{{ $post->type_name }}已上传了{{ count($post->images) }}张图片，若重新选择图片将删除已上传的图片</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">确认提交</button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-default" type="reset">重置</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection