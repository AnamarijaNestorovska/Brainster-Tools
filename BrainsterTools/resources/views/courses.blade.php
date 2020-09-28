@extends('layouts.header')

@section('content')

<div class="container coursesDiv my-4 pb-2">
    <div class="row">
        <div class="col-md-auto">
            <img src="{{ $subcategory->logo }}" width="50px" height="50px">
        </div>
        <div class="col-md-auto">
            <h3>{{ $subcategory->name }} Tutorials and Courses</h3>
            <p>Learn {{ $subcategory->name }} online from the best {{ $subcategory->name }} tutorials and courses recommended by programming community.</p>

        </div>
    </div>
</div>

<div class="container">
<div class="row">
    <div class="col-md-3 ml-4 border border-primary rounded coursesFilter">
        <div class="container border-bottom border-primary my-4">
            <h6>Filter Courses</h6>

        </div>
        <div class="container">
            <h6>Type of course</h6>
            @foreach($finalType as $c)
                <input class="mr-2 courseFilters" type="checkbox" name="type_id" value="{{ $c['id'] }}"> <label>{{ $c['type'] }} ({{ $c['number'] }})</label><br>
            @endforeach
        </div>
        <div class="container my-2 mt-1">
            <h6>Medium</h6>
            @foreach($finalMedium as $c)
                <input class="mr-2 courseFilters" type="checkbox" name="medium_id" value="{{ $c['id'] }}"> <label>{{ $c['medium'] }} ({{ $c['number'] }})</label><br>
            @endforeach
        </div>
        <div class="container my-2 mt-1">
            <h6>Level</h6>
            @foreach($finalLevel as $c)
                <input class="mr-2 courseFilters" type="checkbox" name="level_id" value="{{ $c['id'] }}"> <label>{{ $c['level'] }} ({{ $c['number'] }})</label><br>
            @endforeach
        </div>
        <div class="container my-2 mt-1">
            <h6>Subcategory/Version</h6>
            @foreach($finalVersions as $c)
                <input class="mr-2 courseFilters" type="checkbox" name="version_id" value="{{ $c['id'] }}"> <label>{{ $c['name'] }} ({{ $c['number'] }})</label><br>
            @endforeach

        </div>
        <div class="container my-2 mt-1">
            <h6>Language</h6>
            @foreach($finalLanguage as $c)
                <input class="mr-2 courseFilters" type="checkbox" name="language_id" value="{{ $c['id'] }}"> <label>{{ $c['language'] }} ({{ $c['number'] }})</label><br>
             @endforeach
        </div>
    </div>


        <div class="col ml-3">
            <div class="container justify-content-between border py-3 smallDiv">
                <div class="row">
                    <div class="col mt-2">
                        <h6>Top {{ $subcategory->name}} tutorials</h6>
                    </div>
                    <div class="col-md-4 pt-2">
                        <span class="mr-3 upvotes" data-sort="votes" data-subid="{{ $subcategory->id }}">
                            <a href=""><i class="fas fa-arrow-down"></i>Upvotes</a>
                        </span> 
                        <span class="recent" data-sort="created_at" data-subid="{{ $subcategory->id }}">
                            <a href=""><i class="fas fa-arrow-down"></i>Recent</a>
                        </span>

                    </div>
                </div>
            </div>
            <div class="container">
                {{-- <div class="row divCour"> --}}
                    {{-- <div class="col-md-2">
                    </div> --}}
                    <div class="row coursesList">
                            
                        @foreach ($coursesList as $list)
                            @php
                                $vote = 'notVoted';
                                $voteClass = '';
                            @endphp
                            @foreach ($list->userVotes as $v)
                                @if(\Auth::check() && $v->pivot['user_id'] == \Auth::user()->id)
                                    @php
                                        $vote = 'voted';
                                        $voteClass = 'testClass';
                                    @endphp
                                @endif
                            @endforeach
                        <div class="borderCourse">
                        <div class="col-md-2 buttonVote">
                            <button class="votes {{ $voteClass }}" data-vote="{{ $vote }}" data-id="{{ $list->id }}"><i class="fas fa-caret-up fa-2x"></i><span class="votes-number">{{ $list->votes }}</span></button>
                        </div>
                        <div class="col-md-10 divTwo pt-5">
                        <h5><a class="linkCourses pt-1" href="{{ $list->link }}">{{ $list->name }}</a></h5>

                          <div class="pt-2">
                            <span class="badge badge-dark ml-2">{{ $list->type['type'] }}</span>
                            <span class="badge badge-dark ml-2">{{ $list->level['level'] }}</span>
                            <span class="badge badge-dark ml-2">{{ $list->medium['medium'] }}</span>
                            <span class="badge badge-dark ml-2">{{ $list->language['language'] }}</span>
                          </div>

                        </div>
                    </div>
                         @endforeach
                    </div>
                {{--  </div>  --}}

            </div>


        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-3 ml-4">

        </div>
        <div class="col ml-3">
            <h6 class="mt-5">You might be interested in:</h6>
            <div class="row d-flex justify-content-between">
                @foreach($related as $r)
                    <div class="col-md-4">
                    <div class="logo w-100 rounded p-3 my-4">
                        <a class="d-flex align-items-center" href="{{ $r['slug'] }}">
                            <img width="30px" height="30px" src="{{ $r['logo'] }}">
                            <h6 class="ml-3">{{ $r['name'] }}</h6>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
