{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="las la-users"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('curso') }}"><i class="las la-chalkboard-teacher"></i> Cursos</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('plan') }}"><i class="las la-hand-holding-usd"></i> Plans</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('suscripcion') }}"><i class="las la-user-check"></i> Suscripcions</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dieta') }}"><i class="las la-utensils"></i> Dietas</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="las la-user-tag"></i> Roles</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('sesion') }}"><i class="las la-clipboard-list"></i> Sesions</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('usuario-sesion') }}"><i class="las la-user"></i><i class="las la-clipboard-list"></i> Usuario sesions</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('ejercicio') }}"><i class="las la-dumbbell"></i> Ejercicios</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('ejercicio-sesion') }}"><i class="las la-dumbbell"></i><i class="las la-clipboard-list"></i> Ejercicio sesions</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('inscripcion') }}"><i class="las la-user-check"></i> Inscripcions</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-question"></i> Permissions</a></li>