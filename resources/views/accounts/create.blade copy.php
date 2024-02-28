@extends('accounts.app')
@section('content')




<div class="row justify-content-center">
    <div class="col-12">
        <h2 class="page-title">Form elements</h2>
        <p class="text-muted">Demo for form control styles, layout options, and custom components for creating a wide variety of forms.</p>
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Form controls</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="account_number">Numéro de compte</label>
                            <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required autofocus>

                            @error('account_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="function">{{ __('Fonction') }}</label>

                            <input id="function" type="text" class="form-control @error('function') is-invalid @enderror" name="function" value="{{ old('function') }}" required>

                            @error('function')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label for="profile_type">{{ __('Type de profil') }}</label>

                                <select id="profile_type" class="form-control @error('profile_type') is-invalid @enderror" name="profile_type" required>
                                    <option value="" selected disabled>Choisissez un type de profil</option>
                                    <option value="admin">Administrateur</option>
                                    <option value="teller">Caissier</option>
                                    <option value="client">Client</option>
                                </select>

                                @error('profile_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name">{{ __('Prénom') }}</label>

                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="branch_number">{{ __('Numéro d\'agence') }}</label>

                            <input id="branch_number" type="text" class="form-control @error('branch_number') is-invalid @enderror" name="branch_number" value="{{ old('branch_number') }}" required>

                            @error('branch_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="account_type">{{ __('Type de compte') }}</label>

                                <select id="account_type" class="form-control @error('account_type') is-invalid @enderror" name="account_type" required>
                                    <option value="" selected disabled>Choisissez un type de compte</option>
                                    <option value="savings">Épargne</option>
                                    <option value="current">Courant</option>
                                </select>

                                @error('account_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="last_name">{{ __('Nom') }}</label>

                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">{{ __('Numéro de téléphone') }}</label>

                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- / .card -->


        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->
</div> <!-- .container-fluid -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Créer un compte') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('accounts.store') }}">
                        @csrf

                        <!-- Account Number -->
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de compte') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Branch Number -->
                        <div class="form-group row">

                        </div>
                </div>

                <div class="form-group row">

                </div>

                <!-- Account Type -->
                <div class="form-group row">

                </div>



                <!-- Profile Type -->
                <div class="form-group row">
                    <label for="profile_type" class="col-md-4 col-form-label text-md-right">{{ __('Type de profil') }}</label>

                    <div class="col-md-6">

                    </div>
                </div>

                <!-- First Name -->
                <div class="form-group row">

                </div>

                <!-- Last Name -->
                <div class="form-group row">

                </div>

                <!-- Phone Number -->
                <div class="form-group row">

                </div>

                <!-- Address -->
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- National ID -->
                <div class="form-group row">
                    <label for="national_id" class="col-md-4 col-form-label text-md-right">{{ __('Carte nationale d\'identité') }}</label>

                    <div class="col-md-6">
                        <input id="national_id" type="text" class="form-control @error('national_id') is-invalid @enderror" name="national_id" value="{{ old('national_id') }}" required>

                        @error('national_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Email Address -->
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse Email') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Créer le compte') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection