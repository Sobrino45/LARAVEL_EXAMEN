<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
</head>
<body>
    <div style="float: right;">
        <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>

    <h1>Listado de Coches - {{ $concesionario }}</h1>

    @if(Cookie::has('ultima_sesion'))
        <p style="color: blue;">Última sesión iniciada el: {{ Cookie::get('ultima_sesion') }}</p>
    @endif

    <p>
        <a href="{{ route('coches.create') }}" style="color: blue; text-decoration: underline;">Añadir nuevo coche</a>
    </p>

    <form action="{{ route('coches.index') }}" method="GET" style="margin-bottom: 20px;">
        <label>
            <input type="radio" name="filtrar" value="todos" {{ !$filtroActivo ? 'checked' : '' }}> Todos
        </label>
        <label style="margin-left: 10px;">
            <input type="radio" name="filtrar" value="concesionario" {{ $filtroActivo ? 'checked' : '' }}> Filtrar
        </label>
        <button type="submit" style="margin-left: 10px;">Aplicar</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Unidades</th>
                <th>Pueblo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coches as $coche)
                <tr>
                    <td>{{ $coche->id }}</td>
                    <td>{{ $coche->modelo }}</td>
                    <td>{{ $coche->unidades }}</td>
                    <td>{{ $coche->concesionario }}</td>
                    <td>
                        <a href="{{ route('coches.edit', $coche->id) }}">Editar</a>
                        
                        <form action="{{ route('coches.destroy', $coche->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que deseas borrar este coche?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay coches en la base de datos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>