<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Coche</title>
</head>
<body>
    <h1>Añadir Nuevo Coche ({{ session('concesionario') }})</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coches.store') }}" method="POST">
        @csrf
        <div>
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}" required>
        </div>
        <br>
        <div>
            <label for="unidades">Unidades:</label>
            <input type="number" name="unidades" id="unidades" value="{{ old('unidades') }}" required>
        </div>
        <br>
        <button type="submit">Guardar</button>
        <a href="{{ route('coches.index') }}">Cancelar</a>
    </form>
</body>
</html>