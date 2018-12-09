@extends('layouts.template')
@section('title', 'Tambah Pengguna')
@section('custom_css')

@endsection

@section('header-title', 'Tambah Pengguna')
@section('heading-elements')

@endsection

@section('content')

<div class="panel panel-default">

  @if (count($errors) > 0)
  
  <div class="alert alert-danger">

    <strong>Ooops!</strong> Ada Kesalahan.<br><br>

    <ul>

     @foreach ($errors->all() as $error)

     <li>{{ $error }}</li>

     @endforeach

   </ul>

 </div>

 @endif
 <div class="panel-body">


  {!! Form::open(['route' => 'users.store']) !!}

  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">

        <strong>Username:</strong>
        {!! Form::text('username', null, array('class' => 'form-control')) !!}        

      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Name:</strong>

        {!! Form::text('name', null, array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Email:</strong>

        {!! Form::text('email', null, array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Password:</strong>

        {!! Form::password('password', array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Confirm Password:</strong>

        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Hak Akses:</strong>

        {!! Form::select('roles', $roles,null, array('class' => 'form-control')) !!}

      </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Status:</strong>

        {!! Form::select('status', Config::get('enums.status_user'),null, array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

      <button type="submit" class="btn btn-info">Submit</button>

    </div>

  </div>
  {!! Form::close() !!}





</div>
</div>


@endsection

@section('custom_js')
<script>
  $('table').DataTable();
  
</script>
@endsection
