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
        <form action="/post" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="{{ $data->type }}">
            <div class="form-group row">
                <label for="title" class="col-md-2 form-control-label">{{ $data->type_name }}：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="title" placeholder="填写{{ $data->type_name}}" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-md-2 form-control-label">内容：</label>
                <div class="col-md-10">
                    <textarea type="text" class="form-control" name="content" rows="20" placeholder="填写内容">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-md-2 form-control-label">图片：</label>
                <div class="col-md-10">
                    <input multiple id="uploader" type="file" name="images[]" value="{{ old('images[]') }}" />
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