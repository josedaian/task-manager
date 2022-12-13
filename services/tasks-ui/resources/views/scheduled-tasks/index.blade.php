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
                                {{ __('List of Scheduled Tasks') }}
                                <a class="btn btn-sm btn-primary btn-icon" href="{{ route('scheduled_tasks.create') }}">
                                    <i class="icon-plus22"></i> {{ __('new scheduling') }}
                                </a>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool refresh-data">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Days of Month') }}</th>
                                        <th>{{ __('Months') }}</th>
                                        <th>{{ __('Days of Week') }}</th>
                                        <th>{{ __('Duration Type') }}</th>
                                        <th>{{ __('Total Tasks') }}</th>
                                        <th>{{ __('Total Executed') }}</th>
                                        <th>{{ __('Execute From') }}</th>
                                        <th>{{ __('Execute To') }}</th>
                                        <th>{{ __('Last Execution') }}</th>
                                        <th>{{ __('Created by') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($list->data) <= 0)
                                        <tr>
                                            <td colspan="13" class="text-center">{{ __('No data available') }}</td>
                                        </tr>
                                    @endif

                                    @foreach ($list->data as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->daysOfMonth }}</td>
                                            <td>{{ $data->months }}</td>
                                            <td>{{ implode(', ', $data->daysOfWeek) }}</td>
                                            <td>{{ $data->durationType }}</td>
                                            <td>{{ $data->totalTasks }}</td>
                                            <td>{{ $data->totalExecuted }}</td>
                                            <td>{{ $data->executeFrom }}</td>
                                            <td>{{ $data->executeTo }}</td>
                                            <td>{{ $data->lastExecution ?? '--' }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->createdAt }}</td>
                                            <td>
                                                <a href="{{ route('tasks.index', ['scheduledTaskId' => $data->id]) }}" target="_blank" class="btn btn-success btn-xs"> view tasks</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                @foreach ($list->links as $link)
                                    @if (is_numeric($link->label))
                                        <li class="page-item @if($link->active) active @endif">
                                            <a class="page-link" href="{{ route('scheduled_tasks.index', ['page' => $link->label]) }}">{!! $link->label !!}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
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
    </script>
@endsection
