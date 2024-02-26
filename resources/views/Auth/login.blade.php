@extends('Template-auth.layout')
@section('title', 'Login')
@section('content')
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
        <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
            <div class="my-auto authentication-pages">
                <div>
                    <h1 style="font-family:'Times New Roman', Times, serif; text-align: center; color: rgb(226, 226, 230)">LOGIN</h1>
                    <img src="{{ asset('') }}images/perpustakaan/login.png" class=" m-0 mb-4" alt="logo">
                </div>
            </div>
        </div>
        <div class="sign-up-body wd-md-50p">
            <!-- message info -->
            @include('Komponen.message')
            <div class="main-signin-header">
                <h2>Selamat Datang</h2>
                <h4>Please sign in to continue</h4>
                <form action="{{ route('auth') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label><input class="form-control" placeholder="Enter your email" type="email"
                        value="{{ Session::get('email') }}" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label> <input class="form-control" placeholder="Enter your password" type="password"
                        value="{{ old('password') }}" name="password" id="password">
                        <label class="ckbox mt-1"><input type="checkbox" id="show-password"><span> Show Password</span></label>
                        <script>
                            const passwordField = document.getElementById('password');
                            const showPasswordCheckbox = document.getElementById('show-password');

                            showPasswordCheckbox.addEventListener('change', function() {
                              if (this.checked) {
                                passwordField.type = 'text';
                            } else {
                                passwordField.type = 'password';
                            }
                        });
                        </script>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>
            </div>
            <div class="main-signin-footer mt-3 mg-t-5">
                <p>Don't have an account? <a href="{{ route('registrasi') }}">Create an Account</a></p>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
