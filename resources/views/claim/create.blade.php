@extends('layouts.dist')

@section('content')
    <div class="claim_form" style="padding-bottom: 16px">
        <div class="title"><h3>索赔申报</h3></div>
        @if ($status == 'success')
            <div class="alert alert-success">
                您已成功提交索赔申报！
            </div>
        @endif
        <form action="/claim" method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-2 form-control-label">姓名：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" placeholder="填写姓名" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-md-2 form-control-label"><span class="muted">*</span>电话：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" placeholder="填写电话号码" value="{{ old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="location" class="col-md-2 form-control-label"><span class="muted">*</span>省份与地区：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" placeholder="填写省份与地区" value="{{ old('location') }}" required>
                    @if ($errors->has('location'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-2 form-control-label"><span class="muted">*</span>常用E-mail地址：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="填写电子邮箱" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="post_id" class="col-md-2 form-control-label"><span class="muted">*</span>索赔对象：</label>
                <div class="col-md-10">
                    <select class="form-control{{ $errors->has('post_id') ? ' is-invalid' : '' }}" name="post_id" placeholder="选择索赔对象" required>
                        @foreach($options as $option)
                            <option value="{{ $option->id }}" {{ (old('post_id')? old('post_id'): $id) == $option->id? 'selected': '' }}>{{ $option->title }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('post_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('post_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="bought_time" class="col-md-2 form-control-label"><span class="muted">*</span>购买该证券时间(可多个)：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('bought_time') ? ' is-invalid' : '' }}" name="bought_time" placeholder="填写时间，逗号隔开" value="{{ old('bought_time') }}" required>
                    @if ($errors->has('bought_time'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('bought_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="sold_time" class="col-md-2 form-control-label"><span class="muted">*</span>卖出该证券时间(可多个)：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('sold_time') ? ' is-invalid' : '' }}" name="sold_time" placeholder="填写时间，逗号隔开" value="{{ old('sold_time') }}" required>
                    @if ($errors->has('sold_time'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sold_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-2 form-control-label"><span class="muted">*</span>备注：</label>
                <div class="col-md-10">
                    <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="6" placeholder="可描述与索赔相关事实，包括但不限于买入数量，股数，损失等" required>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="captcha" class="col-md-2 form-control-label"><span class="muted">*</span>验证码：</label>
                <div class="col-md-6">
                    <input type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" placeholder="填写验证码" required>
                    @if ($errors->has('captcha'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('captcha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-4">
                    <img src="/captcha" alt="验证码" style="cursor: pointer" onclick="this.setAttribute('src', '/captcha?'+Math.random())">
                </div>
            </div>
            <div class="form-group row">
                <label for="captcha" class="col-md-2 form-control-label"></label>
                <div class="col-md-10">
                    <input type="checkbox" onclick="document.getElementById('submit_btn').disabled = !event.srcElement.checked" required>
                    <span class="muted">*(必选项)</span>我已阅读并同意《<a href="/static/agreement" target="_blank">用户信息保密协议</a>》
                </div>
            </div>
            <div style="text-align: center">
                <button class="btn btn-primary" type="submit" id="submit_btn" disabled>提交</button>
                <button class="btn btn-default" type="reset" style="margin-left: 16px">重置</button>
            </div>
        </form>
    </div>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endsection

@section('scripts')
    <script src="/js/bootstrap.min.js"></script>
@endsection