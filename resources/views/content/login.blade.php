<div class="login-box">
    <div class="login-logo"> <a href="<?=URL::to('/')?>"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session("success"))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="<?=route('login.auth')?>" method="post">
                @csrf
                <div class="input-group mb-3"> <input name="email" type="email" class="form-control" placeholder="Email">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                <div class="input-group mb-3"> <input name="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                <!--begin::Row-->
                <div class="row">
                    <div class="col-8">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label> </div>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                    </div> <!-- /.col -->
                </div>
                <!--end::Row-->
            </form>
            <div class="social-auth-links text-center mb-3 d-grid gap-2">
                <p>- OR -</p> <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in using
                    Facebook
                </a> <a href="#" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using Google+
                </a>
            </div> <!-- /.social-auth-links -->
            <p class="mb-1"> <a href="forgot-password.html">I forgot my password</a> </p>
            <p class="mb-0"> <a href="{{ route('register') }}" class="text-center">
                    Register a new membership
                </a> </p>
        </div> <!-- /.login-card-body -->
    </div>
</div>