<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso No Autorizado - 403</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #25767D;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(37, 118, 125, 0.1);
            border: 1px solid rgba(37, 118, 125, 0.1);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #25767D, #30919B);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            color: #30919B;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(48, 145, 155, 0.1);
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #25767D;
            margin-bottom: 1rem;
        }

        .error-subtitle {
            font-size: 1.2rem;
            color: #30919B;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-description {
            font-size: 1rem;
            color: #25767D;
            opacity: 0.8;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .icon-container {
            margin-bottom: 2rem;
        }

        .lock-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: #30919B;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lock-icon::before {
            content: '🔒';
            font-size: 2rem;
            color: white;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #25767D 0%, #30919B 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e5f66 0%, #287a82 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 118, 125, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #25767D;
            border: 2px solid #25767D;
        }

        .btn-secondary:hover {
            background: #25767D;
            color: white;
            transform: translateY(-2px);
        }

        .contact-info {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(37, 118, 125, 0.2);
        }

        .contact-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #25767D;
            margin-bottom: 0.5rem;
        }

        .contact-text {
            font-size: 0.9rem;
            color: #30919B;
        }

        .contact-email {
            color: #25767D;
            text-decoration: none;
            font-weight: 600;
        }

        .contact-email:hover {
            color: #30919B;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 2rem;
                margin: 1rem;
            }

            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-subtitle {
                font-size: 1.1rem;
            }

            .buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
            }
        }

        /* Elementos decorativos sutiles */
        .decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(48, 145, 155, 0.05);
            top: -50px;
            right: -50px;
        }

        .decoration-2 {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(37, 118, 125, 0.05);
            bottom: -30px;
            left: -30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Elementos decorativos sutiles -->
        <div class="decoration"></div>
        <div class="decoration-2"></div>
        
        <div class="error-code">401</div>
        
        <div class="icon-container">
            <div class="lock-icon"></div>
        </div>

        <h1 class="error-title">Acceso Denegado</h1>
        
        <p class="error-subtitle">
            No tienes permisos para acceder a esta página
        </p>
        
        <p class="error-description">
            Lo sentimos, pero no cuentas con los permisos necesarios para ver este contenido. 
            Si crees que esto es un error, contacta con el administrador del sistema.
        </p>

        <div class="buttons">
            <a href="<?= site_url() ?>" class="btn btn-primary">
                🏠 Ir al Inicio
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                ← Volver Atrás
            </a>
        </div>
    </div>
</body>
</html>