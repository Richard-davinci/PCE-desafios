@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container">
                <h1 class="font-bankgothic">Panel de administración</h1>
                <p class="text-blanco"> ABM de servicios y usuarios </p>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                    <ul class="nav tabs-segment" id="adminTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="enlace active font-bankgothic fs-5 rounded-top-3 px-3"
                                    id="tab-servicios" data-bs-toggle="tab" data-bs-target="#pane-servicios"
                                    type="button" role="tab" aria-controls="pane-servicios" aria-selected="true">
                                Servicios
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class=" enlace font-bankgothic fs-5 rounded-top-3 px-3"
                                    id="tab-usuarios" data-bs-toggle="tab" data-bs-target="#pane-usuarios"
                                    type="button" role="tab" aria-controls="pane-usuarios" aria-selected="false">
                                Usuarios
                            </button>
                        </li>
                    </ul>


                <div class="tab-content bg-azul rounded-2 text-light p-4 shadow-sm" id="adminTabsContent">
                    <!-- PANEL: SERVICIOS -->
                    <div class="tab-pane fade show active" id="pane-servicios" role="tabpanel"
                         aria-labelledby="tab-servicios">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                            <h2 class="fs-3 font-bankgothic mb-0">Listado de servicios</h2>
                            <div class="d-flex gap-2">
                                <button class="btn btn-turquesa" data-bs-toggle="modal"
                                        data-bs-target="#modalCategorias">
                                    <i class="bi bi-tags me-1"></i> Categorías
                                </button>
                                <a class="btn btn-turquesa" href="{{route('services.create')}}">
                                    <i class="bi bi-plus-lg me-1"></i> Crear servicio
                                </a>
                            </div>
                        </div>

                        <div class="card border-light border-2 shadow-sm rounded-2">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle mb-0 rounded-lg">
                                    <thead class="table-dark rounded-top-3">
                                    <tr>
                                        <th>Id</th>
                                        <th>Servicio</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Desde</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablaServicios">
                                    <tr>
                                        <td>15</td>
                                        <td>Hosting + Mantenimiento</td>
                                        <td>Infraestructura</td>
                                        <td><span class="badge text-bg-success">Activo</span></td>
                                        <td>AR$ 8.999 /mes</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="../views/verServicios.html"
                                                   class="btn btn-dark rounded-2 mx-2"><i
                                                        class="bi bi-eye"></i> Ver</a>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalServicio">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarServicio"><i
                                                        class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>23</td>
                                        <td>Desarrollo Web</td>
                                        <td>Web</td>
                                        <td><span class="badge text-bg-warning">Pausado</span></td>
                                        <td>AR$ 150.000 /único</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="../views/verServicios.html"
                                                   class="btn btn-dark rounded-2 mx-2"><i
                                                        class="bi bi-eye"></i> Ver</a>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalServicio">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarServicio"><i
                                                        class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>31</td>
                                        <td>Marketing Digital</td>
                                        <td>Marketing</td>
                                        <td><span class="badge text-bg-success">Activo</span></td>
                                        <td>AR$ 45.000 /mes</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="../views/verServicios.html"
                                                   class="btn btn-dark rounded-2 mx-2"><i
                                                        class="bi bi-eye"></i> Ver</a>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalServicio">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarServicio"><i
                                                        class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>42</td>
                                        <td>Diseño UX/UI</td>
                                        <td>Web</td>
                                        <td><span class="badge text-bg-danger">Discontinuado</span></td>
                                        <td>AR$ 95.000 /único</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="../views/verServicios.html"
                                                   class="btn btn-dark rounded-2 mx-2"><i
                                                        class="bi bi-eye"></i> Ver</a>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalServicio">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarServicio"><i
                                                        class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>55</td>
                                        <td>Servidor VPS</td>
                                        <td>Infraestructura</td>
                                        <td><span class="badge text-bg-success">Activo</span></td>
                                        <td>AR$ 12.500 /mes</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="../views/verServicios.html"
                                                   class="btn btn-dark rounded-2 mx-2"><i
                                                        class="bi bi-eye"></i> Ver</a>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalServicio">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarServicio"><i
                                                        class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- PANe: USUARIOS -->
                    <div class="tab-pane fade show" id="pane-usuarios" role="tabpanel" aria-labelledby="tab-usuarios">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                            <h2 class="fs-3 font-bankgothic mb-0">Listado de usuarios</h2>
                            <a class="btn btn-turquesa" href="{{route('admin.createUser')}}">
                                <i class="bi bi-plus-lg me-1"></i> Crear usuario
                            </a>
                        </div>

                        <div class="card border-light border-2 shadow-sm rounded-2">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle mb-0 rounded-lg">
                                    <thead class="table-dark rounded-top-3">
                                    <tr>
                                        <th>Id</th>
                                        <th>Avatar</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Ciudad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="../img/ricardo.webp" class="avatar-sm border border-secondary"
                                                 alt="avatar"
                                                 height="40" width="40">
                                        </td>
                                        <td>Ricardo</td>
                                        <td>García</td>
                                        <td>ricardo.garcia@davinci.edu.ar</td>
                                        <td>+54 221 690-5085</td>
                                        <td>La Plata</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-dark rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioView">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioCU">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioDel">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="../img/ricardo.webp" class="avatar-sm border border-secondary"
                                                 alt="avatar"
                                                 height="40" width="40">
                                        </td>
                                        <td>María</td>
                                        <td>López</td>
                                        <td>maria.lopez@davinci.edu.ar</td>
                                        <td>+54 11 2345-6789</td>
                                        <td>Buenos Aires</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-dark rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioView">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioCU">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioDel">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><img src="../img/ricardo.webp" class="avatar-sm border border-secondary"
                                                 alt="avatar"
                                                 height="40" width="40">
                                        </td>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>juan.perez@davinci.edu.ar</td>
                                        <td>+54 351 987-6543</td>
                                        <td>Córdoba</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-dark rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioView">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioCU">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioDel">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><img src="../img/ricardo.webp" class="avatar-sm border border-secondary"
                                                 alt="avatar"
                                                 height="40" width="40">
                                        </td>
                                        <td>Ana</td>
                                        <td>Martínez</td>
                                        <td>ana.martinez@davinci.edu.ar</td>
                                        <td>+54 341 234-5678</td>
                                        <td>Rosario</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-dark rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioView">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioCU">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioDel">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><img src="../img/ricardo.webp" class="avatar-sm border border-secondary"
                                                 alt="avatar"
                                                 height="40" width="40">
                                        </td>
                                        <td>Carlos</td>
                                        <td>González</td>
                                        <td>carlos.gonzalez@davinci.edu.ar</td>
                                        <td>+54 261 876-5432</td>
                                        <td>Mendoza</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-dark rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioView">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                                <button class="btn btn-turquesa rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioCU">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button class="btn btn-danger rounded-2 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalUsuarioDel">
                                                    <i class="bi bi-trash"></i> Eliminar
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
            </div>
        </section>

    <!-- Modal: Eliminar Servicio -->
    <div class="modal fade" id="modalEliminarServicio" tabindex="-1" aria-labelledby="modalEliminarServicioTitle"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarServicioTitle"><i class="bi bi-trash"></i> Eliminar
                        Servicio</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body bg-azul">
                    <p>¿Estás seguro que deseas eliminar este servicio? No se podrá recuperar.</p>
                </div>
                <div class="modal-footer bg-azul">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: Categorías -->
    <div class="modal fade" id="modalCategorias" tabindex="-1" aria-labelledby="modalCategoriasTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-light">
                <div class="modal-header  bg-azul">
                    <h2 class="modal-title fs-3 font-bankgothic" id="modalCategoriasTitle">
                        <i class="bi bi-tags me-1"></i>Categorías
                    </h2>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-sm rounded-2 bg-azul  mt-3">
                        <div class="card-body">
                            <label class="form-label" for="newCat">Agregar categoría</label>
                            <div class="input-group">
                                <input id="newCat" class="form-control" placeholder="p.ej. Marketing">
                                <button class="btn btn-turquesa font-bankgothic" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body ">
                            <ul class="list-group list-group-flush" id="listaCategorias">
                                <li class="list-group-item bg-azul text-light border-light d-flex justify-content-between align-items-center">
                        <span>
                            <span class="nombre-categoria">Infraestructura</span>
                            <span class="badge text-bg-secondary ms-2">3</span>
                        </span>
                                    <span>
                            <button class="btn btn-sm btn-warning me-1" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </span>
                                </li>
                                <li class="list-group-item bg-azul text-light border-light d-flex justify-content-between align-items-center">
                        <span>
                            <span class="nombre-categoria">Web</span>
                            <span class="badge text-bg-secondary ms-2">5</span>
                        </span>
                                    <span>
                            <button class="btn btn-sm btn-warning me-1" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </span>
                                </li>
                                <!-- Plantilla para nuevas categorías aquí -->
                            </ul>
                        </div>
                    </div>


                </div>
                <div class="modal-footer bg-azul px-3">
                    <button class="btn btn-turquesa font-bankgothic" data-bs-dismiss="modal" type="button">Cancelar
                    </button>
                    <button class="btn btn-outline-turquesa font-bankgothic" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver user -->
    <div class="modal fade" id="modalUsuarioView" tabindex="-1" aria-hidden="true"
         aria-labelledby="modalUsuarioViewTitle">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-light">
                <div class="modal-header bg-azul">
                    <h2 class="modal-title fs-3 font-bankgothic" id="modalUsuarioViewTitle">
                        <i class="bi bi-person-lines-fill me-1"></i>Usuario
                    </h2>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body  py-5">


                    <div class="tab-content">
                        <!-- TAB: Datos (solo lectura) -->
                        <div class="tab-pane fade show active" id="u-datos" role="tabpanel" aria-labelledby="u-datos-tab">
                            <div class="card bg-azul text-light border-light">
                                <div class="card-body">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-3 text-center">
                                            <img src="../assets/img/ricardo.webp" class="img-fluid rounded-3 border border-secondary"
                                                 alt="avatar">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <small class="text-turquesa d-block">Nombre</small>
                                                    <div>Ricardo Rodolfo</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <small class="text-turquesa d-block">Apellido</small>
                                                    <div>Garcia</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <small class="text-turquesa d-block">Email</small>
                                                    <div>ricardo.garcia@davinci.edu.ar</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <small class="text-turquesa d-block">Teléfono</small>
                                                    <div>+54 221 690-5085</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <small class="text-turquesa d-block">Ciudad</small>
                                                    <div>La Plata</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-azul px-0">
                    <button class="btn btn-dark font-bankgothic" data-bs-dismiss="modal" type="button">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Eliminar user -->
    <div class="modal fade" id="modalUsuarioDel" tabindex="-1" aria-hidden="true"
         aria-labelledby="modalUsuarioDelTitle">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header">
                    <h2 class="modal-title fs-3 font-bankgothic" id="modalUsuarioDelTitle">
                        <i class="bi bi-exclamation-triangle me-1"></i>Eliminar usuario
                    </h2>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body bg-azul py-4">
                    ¿Seguro que querés eliminar este usuario? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer px-0">
                    <button class="btn btn-dark font-bankgothic" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button class="btn btn-danger font-bankgothic" type="button">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
