@extends('layout.admin-lte')

@section('page-title', __('Órdenes'))

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Órdenes') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('Órdenes') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="order-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="order-kitchen-tab" data-toggle="pill"
                                        href="#order-kitchen" role="tab" aria-controls="order-kitchen"
                                        aria-selected="true">{{ __('En cocina') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="order-done-tab" data-toggle="pill"
                                        href="#order-done" role="tab" aria-controls="order-done"
                                        aria-selected="false">{{ __('Historial') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="order-tabContent">
                                <div class="tab-pane fade show active" id="order-kitchen" role="tabpanel"
                                    aria-labelledby="order-kitchen-tab">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{ __('Listado') }}
                                                <a class="btn btn-sm btn-primary btn-icon" id="new-order" href="#">
                                                    <i class="icon-plus22"></i> {{ __('nueva orden') }}
                                                </a>
                                            </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool refresh-data">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="order-kitchen-dt" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('#') }}</th>
                                                        <th>{{ __('Nro') }}</th>
                                                        <th>{{ __('Estado') }}</th>
                                                        <th>{{ __('Usuario') }}</th>
                                                        <th>{{ __('Creado el') }}</th>
                                                        <th>{{ __('Actualizado el') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="overlay card-loading d-none">
                                            <i class="fas fa-2x fa-sync fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="order-done" role="tabpanel"
                                    aria-labelledby="order-done-tab">
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{ __('Listado') }}
                                            </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool refresh-data">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="order-done-dt" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('#') }}</th>
                                                        <th>{{ __('Nro') }}</th>
                                                        <th>{{ __('Estado') }}</th>
                                                        <th>{{ __('Usuario') }}</th>
                                                        <th>{{ __('Creado el') }}</th>
                                                        <th>{{ __('Actualizado el') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="overlay card-loading d-none">
                                            <i class="fas fa-2x fa-sync fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var orderKitchenDt = $('#order-kitchen-dt').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.datatable', ['in-kitchen' => true]) }}",
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        "data": "id",
                        render: function(a, b, row) {
                            return '<a href="javascript:void(0)" class="details-control">' + row.id + '</a>';
                        }
                    },
                    {
                        "data": "order_number"
                    },
                    {
                        "data": "status",
                        render: function(a, b, row) {
                            switch (row.status) {
                                case 'Completado':
                                    bagde = '<span class="badge badge-success">' + row.status +
                                        '</span>';
                                    break;
                                default:
                                    bagde = '<span class="badge badge-primary">' + row.status +
                                        '</span>';
                                    break;
                            }

                            return bagde;
                        }
                    },
                    {
                        "data": "user.name"
                    },
                    {
                        "data": "created_at",
                        render: function(a, b, row) {
                            var date = row.created_at.split("T");
                            return date[0] + '<div class="small text-muted">' + date[1] + '</div>';
                        }
                    },
                    {
                        "data": "updated_at",
                        render: function(a, b, row) {
                            var date = row.updated_at.split("T");
                            return date[0] + '<div class="small text-muted">' + date[1] + '</div>';
                        }
                    },
                ],
                "order": [
                    [0, "desc"]
                ],
                preDrawCallback: function() {
                    $('.card-loading').removeClass('d-none');
                },
                drawCallback: function() {
                    $('.card-loading').addClass('d-none');
                }
            });

            var detailRows = [];
            $('#order-kitchen-dt tbody').on('click', 'tr td a.details-control', function() {
                var tr = $(this).closest('tr');
                var row = orderKitchenDt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(renderAdditionalInfo(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            // On each draw, loop over the `detailRows` array and show any child rows
            orderKitchenDt.on('draw', function() {
                $.each(detailRows, function(i, id) {
                    $('#' + id + ' td.details-control').trigger('click');
                });
            });

            var orderDoneDt = $('#order-done-dt').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.datatable') }}",
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        "data": "id",
                        render: function(a, b, row) {
                            return '<a href="javascript:void(0)" class="details-control">' + row.id + '</a>';
                        }
                    },
                    {
                        "data": "order_number"
                    },
                    {
                        "data": "status",
                        render: function(a, b, row) {
                            switch (row.status) {
                                case 'Completado':
                                    bagde = '<span class="badge badge-success">' + row.status +
                                        '</span>';
                                    break;
                                default:
                                    bagde = '<span class="badge badge-primary">' + row.status +
                                        '</span>';
                                    break;
                            }

                            return bagde;
                        }
                    },
                    {
                        "data": "user.name"
                    },
                    {
                        "data": "created_at",
                        render: function(a, b, row) {
                            var date = row.created_at.split("T");
                            return date[0] + '<div class="small text-muted">' + date[1] + '</div>';
                        }
                    },
                    {
                        "data": "updated_at",
                        render: function(a, b, row) {
                            var date = row.updated_at.split("T");
                            return date[0] + '<div class="small text-muted">' + date[1] + '</div>';
                        }
                    },
                ],
                "order": [
                    [0, "desc"]
                ],
                preDrawCallback: function() {
                    $('.card-loading').removeClass('d-none');
                },
                drawCallback: function() {
                    $('.card-loading').addClass('d-none');
                }
            });

            var detailDoneRows = [];
            $('#order-done-dt tbody').on('click', 'tr td a.details-control', function() {
                var tr = $(this).closest('tr');
                var row = orderDoneDt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailDoneRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailDoneRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(renderAdditionalInfo(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailDoneRows.push(tr.attr('id'));
                    }
                }
            });

            // On each draw, loop over the `detailDoneRows` array and show any child rows
            orderDoneDt.on('draw', function() {
                $.each(detailDoneRows, function(i, id) {
                    $('#' + id + ' td.details-control').trigger('click');
                });
            });

            $(document).on('click', '.refresh-data', function() {
                orderKitchenDt.ajax.reload();
                orderDoneDt.ajax.reload();
            });

            $(document).on('click', '#new-order', function() {
                $('.card-loading').removeClass('d-none');

                $.post("{{ route('order.new') }}", {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }).done(function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        })
                    }
                    orderKitchenDt.ajax.reload();
                    orderDoneDt.ajax.reload();
                })
            });

            function renderAdditionalInfo(data) {
                var tempView = '';

                $.each(data.details, function(index, detail) {
                    tempView = `
                        <div class="row bg-white rounded p-3">
                            <div class="col-md-12">
                                <h5><b>Plato</b>: ` + detail.recipe.name + `</h5>
                                <p><b>Lista de Ingredientes</b></p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-gradient-secondary">
                                            <th>Ingrediente</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    `;
                    $.each(detail.recipe.products, function(index2, product) {
                        tempView += `
                                        <tr>
                                            <td>` + product.name + `</td>
                                            <td>` + product.pivot.quantity + `</td>
                                        </tr>
                                    `;
                    });

                    tempView += `
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                });
                return tempView;
            }
        });
    </script>
@endsection
