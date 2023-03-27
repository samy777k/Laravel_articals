@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<header>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-dark">
            <h1 class="display-4 fw-bolder font-bold">Edit Your Artical</h1>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">

            <div class="col-md-12">
                <form action="{{URL('blogUpdate' , $editeArtical->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                      <h2 for="exampleFormControlInput1">Title</h2>
                      <input value="{{$editeArtical->title}}" type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title">
                    </div>


                    <div class="form-group">
                      <h2>Discription</h2>
                      <textarea name="discription" class="form-control" rows="5">{{$editeArtical->discription}}</textarea>
                    </div>

                    <div class="form-group">
                        <h2>Select Image</h2>
                        <input type="file" name="image" class="form-control">
                      </div>
                      <button type="submit" class="btn btn-primary">Edit Artical</button>
                  </form>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
@endsection
