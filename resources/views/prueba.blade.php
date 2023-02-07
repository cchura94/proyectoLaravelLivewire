<h1>Vista de Prueba</h1>


@auth
<h1>{{ Auth::user()->name }}</h1>

<form action="/logout" method="post">
    @csrf
    <input type="submit" value="Cerrar sesion">
</form>

@else
<h1>No estoy logueado</h1>
<a href="/login">Iniciar Sesion</a>
@endauth
