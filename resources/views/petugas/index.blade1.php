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
                        <h2 class="content-header-title float-left mb-0">Data Petugas</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data List</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-list-view" class="data-list-view-header">
                <!-- DataTable starts -->
                <div class="table-responsive">
                    <button type="button" class="btn btn-outline-primary feather icon-plus" data-bs-toggle="modal"
                        id="tambah" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <table class="table zero-configuration text-center" id="datatable2">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Image</th>
                                <th>Nama Petugas</th>
                                <th>Email</th>
                                <th>Roles</th>
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
                                <h5 class="modal-title" id="modal-judul">Tambah Data Petugas Baru</h5>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="form1" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    {{-- <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Password Confirmation</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation">
                                    </div> --}}
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-category">Roles</label>
                                        {{-- <select class="form-control" disabled="disabled" id="roles" name="roles">
                                            --}}
                                            <select class="form-control" id="roles" name="roles">
                                                {{-- <option value="ADMIN" selected>Admin</option> --}}
                                                <option value="ADMIN" selected>Admin</option>
                                            </select>
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
                                        <input type="text" class="form-control" id="no_tlp" name="no_tlp">
                                    </div>
                                    <div class="col-sm-12 data-field-col img-holder ">
                                        <label for="data-price">Upload Image</label>
                                        <input type="file" class="form-control" id="photoProfile" name="photoProfile"
                                            onchange="readURL(this);">
                                    </div>
                                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview"
                                        class="form-group hidden mt-1" width="100" height="100">
                                </form>
                                <div class="modal-footer">
                                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                        <div class="add-data-btn px-1">
                                            <button class="btn btn-primary" type="submit" id="simpan">Simpan</button>
                                        </div>
                                        <div class="cancel-data-btn">
                                            <button class="btn btn-outline-danger" data-bs-dismiss="modal"
                                                id="tutup">Cancel</button>
                                        </div>
                                    </div>
                                </div>
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


<script>
    $(document).ready(function () {
        isi()
    })
    function isi() {
        $('#datatable2').DataTable({
            serverside : true,
            responsive : true,
            ajax : {
                url : "{{route('user.index')}}"
            },
            columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta, col) {
                            return meta.row + meta.settings._iDisplayStart + 1 
                        }
                    },
                    // {data: 'id', name: 'id', 'visible': false},
                    {data: 'photoProfile', name: 'photoProfile'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles', name: 'roles'},
                    {data: 'aksi', name: 'aksi'}
                ],
                
                order: [[0, 'desc']]
        })
    }
</script>

<script>
    // $('#tambah').click(function () {
    //     $('#form1').trigger("reset"); //mereset semua input dll didalamnya form
    //     $('#modal-judul').html("Tambah Pegawai Baru"); // Judul
    //     $('#tambah-edit-modal').modal('show'); //modal tampil
    //     $("#photoProfile").attr("required", "true");
    //     // $('#button-simpan').val("create-post"); //valuenya menjadi create-post
    //     $('#id').val(''); //valuenya menjadi kosong
    //     $('#modal-preview').attr('src', 'https://via.placeholder.com/150');
    // });

    $('#simpan').on('click',function () {
        if ($(this).text() === 'Simpan Edit') {
    //         // console.log('Edit');
        edit()
        } else {
        tambah()
        }
    })

// Tampil form edit
    $(document).on('click', '.edit', function () {
        let id = $(this).attr('id')
        $('#tambah').click()
        $('#simpan').text('Simpan Edit')
        $('#tambah-edit-modal').modal('show');

            $.ajax({
                url : 'user/' + id + '/edit',
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
                    // $('#password_confirmation').val(data.password_confirmation)
                    $('#alamat').val(data.alamat)
                    $('#roles').val(data.roles)
                    $('#jenis_kelamin').val(data.jenis_kelamin)
                    $('#no_tlp').val(data.no_tlp)
                    $("#photoProfile").html(`<img src="/files/${data.photoProfile}" width="100" class="img-fluid img-thumbnail">`);
                    // $("#photoProfile").removeAttr('required');
                    $('#data_photoProfile').val(data.photoProfile)
                }
            })
        });

    // Tambah Data
    function tambah() {
    $.ajax({
        // url : "{{route('user.store')}}",
        type : "post",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data : {
            name : $('#name').val(),
            email : $('#email').val(),
            password : $('#password').val(),
            // password_confirmation : $('#password_confirmation').val(),
            alamat : $('#alamat').val(),
            roles : $('#roles').val(),
            jenis_kelamin : $('#jenis_kelamin').val(),
            no_tlp : $('#no_tlp').val(),
            // photoProfile : $('#photoProfile').val(),
            "_token" : "{{csrf_token()}}"
        },
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                Swal.fire(
                    'Added!',
                    'Petugas Added Successfully!',
                    'success'
                )}
                    $('#tutup').click()
                    $('#tambah-edit-modal').modal('show');
                    // $('#form1')[0].reset()
                    $('#datatable2').DataTable().ajax.reload()
                    $('#name').val(null)
                    $('#email').val(null)
                    $('#password').val(null)
                    $('#alamat').val(null)
                    $('#roles').val(null)
                    $('#jenis_kelamin').val(null)
                    $('#no_tlp').val(null)
                    $('#photoProfile').val(null)
                }    
            })
    }
        
    function edit() {
        $.ajax({
            // url : 'user/update',
            type : "put",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data : {
                id : $('#id').val(),
                name : $('#name').val(),
                email : $('#email').val(),
                password : $('#password').val(),
                // password_confirmation : $('#password_confirmation').val(),
                alamat : $('#alamat').val(),
                roles : $('#roles').val(),
                jenis_kelamin : $('#jenis_kelamin').val(),
                no_tlp : $('#no_tlp').val(),
                photoProfile : $('#photoProfile').val(),
                "_token" : "{{csrf_token()}}"
            },
            success : function (res) {
                Swal.fire(
                    'Added!',
                    'Petugas Added Successfully!',
                    'success'
                    )
                    $('#tutup').click()
                    $('#datatable2').DataTable().ajax.reload()
                    $('#name').val(null)
                    $('#email').val(null)
                    $('#password').val(null)
                    $('#password_confirmation').val(null)
                    $('#alamat').val(null)
                    $('#roles').val(null)
                    $('#jenis_kelamin').val(null)
                    $('#no_tlp').val(null)
                    $('#photoProfile').val(null)
                    $('#simpan').text('Simpan')
                }
        });  
}

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
                    url: "user/" + id, //eksekusi ajax ke url ini
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
                        $('#datatable2').DataTable().ajax.reload()
                    }
                    
                    })
                }
            })
            
        });

</script>
@endpush

@endsection