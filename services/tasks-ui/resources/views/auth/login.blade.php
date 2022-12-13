@extends('layout.auth')

@section('page-title', __('Login'))

@section('content')
    <div class="login-box">
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h3">{{ __('Tasks') }} <b>{{ __('<Manager>') }}</b></a>
              </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Enter your credentials') }}</p>

                {!! Form::open(['route' => 'auth.login', 'method' => 'POST', 'role' => 'form', 'id' => 'login-form']) !!}
                    <div class="input-group mb-3">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Email'), 'required']) !!}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        {!! Form::password('pass', ['class' => 'form-control', 'placeholder' => __('Password')]) !!}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.login-card-body -->
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <b>{{ __('Email') }}:</b> admin@example.com
            </div>
            <div class="col-md-12">
                <b>{{ __('Pass') }}:</b> securepassword
            </div>
        </div>
    </div>
    <!-- /.login-box -->
@endsection

@section('js')
<script>
$(function(){
    $('#login-form').validate({
        rules: {
            'email': {required: true},
            'pass': {required: true}
        },
        messages: {
            'email': {
                required: "The email field is required"
            },
            'pass': {
                required: "The password field is required"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-control').removeClass('is-invalid');
        }
    })
})
</script>
@endsection
