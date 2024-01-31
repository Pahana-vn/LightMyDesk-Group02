@extends('frontend.layoutFE')
@section('contentFE')

<?php
if(!empty(Auth::user())){
?>
<style type="text/css">
    body {
        margin-top: 20px;
        background-color: #f2f6fc;
        color: #69707a;
    }

    .img-account-profile {
        height: 10rem;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }

    .card .card-header {
        font-weight: 500;
    }

    .card-header:first-child {
        border-radius: 0.35rem 0.35rem 0 0;
    }

    .card-header {
        padding: 1rem 1.35rem;
        margin-bottom: 0;
        background-color: rgba(33, 40, 50, 0.03);
        border-bottom: 1px solid rgba(33, 40, 50, 0.125);
    }

    .form-control,
    .dataTable-input {
        display: block;
        width: 100%;
        padding: 0.875rem 1.125rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #69707a;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .nav-borders .nav-link.active {
        color: #0061f2;
        border-bottom-color: #0061f2;
    }

    .nav-borders .nav-link {
        color: #69707a;
        border-bottom-width: 0.125rem;
        border-bottom-style: solid;
        border-bottom-color: transparent;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0;
        padding-right: 0;
        margin-left: 1rem;
        margin-right: 1rem;
    }
</style>

 <!-- breadcrumb start -->
 <div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{route('fe.home')}}">Home</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Profile</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->
<div class="container-xl px-4 mt-4">

    <nav class="nav nav-borders">
        <a class="nav-link active ms-0"
            href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details"
            target="__blank">Profile</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture Random</div>
                <div class="card-body text-center">

                    <img class="img-account-profile rounded-circle mb-2"
                        src="{{asset('public/file/')}}/people/{{ rand(1,9) }}.jpg" alt>

                    <div class="small font-italic text-muted mb-4"> <h4>{{$auth->fullname}}</h4> </div>

                    {{-- <button class="btn btn-primary" type="file">Upload new image</button> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-8">

            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form action="{{route('fe.profile')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username </label>
                            <input class="form-control" name="username" id="inputUsername" type="text"
                            value=" {{$auth->username}} ">
                            {!!$errors->first("username",' <div class="text-danger">:message
                                Please provide a valid username.
                            </div>') !!}
                        </div>

                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Full name</label>
                                <input class="form-control" name="fullname" id="inputFirstName" type="text"
                                value="{{$auth->fullname}}">
                                {!!$errors->first("fullname",' <div class="text-danger">:message
                                    Please provide a valid fullname.
                                </div>') !!}
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Address</label>
                                <input class="form-control" name="address" id="inputLocation" type="text"
                                 value="{{$auth->address}}">
                                 {!!$errors->first("address",' <div class="text-danger">:message
                                    Please provide a valid address.
                                </div>') !!}
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" name="phone" id="inputPhone" type="tel"
                                value="{{$auth->phone}}">
                                {!!$errors->first("phone",' <div class="text-danger">:message
                                    Please provide a valid phone.
                                </div>') !!}
                            </div>


                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Enter your password"
                                 value="">
                                 {!!$errors->first("password",' <div class="text-danger">:message
                                    Please provide a valid password.
                                </div>') !!}

                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" name="email" id="inputEmailAddress" type="email"
                            value="{{$auth->email}}">
                            {!!$errors->first("email",' <div class="text-danger">:message
                                Please provide a valid email.
                            </div>') !!}
                        </div>

                        {{-- <div class="row gx-3 mb-3">



                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="text" name="birthday"
                                    placeholder="Enter your birthday" value="06/10/1988">
                            </div>
                        </div> --}}

                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <a href="{{route('fe.change_password')}}" class="btn btn-primary" type="submit">Change password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

</script>
<?php
}else {
    ?>
    <script>
        alert("You are not logged in");
    </script>
<?php
    echo "<h1 >You must be logged in to display your profile</h1>";
}
?>
@endsection
