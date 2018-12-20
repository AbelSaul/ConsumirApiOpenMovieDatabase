@extends('layouts.app')
@section('content')
    <div style="display:flex; justify-content:center;">
        <div class="col-md-6 col-md-offset-6">
            @if(session()->has('denied'))
            <div class="alert alert-danger">
                {{ session()->get('denied') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Acceso a la aplicacion</h1>
                </div>
                <div class="panel-body"> 
                    <form method="POST" action="{{route('login')}}">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' :''}} ">
                            <label for="name">Email</label>
                            <input class="form-control"
                                name="email" 
                                value="{{old('email')}}"
                                placeholder="Ingresa tu email"> 
                            
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('system') ? 'has-error' : ''}}" >
                            <label for="system">System</label>
                            <input class="form-control" type="text" name="system" placeholder="Ingresa tu system"> 
                            {!! $errors->first('system','<span class="help-block">:message</span>') !!}
                        </div>
                        <button class="btn btn-primary btn-block">Login in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection  