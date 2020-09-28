@extends('layouts.header')

@section('content')

<div class="container search">
    <div class="row justify-content-md-center">
        <h2>Find the Best Programming Courses & Tutorials</h2>
        <div class="col-md-8">
            <div class="form-group">
            <br>
                <input type="text" class="form-control" id="search" name="search" placeholder="Search for the courses you want to learn:Python, Javascript,...">
            </div>

        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-center listCourse">
                    {{--  @if($category instanceof \Illuminate\Support\Collection)
                        @foreach ($category as $c )
                            @foreach ($c->subcategories as $sub)
                                <div class="col-md-4">
                                    <div class="logo w-100 rounded p-3 my-4">
                                        <a class="d-flex align-items-center" href="">
                                            <img width="50px" height="50px" src="{{$sub->logo}}">
                                            <h6 class="ml-3">{{$sub->name}}</h6>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        @foreach ($category->subcategories as $sub)
                            <div class="col-md-4">
                                <div class="logo w-100 rounded p-3 my-4">
                                    <a class="d-flex align-items-center" href="">
                                        <img width="50px" height="50px" src="{{$sub->logo}}">
                                        <h6 class="ml-3">{{$sub->name}}</h6>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif  --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


