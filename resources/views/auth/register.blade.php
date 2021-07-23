@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
 
        <div class="col-md-7 mr-auto">
            <div class="card card-register card-dark">
                <div class="card-header">
                    <img class="card-img" src="{{ asset('black') }}/img/card-primary.png" alt="Card image">
                    <h4 class="card-title">{{ __('Register') }}</h4>
                </div>
                <form class="form" method="post" action="{{ route('register') }}">
                    @csrf

                    <div class="card-body">
                        <div class="row justify-content-center">
                           <div class="col-md-6 form-group">
                                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="fas fa-star"></i>
                                        </div>
                                    </div>                                   
                                    <select  name="TipoUsuario" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}" placeholder="{{ __('TipoUsuario') }}">
                                        <option class="bg-dark">Elige un Tipo</option>
                                        @foreach($TiposUsuario as $TipoUsuarios)
                                        <option class="bg-dark" value="{{$TipoUsuarios->IdTipoUsuario}}">{{$TipoUsuarios->Descripcion}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'TipoUsuario'])
                                </div>
                           </div>     
                           <div class="col-md-6 form-group">
                                <div class="input-group{{ $errors->has('Sucursal') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="fas fa-hdd"></i>
                                        </div>
                                    </div>
                                    <select  name="Sucursal" class="form-control{{ $errors->has('Sucursal') ? ' is-invalid' : '' }}" placeholder="{{ __('Sucursal') }}">
                                        <option class="bg-dark">Elige un Tipo</option>
                                        @foreach($Sucursales as $Sucursal)
                                        <option class="bg-dark" value="{{$Sucursal->IdSucursal}}">{{$Sucursal->Nombre}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'Sucursal'])
                                </div>
                           </div>                           
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 form-group">
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                 </div>
                            </div>
                            <div class="col-md-6 form-group">
                            <div class="input-group{{ $errors->has('Apellido') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="Apellidos" class="form-control{{ $errors->has('Apellido') ? ' is-invalid' : '' }}" placeholder="{{ __('Apellido') }}">
                                    @include('alerts.feedback', ['field' => 'Apellido'])
                                 </div>
                            </div>
                        </div>
                      
                       <div class="row justify-content-center">
                           <div class="col-md-6 form-group">
                                <div class="input-group{{ $errors->has('Telefono') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="fas fa-mobile"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="Telefono" class="form-control{{ $errors->has('Telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}">
                                    @include('alerts.feedback', ['field' => 'Telefono'])
                                </div>   
                           </div> 
                           <div class="col-md-6 form-group">
                                <div class="input-group{{ $errors->has('DPI') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="far fa-id-card"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="DPI" class="form-control{{ $errors->has('DPI') ? ' is-invalid' : '' }}" placeholder="{{ __('DPI') }}">
                                    @include('alerts.feedback', ['field' => 'DPI'])
                                </div>   
                           </div>                   
                       </div>
                       <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"></i>
                                </div>
                            </div>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"></i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                        </div>
                        <div class="form-check text-left">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">
                                <span class="form-check-sign"></span>
                                {{ __('I agree to the') }}
                                <a href="#">{{ __('terms and conditions') }}</a>.
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Get Started') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
