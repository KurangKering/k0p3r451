@extends('layouts.template')
@section('title', 'Daftar Pengguna')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Pengguna')
@section('heading-elements')
@endsection

@section('content')

<div class="panel panel-default">

  <div class="panel-body">
    <div class="table-responsive">
      <table id="tbl-user"  class="table table-striped">
        <thead>
         <tr>
           <th>Nama</th>
           <th>Username</th>
           <th>Email</th>
           <th>Hak Akses</th>
           <th>Foto</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($data as $key => $user)
         <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            {{ $v }}
            @endforeach
            @endif
          </td>
          <td>
            <a href="{{ Storage::url($user->foto) }}">
              <img src="{{ Storage::url($user->foto_small) ?? '' }}" alt="">
            </a>
          </td>
          <td style="white-space: nowrap; width: 1%">
            {{-- @if (Auth::check()) --}}
            <a class="btn btn-xs btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            {{-- @if (! (Auth::user()->id == $user->id)) --}}
            @if (!$user->hasRole(['admin', 'ketua']))
            {!! Form::open(['method' => 'DELETE','route' => ['users.update', $user->id],'style'=>'display:inline', 'class' => 'form-delete']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-warning']) !!}
            {!! Form::close() !!}
            @endif
            {{-- @endif --}}
            {{-- @endif --}}

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>


@endsection

@section('custom_js')
<script>
  $('table').DataTable({
    order : []
  });
  $('input[type=submit]').click(function(event) {
    let $formDelete = $(this).closest('form');
    event.preventDefault();
    swal({
      icon : 'warning',
      text : 'Yakin Ingin Menghapus Pengguna ?',
      buttons : {
        tidak : {
          className : 'btn btn-xs btn-default',
        },
        yakin : {
          className : 'btn btn-xs btn-warning',

        }
      }
    })
    .then(clicked => {
      if (clicked == 'yakin') {
        let formData = $formDelete.serialize();
        let url = $formDelete.attr('action');
        axios.post(url, 
          formData)
        .then(resp => {
          res = resp.data;
          location.href= "{{ request()->url() }}";
        })
        .catch(err => {
          if (err) {
          location.href= "{{ request()->url() }}";
            
          }
        })

      }
    })
  });
</script>
@endsection
