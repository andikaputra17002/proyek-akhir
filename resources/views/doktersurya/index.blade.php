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
                        <h2 class="content-header-title float-left mb-0">Data Pendaftaran Pasien Dokter Rohmah</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-list-view" class="data-list-view-header">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card border-primary text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <h2 class="text-bold-400">Informasi Nomor Antrian Saat Ini </h2>
                                    <div class="bg-rgba-primary p-50 m-0 mb-1 mt-1">
                                        <div class="avatar-content">
                                            <p class="mb-0 font-medium-3">001</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card border-primary text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <h2 class="text-bold-400">Sisa Nomor Antrian Saat Ini </h2>
                                    <div class="bg-rgba-primary p-50 m-0 mb-1 mt-1">
                                        <div class="avatar-content">
                                            <p class="mb-0 font-medium-3">002</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DataTable starts -->
                <div class="table-responsive">
                    <table class="table zero-configuration text-center" id="datatabledokterrohmah">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Nama Pasien</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Nama Dokter</th>
                                <th>Jam Periksa</th>
                                <th>BPJS/Non-BPJS</th>
                                <th>Nomor Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Risky</td>
                                <td>2022/04/25</td>
                                <td>Dr. Rohmah</td>
                                <td>17.00 - 22.00</td>
                                <td>Non-BPJS</td>
                                <td>001</td>
                                <th> <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        id="tambah" data-bs-target="#exampleModal">
                                        Periksa
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>Putra</td>
                                <td>2022/04/25</td>
                                <td>Dr. Rohmah</td>
                                <td>17.00 - 22.00</td>
                                <td>Non-BPJS</td>
                                <td>002</td>
                                <th><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        id="tambah" data-bs-target="#exampleModal">
                                        Periksa
                                    </button></th>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>Dikki</td>
                                <td>2022/04/25</td>
                                <td>Dr. Rohmah</td>
                                <td>17.00 - 22.00</td>
                                <td>Non-BPJS</td>
                                <td>003</td>
                                <th><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        id="tambah" data-bs-target="#exampleModal">
                                        Periksa
                                    </button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- DataTable ends -->
            </section>
            <!-- Data list view end -->
        </div>
    </div>
</div>
@push('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });

    // $('#datatabledokterrohmah').DataTable({
           
    //        serverside : true,
    //        responsive : true,
    //        ajax : {
    //         //    url : "{{route('dokterrohmah.index')}}"
    //        },
    //        columns:[
    //                {
    //                    "data" :null, "sortable": false,
    //                    render : function (data, type, row, meta) {
    //                        return meta.row + meta.settings._iDisplayStart + 1
    //                    }
    //                },
    //                 {data: 'name', name: 'name'},
    //                 {data: 'tgl_pendaftaran', name: 'tgl_pendaftaran'},
    //                 {data: 'nama_dokter', name: 'nama_dokter'},
    //                 {data: 'jam_periksa', name: 'jam_periksa'},
    //                 {data: 'bpjs', name: 'bpjs'},
    //                 {data: 'nomor_antrian', name: 'nomor_antrian'},
    //                 {data: 'aksi', name: 'aksi'}
    //            ]
    // });

    // Tambah Data
    

</script>

@endpush

@endsection