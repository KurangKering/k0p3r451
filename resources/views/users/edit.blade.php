@extends('layouts.template')
@section('title', 'Ubah Data Pengguna')
@section('custom_css')

@endsection

@section('header-title', 'Ubah Data Pengguna')
@section('heading-elements')
@endsection

@section('content')
<div class="ibox float-e-margins">


 <div class="panel registration-form">
  <div class="panel-body">

  @if (count($errors) > 0)
  
  <div class="alert alert-danger">


    <ul>

     @foreach ($errors->all() as $error)

     <li>{{ $error }}</li>

     @endforeach

   </ul>

 </div>

 @endif

    <div id="error-message">

    </div>
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'files' => true]) !!}

    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">

          <strong>Username:</strong>
          {!! Form::text('username', null, array('class' => 'form-control')) !!}        

        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">

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

      <div class="col-xs-12 col-sm-12 col-md-6">

        <div class="form-group">

          <strong>Password:</strong>

          {!! Form::password('password', array('class' => 'form-control')) !!}

        </div>

      </div>

      <div class="col-xs-12 col-sm-12 col-md-6">

        <div class="form-group">

          <strong>Confirm Password:</strong>

          {!! Form::password('confirm-password', array('class' => 'form-control')) !!}

        </div>

      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

          <strong>NIP</strong>

          {!! Form::text('nip',null, array('class' => 'form-control')) !!}

        </div>

      </div>





      <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

          <strong>No Telepon</strong>

          {!! Form::text('no_telepon',null, array('class' => 'form-control')) !!}

        </div>

      </div>

      <div class="col-xs-12 col-sm-12 col-md-6">

        <div class="form-group">

          <strong>Tanggal Lahir</strong>

          {!! Form::date('tanggal_lahir',null, array('class' => 'form-control')) !!}

        </div>

      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">

        <div class="form-group">

          <strong>Jenis Kelamin</strong>

          {!! Form::select('jenis_kelamin', Config::get('enums.jenis_kelamin'),null, array('class' => 'form-control')) !!}

        </div>

      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

          <strong>Alamat</strong>

          {!! Form::textarea('alamat',null, array('class' => 'form-control')) !!}

        </div>

      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

          <strong>Pas Foto</strong>

          {!! Form::file('foto',null, array('class' => 'form-control')) !!}

        </div>

      </div>


      <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-info">Submit</button>

      </div>

    </div>






  </div>
</div>
</div>
@endsection

@section('custom_js')

@endsection
