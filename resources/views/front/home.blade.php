@extends('layout.front')

@section('content')

    <div class="Register-header">
        <h1>INSCRIPCIÓN PARA POSTULACIONES AL PREMIO</h1>
    </div>

    @if(session('Success'))
        <section class="Message">
            <div class="notification success">
                <span class="title">!&nbsp;&nbsp;&nbsp;&nbsp;Exitoso!</span> {{session('Success')}}<span class="close">X</span>
            </div>
        </section>
    @endif

    @if(session('Error'))
    <section class="Message">
        <div class="notification error">
            <span class="title">!&nbsp;&nbsp;&nbsp;&nbsp;Error</span> {{session('Error')}}<span class="close">X</span>
        </div>
    </section>
    @endif

    <div class="row around">
        <form method="POST" action="{{route('login')}}" class=" col-5 small-12 Form-home Register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2>FORMULARIO DE INICIO DE SESIÓN</h2>
            <label style=" margin-top: 2rem "  class="col-10 small-10" for="group_name">
                <span>Correo electrónico</span>
                <input type="email" name="email" id="email">
            </label>
            <label class="col-10 small-10" for="password">
                <span>Contraseña</span>
                <input type="password" name="password" id="password">
            </label>
            <div class="center row">
                <button> INGRESAR</button>
            </div>
            <a style="color:#df2826; display: block; text-align: center; padding-bottom: 30px" href="{{route('getEmail')}}">¿Olvido su contraseña?</a>
        </form>
        <form method="POST" action="{{route('register')}}" class="col-5 small-12  Form-home Register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2>FORMULARIO DE REGISTRO</h2>
            <label style=" margin-top: 2rem "  class="col-10 small-10" for="group_name">
                <span>Correo electrónico</span>
                <input type="email" name="email" id="email" value="{{old('email')}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('email')}}</span>
                @endif
            </label>
            <label class="col-10 small-10" for="password">
                <span>Contraseña</span>
                <input type="password" name="password" id="password">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('password')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="password">
                <span>Repetir contraseña</span>
                <input type="password" name="password_confirmation" id="password">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('password_confirmation')}}</span>
                @endif
            </label>
            <div class="center row"><button> REGISTRARSE</button></div>
        </form>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/images.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('js/form.js')}}"></script>
    <script type="text/javascript">
        $('#sector').select2({
            closeOnSelect: false
        });

    </script>
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection