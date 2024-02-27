@extends('users.base')

@section('content')

<div class="row align-items-center h-100">
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="{{ route('register.store') }}">
        @csrf
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
            </svg>
        </a>
        <h1 class="h6 mb-3">Inscription</h1>
        <div class="form-group">
            <label for="email" class="sr-only">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" required>
        </div>
        <!-- Autres champs vont ici -->
        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire</button>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2024</p>
    </form>
</div>

@endsection
