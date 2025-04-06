<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso - NeuroAr</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f9ff;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 123, 255, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .header img {
            width: 80px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .info {
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #007bff;
        }

        .info p {
            margin: 8px 0;
            font-size: 15px;
        }

        .footer {
            background-color: #f4f9ff;
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 20px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            margin-top: 25px;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ asset('imagenes/icono-logo.png') }}" alt="Logo animalista futurista">
        <h1>Bienvenido a NeuroAr</h1>
    </div>
    <div class="content">
        <h2>¡Hola {{ $usuario->name }}!</h2>

        <p>Tu registro ha sido exitoso. A continuación encontrarás tus datos de acceso:</p>

        <div class="info">
            <p><strong>📧 Correo registrado:</strong> {{ $usuario->email }}</p>
            <p><strong>🔐 Contraseña:</strong> {{ $contrasena }}</p>
        </div>

        <p>Por tu seguridad, te recomendamos cambiar tu contraseña una vez inicies sesión.</p>

        <a href="https://app.neuroar.com.co/" class="button" target="_blank">Ir al sitio</a>
    </div>

    <div class="footer">
        Este correo fue enviado automáticamente. Si tienes dudas, contáctanos en
        <a href="https://neuroar.com.co/">https://neuroar.com.co/</a>.
        <br>
        © {{ date('Y') }} NeuroAr. Todos los derechos reservados.
    </div>
</div>
</body>
</html>
