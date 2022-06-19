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
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="tambah"
                        data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <table class="table zero-configuration text-center" id="datatablepasien">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Image</th>
                                <th>Nama Pasien</th>
                                <th>No Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- DataTable ends -->
                <!-- add new sidebar starts -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-judul">Tambah Data Pasien Baru</h5>
                                <button type="button" id="tutup" class="close" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true" id="tutup">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="formpasien" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Nama Pasien</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan Nama Lengkap Pasien">
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Masukkan Email">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan Password">
                                    </div>
                                    <div class=" col-sm-12 data-field-col">
                                        <label for="data-name">Password Confirmation</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Masukkan Confirmation Password" id="password_confirmation">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat"
                                            placeholder="Masukkan Alamat">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="pria">Pria</option>
                                            <option value="wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">Nomer Telepon</label>
                                        <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                            placeholder="Masukkan Nomor Telepon">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    // Data Table
        $('#datatablepasien').DataTable({
            serverSide : true,
            responsive : true,
            processing: true,
            ajax : {
                url : "{{route('pasien.index')}}"
            },
            columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'photoProfile', name: 'photoProfile'},
                    {data: 'name', name: 'name'},
                    {data: 'no_tlp', name: 'no_tlp'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'aksi', name: 'aksi'}
                ],
                
                order: [
                    [0, 'asc']
                ]
        });

    // Tambah Data
    $('#formpasien').submit(function (e) {
            e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                url : "{{route('pasien.store')}}",
                type : "post",
                data: formData,
                cache:false,
                contentType: false,
                dataType:'json',
                processData: false,
                success: function(response) {
                    // console.log(response);
                        Swal.fire(
                            'Added!',
                            'Petugas Added Successfully!',
                            'success'
                            )
                    // $('#tutup').click()
                    $('#formpasien')[0].reset()
                    $('#formpasien').trigger("reset"); //form reset
                    $('#tutup').trigger("reset"); //form reset
                    $('#exampleModal').modal('hide'); //modal hide
                    $('#datatablepasien').DataTable().ajax.reload()
                },
                error : function (xhr) {
                    // console.log('gagal');
                    toastr.error(xhr.responseJSON.text, "GAGAL")
                }     
            })
        });

        var SITEURL = '{{URL::to('')}}';
        $(document).on('click', '.edit', function (e) {
        e.preventDefault(); 
        $('#exampleModal').modal('show')
        let id = $(this).attr('id')
        $('#modal-judul').html("Edit Data Pasien"); // Judul
        $('#tutup').trigger("reset");
        
            $.ajax({
                url : 'pasien/' + id + '/edit',
                type : 'get',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data)
                    $('#id').val(data.id)
                    $('#name').val(data.name)
                    $('#email').val(data.email)
                    $('#password').val(data.password)
                    $('#password_confirmation').val(data.password_confirmation)
                    $('#alamat').val(data.alamat)
                    $('#jenis_kelamin').val(data.jenis_kelamin)
                    $('#no_tlp').val(data.no_tlp)
                    // $("#photoProfile").html(`<img src="/public/files/${data.photoProfile}" width="100" class="img-fluid img-thumbnail">`);
                    $('#modal-preview').attr('alt', 'No image available');
                    if(data.photoProfile){
                    $('#modal-preview').attr('src', SITEURL +'/public/files/'+data.photoProfile);
                    $('#hidden_image').attr('src', SITEURL +'/public/files/'+data.photoProfile);
                    }
                    $('#tutup').trigger("reset");
                }
            })
        });

    // Hapus
    $(document).on('click', '.hapus', function () {
            id = $(this).attr('id');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                    url: "pasien/" + id, //eksekusi ajax ke url ini
                    type: 'delete',
                    data: {
                        id: id,
                        "_token" : "{{csrf_token()}}"
                    },
                    success: function (data) { //jika sukses
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            $('#datatablepasien').DataTable().ajax.reload()
                        }
                        
                    })
                }
            })
            console.log(id);
            
        });

        function readURL(input, id) {
        id = id || '#modal-preview';
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $(id).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
            $('#start').hide();
            }
        }
</script>
@endpush

@endsection