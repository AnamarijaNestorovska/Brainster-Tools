
<!DOCTYPE html>
<html>

<head>
    <title>Brainster</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ \Auth::user()->api_token }}">
    @endauth

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    {{--  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    {{--  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>  --}}

    <script src="{{ asset('js/main.js') }}" defer></script>
    <script>
        var AuthUser = {!! Auth()->check() ? Auth()->user() : 'false' !!};
        console.log(AuthUser)
    </script>

    <script src="https://kit.fontawesome.com/28330b3406.js" crossorigin="anonymous"></script>


</head>


    <nav class="navbar navbar-expand-lg navbar-light bg-light border border-primary border-right-0 border-left-0 border-bottom-0">
        <a class="navbar-brand" href="/">
            <img src="/img/brainster.png" width="50px" height="50px">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link blue active" href="/programming"><i class='fal fa-code'></i> Programming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/data-science"><i class='fal fa-atom-alt'></i>Data Science</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/devops"><i class='fal fa-infinity'></i>DevOps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/design"><i class='fal fa-paint-brush-alt'></i>Design</a>
                </li>
            </ul>


        </div>
        <div class="navbar navbar-right">
                <button class="btn btn-outline-primary  my-2 my-sm-0 buttonSubmit" type="button" data-toggle="modal" data-target="@if(\Auth::check())#submitTutorlial @endif">Submit a tutorial</button>
                @if(\Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <button class="btn btn-outline-primary ml-1 my-2 my-sm-0 login_register" type="button"  data-toggle="modal" data-target="#registerModal">Sign Up / Sign In</button>
                @endif



<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <div class="modal-header py-1">
        <h5 class="modal-title" id="exampleModalLabel">Welcome to Brainster</h5><br>
        <p>Signup to submit and upvote tutorials, follow topics and more</p>
        <span>CONTINUE WITH</span>

        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6 offset-md-3 googleButton">
                <form action="{{ route('social.login', 'google') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-google"></i> Sign in with Google</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-around pt-3">
            <div class="col-5 facebookButton">
                <form action="{{ route('social.login', 'facebook') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-facebook-f"></i> Facebook</button>
                </form>

            </div>
            <div class="col-5 gitButton">
                <form action="{{ route('social.login', 'github') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-github-square"></i> GitHub</button>
                </form>
            </div>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> --}}

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                          </div>

                        <input id="name" type="text" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                          </div>
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                          </div>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                          </div>
                        <input id="password-confirm" type="password" placeholder="Password Confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-10 offset-md-1">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Create Account') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-primary btn-block">Create Account</button> --}}
        <span>Already have account? <a href="" data-target="#loginModal" data-toggle="modal">Login</a></span>

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
    </div>
    </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <div class="modal-header py-0 loginHeader">
        <h5 class="modal-title" id="exampleModalLabel">Welcome back</h5><br>
        <span>CONTINUE WITH</span>

        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6 offset-md-3 googleButton">
                <form action="{{ route('social.login', 'google') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-google"></i> Sign in with Google</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-around pt-3">
            <div class="col-5 facebookButton">
                <form action="{{ route('social.login', 'facebook') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-facebook-f"></i> Facebook</button>
                </form>
            </div>
            <div class="col-5 gitButton">
                <form action="{{ route('social.login', 'github') }}">
                    <button type="submit" class="btn btn-block rounded"><i class="fab fa-github-square"></i> GitHub</button>
                </form>
            </div>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                          </div>
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-10 offset-md-1 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                          </div>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>



                <div class="form-group row mb-0">
                    <div class="col-md-10 offset-md-1">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Login') }}
                        </button>


                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-primary btn-block">Login</button> --}}


        <span>Do not have account? <a href="" data-target="#registerModal" data-toggle="modal">Sign Up</a></span>

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
    </div>
    </div>
    </div>
</div>

<div class="modal fade" id="submitTutorlial" tabindex="-1" role="dialog" aria-labelledby="submitTutorlial" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <div class="modal-header py-0 loginHeader">
        <h5 class="modal-title" id="exampleModalLabel">Welcome back</h5><br>
        <span>CONTINUE WITH</span>

        </div>
        <div class="modal-body">
            <div class="card-body">
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <div class="input-group">

                    <input type="text" class="form-control" id="inlineFormInputGroupUsername" name="name" placeholder="Name of the tutorial">
                </div>
                <br>
                <div class="input-group">

                    <input type="text" class="form-control" id="inlineFormInputGroupUsername" name="link" placeholder="URL of the tutorial">
                </div>
                <br>
                <label>Category:</label>

                <div class="input-group">

                    <select name="subcategory_id[]" multiple class="form-control selectSubcategories">
                        @php
                        $subcategories =  App\Subcategory::all();
                    @endphp
                        @foreach ($subcategories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                 </select>
                </div>
                <br>

                <label>Version:</label>

                <div class="input-group">

                    <select name="version_id[]" multiple class="form-control selectVersions">
                        @php
                        $versions =  App\Version::all();
                    @endphp
                        @foreach ($versions as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                 </select>
                </div>


                <div class="input-group pt-4">
                    <label class="tags">Tags:</label>
                    <label>
                        @php
                        $types =  App\Type::all();
                        @endphp
                        @foreach ($types as $item)
                        <input type="checkbox" name="type_id" value="{{$item->id}}" >
                        {{$item->type}}
                        @endforeach
                      </label>

                      <label>
                        @php
                        $medium =  App\Medium::all();
                        @endphp
                        @foreach ($medium as $item)
                        <input type="checkbox" name="medium_id" value="{{$item->id}}" >
                        {{$item->medium}}
                        @endforeach
                      </label>
                    <label class="language">Language:</label>

                      <label>
                        @php
                        $languages =  App\Language::all();
                        @endphp
                        @foreach ($languages as $item)
                        <input type="checkbox" name="language_id" value="{{$item->id}}" >
                        {{$item->language}}
                        @endforeach
                      </label>


                </div>

                <div class="input-group pt-3">
                    <label class="submitChek">This course is for:</label>
                    <label>
                        @php
                        $levels =  App\Level::all();
                        @endphp
                        @foreach ($levels as $item)
                        <input type="checkbox" name="level_id" value="{{$item->id}}" >
                        {{$item->level}}
                        @endforeach
                      </label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>

            </form>
        </div>

        <div class="modal-footer">

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
    </div>
    </div>
    </div>
</div>


</nav>
<body>

    @yield('content')


</body>

</html>
