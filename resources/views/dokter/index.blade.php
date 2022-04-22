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
                        <h2 class="content-header-title float-left mb-0">Data Dokter</h2>

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
                    <table class="table zero-configuration text-center" id="datatabledokter">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Image</th>
                                <th>Nama Dokter</th>
                                <th>Bidang Dokter</th>
                                <th>Hari Praktek Dokter</th>
                                <th>Jam Praktek Dokter</th>
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
                                <h5 class="modal-title" id="modal-judul">Form Tambah Data Dokter</h5>
                                <button type="button" id="tutup" class="close" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true" id="tutup">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" id="formdokter" enctype="multipart/form-data">
                                    <ul id="save_msgList"></ul>
                                    @csrf
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Nama Dokter</label>
                                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter">
                                        <span class="text-danger error-text nama_dokter_error"></span>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Bidang Dokter</label>
                                        <input type="text" class="form-control" name="bidang_dokter" id="bidang_dokter">
                                        <span class="text-danger error-text bidang_dokter_error"></span>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">Hari Praktek Dokter</label>
                                        <select class="form-control select" id="hari_praktek" name="hari_praktek[]"
                                            multiple="multiple">
                                            {{-- <option value="">Pilih Hari</option> --}}
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="saptu">Saptu</option>
                                            <option value="minggu">Minggu</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">Jam Praktek Dokter</label>
                                        <select class="form-controll mul-select" multiple="multiple" id="jam_praktek"
                                            name="jam_praktek[]">
                                            @foreach ($datta as $data)
                                            <option value="{{ $data->jam_praktek }}">{{ $data->jam_praktek }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col data-list-upload">
                                        <label for="basicInputFile">Upload Image</label>
                                        <input type="file" class="form-control-file" id="photo_dokter"
                                            name="photo_dokter" onchange="readURL(this);">
                                    </div>
                                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview"
                                        class="form-group hidden mt-1" width="100" height="100">
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
      $(".mul-select").select2({
            tags: true,
            tokenSeparators: ["/", ",", ";", " "],
            width: "100%"
      });
    })
</script>

<script>
    $(document).ready(function(){
      $(".select").select2({
        // placeholder: "Pilih Jam Praktek Dokter",
        tags: true,
        tokenSeparators: ["/", ",", ";", " "],
        width: "100%"
      });
    })
</script>

<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });
    $('#datatabledokter').DataTable({
           
           serverside : true,
           responsive : true,
           ajax : {
               url : "{{route('dokter.index')}}"
           },
           columns:[
                   {
                       "data" :null, "sortable": false,
                       render : function (data, type, row, meta) {
                           return meta.row + meta.settings._iDisplayStart + 1
                       }
                   },
                   {data: 'photo_dokter', name: 'photo_dokter'},
                   {data: 'nama_dokter', name: 'nama_dokter'},
                   {data: 'bidang_dokter', name: 'bidang_dokter'},
                   {data: 'hari_praktek', name: 'hari_praktek'},
                   {data: 'jam_praktek', name: 'jam_praktek'},
                   {data: 'aksi', name: 'aksi'}
               ]
       })

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

    // Tambah Data
    $('#formdokter').submit(function (e) {
            e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                url : "{{route('dokter.store')}}",
                type : "post",
                data: formData,
                // cache:false,
                contentType: false,
                dataType:'json',
                processData: false,
                beforeSend:function(){
                        $(formData).find('span.error-text').text('');
                },
                success: function(response) {
                    if(response.status == 400){
                            $.each(response.errors, function(prefix,val){
                                $(formData).find("span."+prefix+'_error').text(val[0]);
                            });
                    }
                    else {
                        // Swal.fire(
                        //     'Added!',
                        //     'Dokter Added Successfully!',
                        //     'success'
                        //     ),
                        //     $('#formdokter')[0].reset()
                        //     $('#formdokter').trigger("reset"); //form reset
                        //     $('#tutup').trigger("reset"); //form reset
                        //     $('#exampleModal').modal('hide'); //modal hide
                        //     $('#datatabledokter').DataTable().ajax.reload()
                    }

                    console.log(response);
                    // if (response.status == 200) {
                    //     Swal.fire(
                    //         'Added!',
                    //         'Dokter Added Successfully!',
                    //         'success'
                    //         )}
                    // // $('#tutup').click()
                    // $('#formdokter')[0].reset()
                    // $('#formdokter').trigger("reset"); //form reset
                    // $('#tutup').trigger("reset"); //form reset
                    // $('#exampleModal').modal('hide'); //modal hide
                    // $('#datatabledokter').DataTable().ajax.reload()
                }    
            })
        });

        // Edit
        $(document).on('click', '.edit', function (e) {
        e.preventDefault(); 
        $('#exampleModal').modal('show')
        let id = $(this).attr('id')
        $('#modal-judul').html("Edit Data Dokter"); // Judul
        $('#tutup').trigger("reset");
        
        var SITEURL = '{{URL::to('')}}';
            $.ajax({
                url : 'dokter/' + id + '/edit',
                type : 'get',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data)
                    $('#id').val(data.id)
                    $('#nama_dokter').val(data.nama_dokter)
                    $('#bidang_dokter').val(data.bidang_dokter)
                    $('#hari_praktek').select2('val', data.hari_praktek.split(' , '))
                    $('#jam_praktek').select2('val', data.jam_praktek.split(' , '))
                    $('#modal-preview').attr('alt', 'No image available');
                    // $('#photo_dokter').val(data.photo_dokter)
                    if(data.photo_dokter){
                    $('#modal-preview').attr('src', SITEURL +'/public/photo_dokter/'+data.photo_dokter);
                    $('#hidden_image').attr('src', SITEURL +'/public/photo_dokter/'+data.photo_dokter);
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
                    url: "dokter/" + id, //eksekusi ajax ke url ini
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
                        $('#datatabledokter').DataTable().ajax.reload()
                    }
                    
                    })
                }
            })
            
        });

</script>

@endpush

@endsection