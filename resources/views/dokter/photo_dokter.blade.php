@if($photo_dokter)
<img src="{{ asset('public/photo_dokter/'. $photo_dokter) }}" class="img-thumbnail rounded-circle" height="50"
  width="50" alt="" />
@else
<img src="{{ asset('gambar/user.png')  }}" class="img-thumbnail rounded-circle" alt="" height="50" width="50">
@endif