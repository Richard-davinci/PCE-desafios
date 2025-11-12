<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
</head>
<body>


<main class="bg-gradient-dark text-light">
    {{ $slot ?? '' }}
    @yield('content')
</main>

@include('partials.scripts')
@yield('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = [
            {btn: '#togglePassLogin', input: '#passLogin'},
            {btn: '#togglePassReg', input: '#passReg'},
            {btn: '#togglePassReg2', input: '#passReg2'},
        ];

        toggles.forEach(({btn, input}) => {
            const button = document.querySelector(btn);
            const field = document.querySelector(input);

            if (button && field) {
                button.addEventListener('click', function () {
                    const isPassword = field.type === 'password';
                    field.type = isPassword ? 'text' : 'password';
                    this.innerHTML = isPassword
                        ? '<i class="fa-solid fa-eye-slash"></i>'
                        : '<i class="fa-solid fa-eye"></i>';
                });
            }
        });
    });
</script>


</body>
</html>
