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
                        <h2 class="content-header-title float-left mb-0">Data Jam Praktek Dokter</h2>
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
                    <table class="table zero-configuration text-center" id="datatablejam">
                        <thead>
                            <tr class="">
                                <th></th>
                                <th>Jam Praktek Dokter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- DataTable ends -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-judul">Tambah Data Jam Praktek Baru</h5>
                                <button type="button" id="tutup" class="close" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true" id="tutup">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST" id="formjam" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Jam Praktek Dokter</label>
                                        <input type="text" class="form-control" id="jam_praktek" name="jam_praktek"
                                            required>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                        <div class="add-data-btn px-1">
                                            <button class="btn btn-primary" type="submit" id="simpan">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });

    $('#datatablejam').DataTable({
           
           serverside : true,
           responsive : true,
           ajax : {
               url : "{{route('jampraktek.index')}}"
           },
           columns:[
                   {
                       "data" :null, "sortable": false,
                       render : function (data, type, row, meta) {
                           return meta.row + meta.settings._iDisplayStart + 1
                       }
                   },
                    {data: 'jam_praktek', name: 'jam_praktek'},
                    {data: 'aksi', name: 'aksi'}
               ]
    });

    // Tambah Data
    $('#formjam').submit(function (e) {
            e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                url : "{{route('jampraktek.store')}}",
                type : "post",
                data: formData,
                cache:false,
                contentType: false,
                dataType:'json',
                processData: false,
                success: function(response) {
                    // console.log(response);
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Jam Praktek Dokter Added Successfully!',
                            'success'
                            )}
                    // $('#tutup').click()
                    $('#formjam')[0].reset()
                    $('#formjam').trigger("reset"); //form reset
                    $('#tutup').trigger("reset"); //form reset
                    $('#exampleModal').modal('hide'); //modal hide
                    $('#datatablejam').DataTable().ajax.reload()
                }    
            })
        });

        // Edit
        $(document).on('click', '.edit', function (e) {
        e.preventDefault(); 
        $('#exampleModal').modal('show')
        let id = $(this).attr('id')
        $('#modal-judul').html("Edit Jam Praktek Dokter"); // Judul
        $('#tutup').trigger("reset");

            $.ajax({
                url : 'jampraktek/' + id + '/edit',
                type : 'get',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data)
                    $('#id').val(data.id)
                    $('#jam_praktek').val(data.jam_praktek)
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
                    url: "jampraktek/" + id, //eksekusi ajax ke url ini
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
                        $('#datatablejam').DataTable().ajax.reload()
                    }
                    
                    })
                }
            })
            
        });

</script>

@endpush

@endsection