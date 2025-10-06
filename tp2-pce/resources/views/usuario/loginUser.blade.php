<x-layout>
    <main class=" my-5 py-5 bg-gradient-dark text-light">
        <div class="container" style="max-width:500px">
            <div class="mb-4 text-center">
                <h1 class="fs-2 font-bankgothic fw-bold">Accedé a tu cuenta</h1>
                <p class="text-secondary mb-0">Iniciá sesión o registrate para gestionar tu suscripción.</p>
            </div>

            <ul class="nav tabs-underline justify-content-center mb-4" id="authTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active font-bankgothic fs-5" id="login-tab"
                            data-bs-toggle="tab" data-bs-target="#login" type="button"
                            role="tab" aria-controls="login" aria-selected="true">
                        Iniciar Sesión
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link font-bankgothic fs-5" id="registro-tab"
                            data-bs-toggle="tab" data-bs-target="#registro" type="button"
                            role="tab" aria-controls="registro" aria-selected="false">
                        Registrate
                    </button>
                </li>
            </ul>

            <div class="tab-content bg-azul text-light border border-light rounded p-4 shadow-sm">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <form class="row g-3" action="{{route('usuario.myProfile')}}" method="get" id="loginForm">
                        <div class="col-12">
                            <label for="emailLogin" class="form-label">Email</label>
                            <input type="email" id="emailLogin" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="passLogin" class="form-label">Contraseña</label>
                            <input type="password" id="passLogin" class="form-control">
                        </div>
                        <div class="col-12 d-grid d-sm-flex gap-3">
                            <button class="btn btn-turquesa font-bankgothic" type="submit">Ingresar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="registro-tab">
                    <form class="row g-3 " id="registerForm">
                        <div class="col-md-6">
                            <label for="nombreReg" class="form-label">Nombre</label>
                            <input type="text" id="nombreReg" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellidoReg" class="form-label">Apellido</label>
                            <input type="text" id="apellidoReg" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="emailReg" class="form-label">Email</label>
                            <input type="email" id="emailReg" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="passReg" class="form-label">Contraseña</label>
                            <input type="password" id="passReg" class="form-control" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label for="passReg2" class="form-label">Repetir contraseña</label>
                            <input type="password" id="passReg2" class="form-control" required minlength="6">
                        </div>
                        <div class="col-12 d-grid d-sm-flex gap-3">
                            <button class="btn btn-turquesa font-bankgothic" type="submit">Crear cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>

