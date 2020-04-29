@extends('layouts.admin')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Paket Travel</h1>
        </div>

   @if ($errors->any())
   <div class="alert alert-danger">
        <ul>
            @foreach ($error->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
   </div>       
   @endif

   <div class="card shadow">
       <div class="card-body">
            <form method="post" action="{{route('travel-package.store')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                     <input type="text" class="form-control" name="title" placeholder="Title" Value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                     <input type="text" class="form-control" name="location" placeholder="Location" Value="{{old('location')}}">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="" rows="10" class="d-block w-100 form-control">{{old('about')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="featured_event">Featured Event</label>
                     <input type="text" class="form-control" name="featured_event" placeholder="Featured Event" Value="{{old('featured_event')}}">
                </div>
                <div class="form-group">
                    <label for="language">Language</label>
                     <input type="text" class="form-control" name="language" placeholder="Language" Value="{{old('language')}}">
                </div>
                <div class="form-group">
                    <label for="foods">Foods</label>
                     <input type="text" class="form-control" name="foods" placeholder="Foods" Value="{{old('foods')}}">
                </div>
                <div class="form-group">
                    <label for="departure_date">Departure Date</label>
                     <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" Value="{{old('departure_date')}}">
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                     <input type="text" class="form-control" name="duration" placeholder="Duration" Value="{{old('duration')}}">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                     <input type="text" class="form-control" name="type" placeholder="Type" Value="{{old('type')}}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                     <input type="number" class="form-control" name="price" placeholder="Price" Value="{{old('price')}}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </form>
       </div>
   </div>



@endsection