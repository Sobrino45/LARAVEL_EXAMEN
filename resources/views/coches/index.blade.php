<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Coches - Surmotor</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Listado de Coches - {{ $concesionario }}</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    
    @if($ultimaSesion)
        <p style="color: blue;">Última sesión iniciada el: {{ $ultimaSesion }}</p>
    @else
        <p style="color: blue;">Esta es tu primera sesión hoy.</p>
    @endif
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('coches.create') }}">Añadir nuevo coche</a>
    
    <table border="1" cellpadding="10" style="margin-top: 15px; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Unidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coches as $coche)
                <tr>
                    <td>{{ $coche->id }}</td>
                    <td>{{ $coche->modelo }}</td>
                    <td>{{ $coche->unidades }}</td>
                    <td>
                        <a href="{{ route('coches.edit', $coche->id) }}">Editar</a> | 
                        <form action="{{ route('coches.destroy', $coche->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>