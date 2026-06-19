<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Coche</title>
</head>
<body>
    <h1>Editar Coche #{{ $coche->id }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coches.update', $coche->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $coche->modelo) }}" required>
        </div>
        <br>
        <div>
            <label for="unidades">Unidades:</label>
            <input type="number" name="unidades" id="unidades" value="{{ old('unidades', $coche->unidades) }}" required>
        </div>
        <br>
        <div>
            <label for="concesionario">Concesionario:</label>
            <select name="concesionario" id="concesionario" required>
                <option value="">Seleccione un concesionario</option>
                @foreach($concesionarios as $concesionario)
                    <option value="{{ $concesionario }}" {{ old('concesionario', $coche->concesionario) == $concesionario ? 'selected' : '' }}>
                        {{ $concesionario }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Actualizar</button>
        <a href="{{ route('coches.index') }}">Cancelar</a>
    </form>
</body>
</html>