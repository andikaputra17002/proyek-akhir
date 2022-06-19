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
                        <h2 class="content-header-title float-left mb-0">Data Pendaftaran</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="statistics-card">
                <div class="row">
                    @foreach($dokter as $item)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <p class="text-muted text-bold-700">{{$item->nama_dokter}}</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <h7 class="text-bold-700">No Antrian Sekarang</h7>
                                                <br>
                                                <div class="avatar avatar-xl bg-rgba-info p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <p class="mb-0 text-dark text-bold-200" id="no-{{$item->id}}">@isset($item->pendaftaran[0]) {{$item->pendaftaran[0]->antrian}} @else --- @endisset</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h7 class="text-bold-700">Sisa Antrian</h7>
                                                <br>
                                                <br>
                                                <div class="avatar avatar-xl bg-rgba-info p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <p class="mb-0 text-dark text-bold-200 id="sisa-{{$item->id}}">0</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info btn-next" data-id="{{$item->id}}">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <!-- Data list view starts -->
            <section id="data-list-view" class="data-list-view-header">
                <!-- DataTable starts -->
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-primary feather icon-plus"
                                    data-bs-toggle="modal" id="tambah" data-bs-target="#exampleModal">
                                    Tambah Data
                                </button>
                            </div>
                            <div class="d-flex justify-content-center fw-bold">
                                <h6 class="justify-content-sm-between my-1" for="">filter Dokter</h6>
                            </div>
                            <div class="col-md-3">
                                <select class="filter-dokter form-control filter" id="filter-dokter" name="">
                                    <option value=""></option>
                                    @foreach ($dokter as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_dokter }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-center fw-bold">
                                <h6 class="justify-content-sm-between my-1" for="">filter Jam Periksa</h6>
                            </div>
                            <div class="col-md-3">
                                <select class="filter-dokter form-control filter" id="filter-jam" name="">
                                    <option value=""></option>
                                    @foreach ($jampraktek as $data)
                                    <option value="{{ $data->id }}">{{ $data->jam_praktek }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table zero-configuration text-center" id="datatablependaftaran">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Jam Periksa</th>
                                <th>BPJS/Non-BPJS</th>
                                <th>Nomor Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- DataTable ends -->
                <!-- add new sidebar starts -->

                <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="row"></div>
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-judul">Tambah Data Pendaftaran Pasien</h5>
                                <div class="row">
                                    <button type="button" id="tutup" class="close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true" id="tutup">&times;</span></button>
                                </div>
                            </div>
                            <div class="modal-body" id="modal-body">
                                <form action="" method="post" id="formpendaftaran" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Nama Pasien</label>
                                        <select class="select-name form-control" id="user_id" name="user_id">
                                            <option value=""></option>
                                            @foreach ($pasien as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Nama Dokter</label>
                                        <select class="select-dokter form-control" id="dokter_id" name="dokter_id">
                                            <option value=""></option>
                                            @foreach ($dokter as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_dokter }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col ">
                                        <label for="data-name">Tanggal Pendaftaran</label>
                                        <input type='text' class='datepicker form-control' id="tanggal_pendaftaran"
                                            name="tanggal_pendaftaran" data-language='en' />
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Jam Periksa</label>
                                        <select class="form-control select-jam" id="jam_praktek_id"
                                            name="jam_praktek_id">
                                            <option value=""></option>

                                            <optgroup label="Jam Praktek">
                                                @foreach ($jampraktek as $data)
                                                <option value="{{ $data->id }}">{{ $data->jam_praktek }}</option>
                                                @endforeach
                                            </optgroup>
                                            {{-- <optgroup label="Jam Praktek Malam">
                                                @foreach ($jampraktek as $data)
                                                <option value="{{ $data->id }}">{{ $data->jam_praktek_malam }}
                                                </option>
                                                @endforeach
                                            </optgroup> --}}

                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">BPJS/Non-BPJS</label>
                                        <select class="form-control" id="transaksi" name="transaksi">
                                            <option value=""></option>
                                            <option value="BPJS">BPJS</option>
                                            <option value="Non-BPJS">Non-BPJS</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="add-data-footer d-flex justify-content-around pl-5 mt-2">
                                            <div class="add-data-btn px-1">
                                                <button class="btn btn-primary" type="submit"
                                                    id="simpan">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add new sidebar ends -->
            </section>
            <!-- Data list view end -->
        </div>
    </div>
</div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">
    $('.datepicker').datepicker({
        // format: "dd/mm/yyyy",
        format: "yyyy/mm/dd",
    })
</script>
<script>
    $(document).ready(function(){
        $(".select-name").select2({
            // dropdownParent: $('#formpendaftaran'),
            width: "100%",
            tags: true,
            // allowClear: true,
        });
    });

    $(document).ready(function(){
      $(".select-dokter").select2({
        // dropdownParent: $('#exampleModal'),
        width: "100%",
        tags: true,
      });
    });
    $(document).ready(function(){
      $(".select-jam").select2({
        // dropdownParent: $('#exampleModal'),
        width: "100%",
        tags: true,
      });
    });
    $(document).ready(function(){
      $(".filter-dokter").select2({
        width: "100%",
        tags: true,
      });
    });

</script>

<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    // Data Table
        let fildok = $("#filter-dokter").val()
        let filjam = $("#filter-jam").val()
        const tabel = $('#datatablependaftaran').DataTable({
            serverSide : true,
            responsive : true,
            processing: true,
            ajax : {
                url : "{{route('pendaftaran.index')}}",
                data: function(d){
                    d.fildok = fildok;
                    d.filjam = filjam;
                    return d
                }
            },
            columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'user_id', name: 'user_id.name'},
                    {data: 'dokter_id', name: 'dokter_id.nama_dokter'},
                    {data: 'tanggal_pendaftaran', name: 'tanggal_pendaftaran'},
                    {data: 'jam_praktek_id', name: 'jam_praktek_id'},
                    {data: 'transaksi', name: 'transaksi'},
                    {data: 'antrian', name: 'antrian'},
                    {data: 'aksi', name: 'aksi'}
                ],

                // order: [[0, 'desc']]
        });

    // Tambah Data
    $('#formpendaftaran').submit(function (e) {
            e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                url : "{{route('pendaftaran.store')}}",
                type : "post",
                data: formData,
                // cache:false,
                contentType: false,
                dataType:'json',
                processData: false,
                success: function(response) {
                    // console.log(response);
                        Swal.fire(
                            'Added!',
                            'Pendafataran Added Successfully!',
                            'success'
                            ),
                    // $('#tutup').click()
                    $('#user_id').val(null).trigger('change');
                    $('#dokter_id').val(null).trigger('change');
                    $('#jam_praktek_id').val(null).trigger('change');
                    $('#formpendaftaran')[0].reset();
                    $('#tutup').trigger("reset"); //form reset
                    $('#exampleModal').modal('hide'); //modal hide
                    $('#exampleModal').trigger("reset"); //modal hide
                    $('#datatablependaftaran').DataTable().ajax.reload()
                },
                error : function (xhr) {
                    // console.log('gagal');
                    toastr.error(xhr.responseJSON.text, "GAGAL")
                }
            })
        });

        $(document).on('click', '.periksa', function (e) {
        e.preventDefault();
        var antrian = $(this).data('antrian');
            $.ajax({
                url : "{{route('periksa.store')}}",
                type : 'post',
                data : {
                    'antrian' : antrian,
                    _token : "{{csrf_token()}}"
                },
                success: function (data) {
                    var filteredData = tabel
                        .rows()
                        .indexes()
                        .filter( function ( value, index ) {
                            return tabel.row(value).data()['antrian'] == antrian;
                        } );
                    tabel.rows( filteredData )
                        .remove()
                        .draw();
                }
            })
        });


    $(".filter").on('change', function(){
        fildok =  $("#filter-dokter").val()
        tabel.ajax.reload(null,false)
        // console.log([fildok]);
    });

    $(".filter").on('change', function(){
        filjam =  $("#filter-jam").val()
        tabel.ajax.reload(null,false)
    })

















    // $(document).on('click', '.edit', function (e) {
    //     e.preventDefault();
    //     $('#exampleModal').modal('show')
    //     let id = $(this).attr('id')
    //     $('#modal-judul').html("Edit Data Petugas"); // Judul
    //     $('#tutup').trigger("reset");

    //     var SITEURL = '{{URL::to('')}}';
    //         $.ajax({
    //             url : 'pasien/' + id + '/edit',
    //             type : 'get',
    //             data : {
    //                 id : id,
    //                 _token : "{{csrf_token()}}"
    //             },
    //             success: function (data) {
    //                 console.log(data)
    //                 $('#id').val(data.id)
    //                 $('#name').val(data.name)
    //                 $('#email').val(data.email)
    //                 $('#password').val(data.password)
    //                 $('#password_confirmation').val(data.password_confirmation)
    //                 $('#alamat').val(data.alamat)
    //                 $('#jenis_kelamin').val(data.jenis_kelamin)
    //                 $('#no_tlp').val(data.no_tlp)
    //                 // $("#photoProfile").html(`<img src="/public/files/${data.photoProfile}" width="100" class="img-fluid img-thumbnail">`);
    //                 $('#modal-preview').attr('alt', 'No image available');
    //                 if(data.photoProfile){
    //                 $('#modal-preview').attr('src', SITEURL +'/public/files/'+data.photoProfile);
    //                 $('#hidden_image').attr('src', SITEURL +'/public/files/'+data.photoProfile);
    //                 }
    //                 $('#tutup').trigger("reset");
    //             }
    //         })
    //     });

    // // Hapus
    // $(document).on('click', '.hapus', function () {
    //         id = $(this).attr('id');
    //         Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //             if(result.isConfirmed){
    //                 $.ajax({
    //                 url: "pasien/" + id, //eksekusi ajax ke url ini
    //                 type: 'delete',
    //                 data: {
    //                     id: id,
    //                     "_token" : "{{csrf_token()}}"
    //                 },
    //                 success: function (data) { //jika sukses
    //                     Swal.fire(
    //                     'Deleted!',
    //                     'Your file has been deleted.',
    //                     'success'
    //                     )
    //                     $('#datatablepasien').DataTable().ajax.reload()
    //                 }

    //                 })
    //             }
    //         })

    //     });

    //     function readURL(input, id) {
    //     id = id || '#modal-preview';
    //     if (input.files && input.files[0]) {
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //     $(id).attr('src', e.target.result);
    //     };
    //     reader.readAsDataURL(input.files[0]);
    //     $('#modal-preview').removeClass('hidden');
    //         $('#start').hide();
    //         }
    //     }
</script>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    window.Echo.channel('private-broadcast')
        .listen('.no-antrian', (res) => {
            res['data'].forEach(item =>{
                $('#no-'+item['dokter_id']).html(item['antrian']);
            });
        });

</script>

<script>
    $(document).ready(function(){
        $(".btn-next").click(function(){
            var id = $(this).data('id');
            var antrian = $('#no-'+id).html();
            if(antrian !== '---'){
                $.ajax({
                    url : "{{route('periksa.store')}}",
                    type : 'post',
                    data : {
                        'antrian' : antrian,
                        _token : "{{csrf_token()}}"
                    },
                    success: function (data) {
                        var filteredData = tabel
                            .rows()
                            .indexes()
                            .filter( function ( value, index ) {
                                return tabel.row(value).data()['antrian'] == antrian;
                            } );
                        tabel.rows( filteredData )
                            .remove()
                            .draw();
                    }
                })
            }
        });
    });
</script>
@endpush

@endsection
