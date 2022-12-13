@extends('layout.admin-lte')

@section('page-title', __('Tasks'))

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Tasks Manager') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('Tasks Manager') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">{{ __('Task Groups') }}</h5>
            @foreach ($lists as $key => $list)
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('List of Tasks for') }}: <strong>{{ $key }}</strong>
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
                                        <th>{{ __('Execute At') }}</th>
                                        <th>{{ __('Scheduling ID') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($list->data) <= 0)
                                        <tr>
                                            <td colspan="6" class="text-center">{{ __('No data available') }}</td>
                                        </tr>
                                    @endif

                                    @foreach ($list->data as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->executeAt }}</td>
                                            <td>{{ $data->scheduledTaskId }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->createdAt }}</td>
                                            <td>
                                                @if(session('_user')->id == $data->userId && $data->status == 'pending')
                                                    <a href="{{ route('tasks.completed', ['taskId' => $data->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-clipboard-check"></i> completed</a>
                                                @endif
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
                                            <a class="page-link" href="{{ route('tasks.index', ['page' => $link->label, 'filter' => $key]) }}">{!! $link->label !!}</a>
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
            @endforeach
        </div>
    </section>
@endsection

@section('js')
    <script>
    </script>
@endsection
