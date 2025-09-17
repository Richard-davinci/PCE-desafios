<x-layout-admin>
    <x-slot:title>Contacto</x-slot:title>
    <main class="mt-5">
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container mb-4">
                <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Crear Usuario</h1>
                <p class="text-secondary mb-0">Completá los datos del usuario.</p>
            </div>
        </section>

        <!-- DATOS DEL SERVICIO -->
        <section class="container mt-5 " aria-labelledby="datosTitle">
            <div class="card bg-azul text-light border-light shadow-sm">
                <div class="card-body">
                    <h2 id="datosTitle" class="fs-4 font-bankgothic text-turquesa mb-3">Datos</h2>
                        <form>
                            <div class="card-body bg-azul">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="uNombre">Nombre</label>
                                        <input id="uNombre" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="uApellido">Apellido</label>
                                        <input id="uApellido" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="uEmail">Email</label>
                                        <input id="uEmail" type="email" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="uTelefono">Teléfono</label>
                                        <input id="uTelefono" class="form-control" placeholder="+54 9 11 ...">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="uCiudad">Ciudad</label>
                                        <input id="uCiudad" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end gap-2">
                                <a href="#" class="btn btn-dark font-bankgothic">Cancelar</a>
                                <button class="btn btn-turquesa font-bankgothic" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </main>
</x-layout-admin>
