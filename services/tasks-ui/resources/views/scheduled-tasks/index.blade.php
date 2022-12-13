@extends('layout.admin-lte')

@section('page-title', __('Scheduled Tasks'))

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Scheduled Tasks') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('Scheduled Tasks') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('New Record') }}
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool refresh-data">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        {!! Form::open(['route' => 'scheduled_tasks.create', 'method' => 'POST', 'role' => 'form', 'id' => 'new-form']) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="daysOfMonth">Days of Month</label>
                                        {!! Form::select('daysOfMonth', $daysOfMonth, null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="months">Months</label>
                                        {!! Form::select('months', $months, null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="daysOfWeek">Days of Week</label>
                                        {!! Form::select('daysOfWeek[]', $daysOfWeek, null, ['class' => 'form-control', 'required', 'multiple']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="durationType">Duration Type</label>
                                        {!! Form::select('durationType', $durationType, null, ['class' => 'form-control', 'required', 'id' => 'durationType']) !!}
                                    </div>
                                </div>
                                <div class="col-12" id="range">
                                    <div class="form-group">
                                        <label for="durationValueRange">Duration Range</label>
                                        {!! Form::text('durationValueRange', null, ['class' => 'form-control', 'id' => 'durationRange']) !!}
                                    </div>
                                </div>
                                <div class="col-12" id="quantity">
                                    <div class="form-group">
                                        <label for="durationValueQuantity">Duration Quantity</label>
                                        {!! Form::text('durationValueQuantity', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                        <div class="overlay card-loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function(){
            $('#durationRange').daterangepicker({
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": "|"
                }
            });

            $(document).on('change', '#durationType', function(){
                if($(this).val() == 'Date range'){
                    $('#range').show();
                    $('#quantity').hide();
                }else{
                    $('#range').hide();
                    $('#quantity').show();
                }
            });

            $('#durationType').trigger('change');
        })
    </script>
@endsection
