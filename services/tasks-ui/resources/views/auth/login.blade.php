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
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-register">Sign up</a>
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
    </div>
    <!-- /.login-box -->

    <div class="modal fade" id="modal-register">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-outline card-primary">
                    <h4 class="modal-title">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'auth.sign_up', 'method' => 'POST', 'role' => 'form', 'id' => 'signup-form']) !!}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your name']) !!}
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email']) !!}
                            </div>

                            <div class="form-group">
                                <label for="pass">Password</label>
                                {!! Form::password('pass', ['class' => 'form-control', 'placeholder' => 'Enter your password']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#login-form').validate({
                rules: {
                    'email': {
                        required: true
                    },
                    'pass': {
                        required: true
                    }
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-control').addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-control').removeClass('is-invalid');
                }
            })

            $('#signup-form').validate({
                rules: {
                    'email': {
                        required: true
                    },
                    'pass': {
                        required: true
                    },
                    'name': {
                        required: true
                    },
                },
                messages: {
                    'email': {
                        required: "The email field is required"
                    },
                    'pass': {
                        required: "The password field is required"
                    },
                    'name': {
                        required: "The name field is required"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-control').addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-control').removeClass('is-invalid');
                }
            })
        })
    </script>
@endsection
