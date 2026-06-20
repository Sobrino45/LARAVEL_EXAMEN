<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Surmotor</title>
</head>
<body>
    <h1>Acceso a Concesionarios</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div>
            <label for="concesionario">Nombre del Concesionario:</label>
            <input type="text" name="concesionario" id="concesionario" required>
        </div>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>