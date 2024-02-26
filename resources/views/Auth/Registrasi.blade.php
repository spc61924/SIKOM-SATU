@extends('Template-auth.layout')
@section('title', 'Registrasi')
@section('content')
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
        <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
            <div class="my-auto authentication-pages">
                <div>
                    <img src="{{ asset('') }}images/perpustakaan/transparant.png" class=" m-0 mb-4" alt="logo">
                </div>
            </div>
        </div>
        <div class="sign-up-body wd-md-50p">
            <!-- message info -->
            @include('Komponen.message')
            <div class="main-signin-header">
                <h2>REGISTRASI</h2>
                <h4>Please Registrasi to Sign in</h4>
                <form action="{{ route('store-registrasi') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Username</label> <input class="form-control" placeholder="Enter your username"
                        type="text" name="username" value="{{ old('username') }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label> <input class="form-control" placeholder="Enter your email"
                        type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label>Password</label> <input class="form-control" placeholder="Enter your password"
                        type="password" name="password" id="password" value="{{ old('password') }}">
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
                    <div class="form-group">
                        <label>Nama Lengkap</label> <input class="form-control" placeholder="Enter your fullname"
                        type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label> <textarea class="form-control" placeholder="Enter your from"
                        type="text" name="alamat">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2" name="role">
                            <option value="peminjam">peminjam</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                </form>
            </div>
            <div class="main-signup-footer mg-t-10">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
