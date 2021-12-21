@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
            <form action="/register" method="POST" id="form-register" class="form-register" novalidate>
                @csrf
              <div class="form-floating">
                <input type="name" name="name" class="form-control" id="name" placeholder="Name">
                <label for="name">Name</label>
                <i class="bi bi-check-circle-fill"></i>
                <i class="bi bi-exclamation-circle-fill"></i>
                <small>Error message</small>
              </div>
              <div class="form-floating">
                <input type="username" name="username" class="form-control" id="username" placeholder="Username">
                <label for="username">Username</label>
                <i class="bi bi-check-circle-fill"></i>
                <i class="bi bi-exclamation-circle-fill"></i>
                <small>Error message</small>
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
                <i class="bi bi-check-circle-fill"></i>
                <i class="bi bi-exclamation-circle-fill"></i>
                <small>Error message</small>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
                <i class="bi bi-check-circle-fill"></i>
                <i class="bi bi-exclamation-circle-fill"></i>
                <small>Error message</small>
              </div>
              <div class="form-floating">
                <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirmation Password">
                <label for="confirm-password">Confirmation Password</label>
                <i class="bi bi-check-circle-fill"></i>
                <i class="bi bi-exclamation-circle-fill"></i>
                <small>Error message</small>
              </div>
          
              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already registered? <a href="/login">Login</a></small>
            <p class="mt-5 mb-3 text-muted text-center">&copy; {{ now()->year }}</p>
        </main>
    </div>
</div>

@section('script')
  <script src="{{ asset('js/script.js') }}"></script>
@endsection

@endsection