<div>
    <section class="container-fluid p-4">

        <div class="border border-2 border-success rounded p-5 mt-3"
            style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

            <form id="formLogin" wire:submit="createUser">

                <h1 class="h3 mb-3 fw-normal text-success"><b>Ingrese los datos solicitados:</b></h1>

                {{-- MENSAJE DE CARGA --}}
                <div class="alert alert-info mb-3 p-2 w-100" wire:loading>
                    <h5><i class="spinner-border" role="status"></i>¡ Creando nuevo usuario !</h5>
                </div>

                @if (session('success'))
                    <x-AlertaMensaje typeAlert="alert-success" mensaje="{{ session('success') }}" />
                @endif
                {{-- INPUT NOMBRE --}}
                <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                    <input type="text" class="form-control text-success" id="floatingInput" wire:model="UserName"
                        placeholder="name@example.com">
                    <label for="floatingInput">Nombre de usuario</label>
                </div>
                @if ($errors->has('UserName'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('UserName') }}" />
                @endif

                {{-- INPUT CORREO --}}
                <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                    <input type="email" class="form-control text-success" id="floatingInput" wire:model="UserEmail"
                        placeholder="name@example.com">
                    <label for="floatingInput">Correo Electrónico</label>
                </div>
                @if ($errors->has('UserEmail'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('UserEmail') }}" />
                @endif

                {{-- INPUT CONTRASEÑA --}}
                <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                    <input type="text" class="form-control text-success" id="floatingPassword" wire:model="UserPassword"
                            placeholder="Password" value="{{$UserPassword}}" disabled> 
                    <label for="floatingPassword">Contraseña predeterminada</label>
                </div>
                @if ($errors->has('UserPassword'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('UserPassword') }}" />
                @endif

                {{-- INPUTS CHECKBOK --}}
                <div class="checkBox mb-2 py-2">
                    <div class="row d-flex justify-content-start radio">
                        @foreach ($AllRols as $item)
                            <div class="col-lg-2">
                                <input type="radio" id="{{ $item->rol_name }}" name="rol"
                                    value="{{ $item->id_rol }}" wire:model="UserRol">
                                <label for="{{ $item->rol_name }}"><b>{{ $item->rol_name }}</b></label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($errors->has('UserRol'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('UserRol') }}" />
                @endif

                <button class="btn btn-success w-100 py-2" type="submit">Crear nuevo usuario</button>

            </form>
        </div>

    </section>
</div>
