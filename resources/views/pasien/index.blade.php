@extends('layouts.app')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Data Pasien</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-list-view" class="data-list-view-header">
                <!-- DataTable starts -->
                <div class="table-responsive">
                    <table class="table zero-configuration text-center" id="datatable1">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Image</th>
                                <th>Nama Pasien</th>
                                <th>No Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- DataTable ends -->
            </section>
            <!-- Data list view end -->
        </div>
    </div>
</div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        isi()
    })
    function isi() {
        $('#datatable1').DataTable({
            serverside : true,
            responsive : true,
            ajax : {
                url : "{{route('pasien.index')}}"
            },
            columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    // { data: 'DT_Row_Index', name:'DT_RowIndex'},
                    {data: 'photoProfile', name: 'photoProfile'},
                    {data: 'name', name: 'name'},
                    {data: 'no_tlp', name: 'no_tlp'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                    {data: 'alamat', name: 'alamat'},
                    // {data: 'aksi', name: 'aksi'}
                ]
        })
    }
</script>

@endpush

@endsection