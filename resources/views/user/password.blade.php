@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">修改密码</div>

                    <div class="panel-body">
                        <form action="/password/update" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">原始密码</label>
                                <div class="col-md-6">
                                    <input id="old_password" type="password" name="old_password" class="form-control">
                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">新密码</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary btn-block">
                                        确定修改
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
