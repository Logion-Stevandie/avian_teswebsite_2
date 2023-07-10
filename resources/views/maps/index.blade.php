@extends('layouts.home_master')

@section('title')
Admin Maps | Maps
@endsection

@section('judul')
Maps
@endsection

@section('rowHeader')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Upload Excel Maps</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('maps.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Upload Excel Maps</label>
                    <input type="file" class="form-control" name="file_maps" placeholder="File Maps" value="{{old('file_maps','')}}" required accept=".xlsx, .xls, .csv">
                    @error('file_maps')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('pathJudul')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Maps</li>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


@endsection

@section('javascript_bottom')


@endsection