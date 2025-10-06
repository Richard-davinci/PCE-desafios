<x-layout-admin>
    <main class="mt-5 py-5 bg-gradient-dark text-light">
        <div class="container mt-5" style="max-width:500px">
            <div class="mb-4 text-center">
                <h1 class="fs-2 font-bankgothic fw-bold">Accedé a tu cuenta de administrador</h1>
                <p class="text-blanco mb-0">Iniciá sesión para gestionar el sistema.</p>
            </div>

            <div class="tab-content bg-azul text-light border border-light rounded p-4 shadow-sm">
                <div class="tab-pane fade show active" id="login" role="tabpanel">
                    <form class="row g-3 needs-validation" novalidate id="loginForm" action="{{route('admin.dashboard')}}" method="get">
                        <div class="col-12">
                            <label for="emailLogin" class="form-label">Email</label>
                            <input type="email" id="emailLogin" class="form-control" required aria-required="true">
                        </div>
                        <div class="col-12">
                            <label for="passLogin" class="form-label">Contraseña</label>
                            <input type="password" id="passLogin" class="form-control" required aria-required="true" minlength="6">
                        </div>
                        <div class="col-12 d-grid d-sm-flex gap-3">
                            <button class="btn btn-turquesa font-bankgothic" type="submit">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout-admin>
