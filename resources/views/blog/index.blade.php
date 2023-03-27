@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<header>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-dark">
            <h1 class="display-4 fw-bolder font-bold">The Articals</h1>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            @if (Auth::check())
            <form action="{{URL('blogCreate')}}">
                <button type="submit" class="btn btn-success">Add Artical</button>
            </form>
            @endif
@foreach ($post as $post)


            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" width="600px" height="500px" src="/images/{{$post->imge_path}}" alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{$post->title}}</h1>
                <div class="fs-5 mb-5">
                    <span class="">at {{$post->created_at}}</span>
                    <br>
                    <span class="">by : {{$post->user->name}}</span>
                </div>



                <p class="lead">{{$post->discription}}</p>
                <div class="d-flex">
                    {{-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" /> --}}
                   <form action="{{route('blogShow' , $post->slug)}}">
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Show
                    </button>
                </form>
                {{-- ///////////////////////////////////////////// --}}
@if (Auth::check())
@if (Auth::id() == $post->user->id)
                <form action="{{route('blogEdit' , $post->id)}}" >
                    <button class="btn btn-outline-primary flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Edite
                    </button>
                </form>

                <form action="{{route('blogDelete')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <button class="btn btn-outline-danger flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        delete
                    </button>
                </form>
                @endif
                @endif
                {{-- ////////////////////////////////////////////// --}}
                </div>


            </div>
            <hr>
            <hr>
            @endforeach
        </div>
    </div>
</section>
<!-- Related items section-->

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Articls Website 2022</p></div>
</footer>
@endsection
