@extends('layouts.app')

@section('title', 'Mi perfil')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 fw-bold font-bankgothic mb-3">Mi perfil</h1>
      <p class="text-blanco">Consultá tus datos y editá solo lo necesario.</p>
    </div>
  </section>

  <div class="container">
    <x-breadcrumb
      :items="[
        ['label' => 'Inicio', 'route' => 'pages.index'],
        ['label' => 'Perfil']
      ]"
      separator="›"
    />
  </div>

  <section class="py-5 container">
    <x-alert type="success" :message="session('success')"/>
    @if(session('errors'))
      @if($errors)
        <x-alert type="danger" message="Por favor, revise los campos y vuelva a intentarlo"/>
      @endif
    @endif
    <div class="mb-4">
      <div class="row g-4">

        <div class="col-lg-4">
          <div class="card bg-azul text-light border-light card-section mb-3">
            <div class="card-body text-center">
              <img src="storage/{{ $user->profile_photo }}"
                   alt="Foto de perfil de {{ $user->name }}"
                   height="150"
                   width="150"
                   class="avatar-lg mx-auto mb-3 border border-secondary"
                   style="object-fit: cover; border-radius: 50%;">

              {{-- Botón cambiar foto--}}
              <div class="mt-2 tab-only-edit" style="display: none;">
                <label class="btn btn-turquesa mb-0">
                  <i class="bi bi-image me-1"></i> Cambiar foto
                  <input type="file"
                         name="profile_photo"
                         accept="image/*"
                         hidden
                         form="profileForm">
                </label>
              </div>
            </div>
          </div>

          {{-- Estado de la cuenta --}}
          <div class="card bg-azul text-light border-light card-section">
            <div class="card-body">
              <h2 class="fs-5 text-turquesa mb-3 font-bankgothic">Estado de la cuenta</h2>
              <ul class="list-unstyled mb-0 small">
                <li class="d-flex align-items-center justify-content-between mb-2">
                  <span>Rol</span>
                  <span class="badge text-bg-info text-uppercase p-2">
                    {{ $user->role ?? 'user' }}
                  </span>
                </li>
                <li class="d-flex align-items-center justify-content-between mb-2">
                  <span>Fecha de registro</span>
                  <span class="text-secondary">
                    {{ $user->created_at?->format('d/m/Y') }}
                  </span>
                </li>
                <li class="d-flex align-items-center justify-content-between mb-2">
                  <span>Última actualización</span>
                  <span class="text-secondary">
                    {{ $user->updated_at?->diffForHumans() }}
                  </span>
                </li>
                <li class="d-flex align-items-center justify-content-between mb-2">
                  <span>Cambio de contraseña</span>
                  @if(!empty($user->must_change_password) && $user->must_change_password)
                    <span class="badge bg-warning text-dark">Pendiente</span>
                  @else
                    <span class="badge bg-success">Actualizada</span>
                  @endif
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">

          {{--error q necesito a fututo--}}
          {{-- @if($errors)
             <x-alert type="danger" message="Revisá los errores en los campos marcados." small/>
           @endif--}}
          <div class="card bg-azul text-light border-light h-100">
            <div class="card-body pt-0">

              {{-- Tabs --}}
              <ul class="nav tabs-underline justify-content-center mb-2" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active font-bankgothic fs-5" id="ver-tab"
                          data-bs-toggle="tab" data-bs-target="#ver" type="button" role="tab">
                    Datos
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link font-bankgothic fs-5" id="editar-tab" data-bs-toggle="tab"
                          data-bs-target="#editar" type="button" role="tab">
                    Editar datos
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link font-bankgothic fs-5" id="password-tab" data-bs-toggle="tab"
                          data-bs-target="#passwordTab" type="button" role="tab">
                    Cambiar contraseña
                  </button>
                </li>
              </ul>

              <div class="tab-content" id="profileTabsContent">

                {{-- DATOS --}}
                <div class="tab-pane fade show active" id="ver" role="tabpanel" aria-labelledby="ver-tab">
                  <div class="row g-3">

                    <div class="col-md-6">
                      <small class="text-turquesa">Nombre y apellido</small>
                      <div class="readonly-value">{{ $user->name }}</div>
                    </div>

                    <div class="col-md-6">
                      <small class="text-turquesa">Email</small>
                      <div class="readonly-value">{{ $user->email }}</div>
                    </div>

                    <div class="col-md-6">
                      <small class="text-turquesa">Teléfono</small>
                      <div class="readonly-value">
                        {{ $user->phone ?? 'No especificado' }}
                      </div>
                    </div>

                    <div class="col-md-6">
                      <small class="text-turquesa">Ciudad</small>
                      <div class="readonly-value">
                        {{ $user->city ?? 'No especificada' }}
                      </div>
                    </div>
                  </div>
                </div>

                {{-- EDITAR DATOS --}}
                <div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab">
                  <form id="profileForm" class="row g-3 needs-validation"
                        action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Nombre (solo lectura) --}}
                    <div class="col-md-6">
                      <label class="form-label" for="fNombre">Nombre y apellido</label>
                      <input id="fNombre" class="form-control"
                             value="{{ $user->name }}" disabled>
                    </div>

                    {{-- Email (solo lectura) --}}
                    <div class="col-md-6">
                      <label class="form-label" for="fEmail">Email</label>
                      <input id="fEmail" type="email" class="form-control"
                             value="{{ $user->email }}" disabled>
                    </div>

                    {{-- Teléfono --}}
                    <div class="col-md-6">
                      <label class="form-label" for="fTelefono">Teléfono</label>
                      <input id="fTelefono" name="phone" class="form-control"
                             value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                      <x-alert type="danger" :message="$message" small/>
                      @enderror
                    </div>

                    {{-- Ciudad --}}
                    <div class="col-md-6">
                      <label class="form-label" for="fCiudad">Ciudad</label>
                      <input id="fCiudad" name="city" class="form-control"
                             value="{{ old('city', $user->city) }}">
                      @error('city')
                      <x-alert type="danger" :message="$message" small/>
                      @enderror
                    </div>

                    @error('profile_photo')
                    <div class="col-12">
                      <x-alert type="danger" :message="$message" small/>
                    </div>
                    @enderror

                    <div class="col-12 d-grid d-sm-flex gap-3 mt-2">
                      <button class="btn btn-turquesa" type="submit">
                        Guardar cambios
                      </button>
                    </div>
                  </form>
                </div>

                @if(session('success_password'))
                  <x-alert type="success" :message="session('success_password')"/>
                @endif
                {{-- TAB: CAMBIAR CONTRASEÑA --}}
                <div class="tab-pane fade" id="passwordTab" role="tabpanel" aria-labelledby="password-tab">
                  <form id="passwordForm" action="{{ route('profile.password.update') }}"
                        method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Actual --}}
                    <div class="col-12 col-md-6">
                      <label for="current_password" class="form-label">Contraseña actual</label>
                      <div class="input-group">
                        <input type="password" id="current_password" name="current_password"
                               class="form-control">
                        <button type="button" class="btn btn-outline-turquesa" id="togglePassReg" tabindex="-1">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      @error('current_password')
                      <x-alert type=" danger" :message="$message" small/>
                      @enderror
                    </div>

                    {{-- Nueva --}}
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <label for="password" class="form-label">Nueva contraseña</label>
                      <div class="input-group">
                        <input type="password" id="password" name="password"
                               class="form-control ">
                        <button type="button" class="btn btn-outline-turquesa" tabindex="-1">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      @error('password')
                      <x-alert type="danger" :message="$message" small/>
                      @enderror
                    </div>

                    {{-- Confirmación --}}
                    <div class="col-md-6">
                      <label for="password_confirmation" class="form-label">
                        Repetir nueva contraseña
                      </label>
                      <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control">
                        <button type="button" class="btn btn-outline-turquesa" tabindex="-1">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      @error('password_confirmation')
                      <x-alert type="danger" :message="$message" small/>
                      @enderror
                    </div>

                    <div class="col-12 d-flex gap-3 mt-2">
                      <button type="submit" class="btn btn-turquesa">
                        Actualizar contraseña
                      </button>
                      <button type="reset" class="btn btn-outline-light">
                        Limpiar
                      </button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- Mostrar botón caambiar foto solo en pestaña editar --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabs = {
        ver: document.querySelector('#ver-tab'),
        editar: document.querySelector('#editar-tab'),
        password: document.querySelector('#password-tab'),
      };

      const editOnlyEls = document.querySelectorAll('.tab-only-edit');

      function toggleEditButtons(activeKey) {
        const show = activeKey === 'editar';
        editOnlyEls.forEach(el => {
          el.style.display = show ? 'block' : 'none';
        });
      }

      function activateTab(key) {
        const tabTrigger = tabs[key];
        if (!tabTrigger) return;

        const tab = new bootstrap.Tab(tabTrigger);
        tab.show();
        toggleEditButtons(key);
      }

      //Tab inicial según sesión
      const initialTab = @json(session('active_tab', 'ver'));
      activateTab(initialTab);

      //Cuando el usuario cambia de tab manualmente
      Object.entries(tabs).forEach(([key, trigger]) => {
        if (!trigger) return;

        trigger.addEventListener('shown.bs.tab', function () {
          toggleEditButtons(key);
        });
      });

      //escucho el cambio de la foto de perfil para visualizar la foto actual q subo
      const fileInput = document.querySelector('input[name="profile_photo"]');
      const avatarImg = document.querySelector('img[alt^="Foto de perfil"]');

      if (fileInput && avatarImg) {
        fileInput.addEventListener('change', function (e) {
          const file = e.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
              avatarImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
          }
        });
      }
    });
  </script>

@endsection
