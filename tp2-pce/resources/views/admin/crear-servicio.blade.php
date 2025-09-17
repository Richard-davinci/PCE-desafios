<x-layout-admin>
    <x-slot:title>Contacto</x-slot:title>
    <main class="mt-5">
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container mb-4">
                <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Crear servicio</h1>
                <p class="text-secondary mb-0">Completá los datos del servicio y agregá uno o más planes.</p>
            </div>
        </section>

        <!-- DATOS DEL SERVICIO -->
        <section class="container mt-5 " aria-labelledby="datosTitle">
            <div class="card bg-azul text-light border-light shadow-sm">
                <div class="card-body">
                    <h2 id="datosTitle" class="fs-4 font-bankgothic text-turquesa mb-3">Datos</h2>

                    <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="srvNombre">Nombre</label>
                                <input id="srvNombre" name="srvNombre" class="form-control"
                                       placeholder="p.ej. Hosting + Mantenimiento" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="srvCategoria">Categoría</label>
                                <select id="srvCategoria" name="srvCategoria" class="form-select" required>
                                    <option value="">Elegí...</option>
                                    <option>Infraestructura</option>
                                    <option>Web</option>
                                    <option>Marketing</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="srvEstado">Estado</label>
                                <select id="srvEstado" name="srvEstado" class="form-select" required>
                                    <option value="">Elegí...</option>
                                    <option>Activo</option>
                                    <option>Pausado</option>
                                    <option>Discontinuado</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="srvSubtitulo">Subtítulo</label>
                                <input id="srvSubtitulo" name="srvSubtitulo" class="form-control"
                                       placeholder="Bajada corta del servicio">
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="srvDescripcion">Descripción</label>
                                <textarea id="srvDescripcion" name="srvDescripcion" class="form-control" rows="3"
                                          required></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="srvCondiciones">Condiciones (una por línea)</label>
                                <textarea id="srvCondiciones" name="srvCondiciones" class="form-control" rows="3"
                                          placeholder="Facturación mensual por adelantado&#10;Backups diarios (30 días)&#10;Cancelación al cierre de ciclo"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="srvCover">Imagen cover (16:9)</label>
                                <input id="srvCover" name="srvCover" type="file" class="form-control" accept="image/*">
                                <div class="form-text text-secondary">Sugerido 1280×720px (o mayor) en JPG/PNG.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="srvThumb">Imagen thumb (16:9)</label>
                                <input id="srvThumb" name="srvThumb" type="file" class="form-control" accept="image/*"
                                       required>
                                <div class="form-text text-secondary">Sugerido 800×450px. Campo requerido.</div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </section>

        <!-- AGREGAR PLAN -->
        <section class="mt-4 bg-azul py-5" aria-labelledby="planesTitle">
            <div class="container">
                <div class="card bg-azul text-light border-light shadow-sm">
                    <div class="card-body">
                        <h2 id="planesTitle" class="fs-4 font-bankgothic text-turquesa mb-3">Agregar plan</h2>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="planNombre">Nombre del plan</label>
                                <input type="text" class="form-control" id="planNombre" placeholder="Clásico">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="planPrecio">Precio</label>
                                <input type="number" class="form-control" id="planPrecio" placeholder="8999" min="0"
                                       step="any"
                                       inputmode="decimal">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="planPeriodo">Periodo</label>
                                <select class="form-select" id="planPeriodo">
                                    <option>Mensual</option>
                                    <option>Anual</option>
                                    <option>Único</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="planFeatures">Características</label>
                                <textarea class="form-control" id="planFeatures" rows="3"
                                          placeholder="1 sitio web&#10;10 GB SSD&#10;SSL gratis"></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-turquesa font-bankgothic" id="btnAgregarPlan">
                                    <i class="bi bi-plus-lg me-1"></i>Agregar plan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 card bg-azul text-light border-light shadow-sm">
                    <div class="card-body">
                        <h2 id="listaPlanesTitle" class="fs-4 font-bankgothic text-turquesa mb-3">Planes del servicio</h2>

                        <div class="table-responsive">
                            <table class="table table-dark table-striped align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Periodo</th>
                                    <th>Características</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="tablaPlanes">
                                <tr>
                                    <td>Clásico</td>
                                    <td>AR$ 8.999</td>
                                    <td>Mensual</td>
                                    <td>1 sitio, 10 GB SSD, SSL gratis</td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-turquesa"><i class="bi bi-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>



       <section class="container my-5">
           <div class="mt-4 d-flex justify-content-end gap-2">
               <a href="admin.html" class="btn btn-dark font-bankgothic">Cancelar</a>
               <button class="btn btn-turquesa font-bankgothic" type="submit">Guardar</button>
           </div>
       </section>


    </main>
</x-layout-admin>
