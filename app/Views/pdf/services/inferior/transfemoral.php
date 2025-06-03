<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ficha de Evaluación Transfemoral</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #333;
            background-color: #fff;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
            padding: 3mm;
            padding-top: 10mm;
        }

        .header {
            text-align: center;
            margin-bottom: 4mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid #2c3e50;
        }

        .header h1 {
            font-size: 11pt;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            margin: 1mm 0;
            letter-spacing: 0.5px;
        }

        .eval-table {
            width: 60%;
            border-collapse: collapse;
            margin-bottom: 2mm;
        }

        .eval-table td {
            padding: 1.5mm 1mm;
            vertical-align: baseline;
        }

        .eval-label {
            width: 40%;
            font-weight: 500;
        }

        .eval-nombre {
            width: 80%;
            font-weight: bold;
        }

        .section {
            margin-bottom: 4mm;
        }

        .section-medio {
            margin-bottom: 35px;
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
            border-left: 4px solid #3498db;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #2c3e50;
            background-color: #f5f7f9;
            padding: 2mm 3mm;
            margin-bottom: 2mm;
            border-left: 3px solid #2c3e50;
        }

        .eval-label-encaje {
            width: 100%;
            font-weight: 500;
            border: 1px;
        }

        .checkbox-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2mm 0;
        }

        .checkbox-table td {
            padding: 1.5mm 0;
            text-align: center;
            border: 0.5px solid #e0e0e0;
        }

        .checkbox-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .new-page {
            padding-top: 10mm;
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>FICHA DE EVALUACIÓN TRANSFEMORAL | DESARTICULADO DE RODILLA</h1>
        </div>

        <table class="eval-table">
            <tr>
                <td class="eval-label">PACIENTE:</td>
                <td class="eval-nombre"><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?></td>
                <td class="eval-label">MONTO TOTAL:</td>
                <td class="">______________________________</td>
            </tr>
        </table>

        <table class="eval-table">
            <tr>
                <td class="eval-label">PESO(KG): </td>
                <td class="eval-nombre">___________</td>
            </tr>
            <tr>
                <td class="eval-label">SELECCIÓN DE PRÓTESIS:</td>
                <td class="">( ) Transfemoral ( ) Rodilla</td>
            </tr>
        </table>

        <div class="section">
            <div class="section-title">TIPO DE ENCAJE:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Fibra de Vidrio</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Fibra de Carbono</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Endosocket Proteor</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">TIPO DE SUJECIÓN:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Sujeción Lanyard</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Locker Pin</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Valvula de Vacío y Oring. TALLA: _______</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Ninguna</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">TIPO DE LINER:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <label for="rec-mecanica">TALLA: ________</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Lineal</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Cónica</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">K1 - 0.0</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">K2 - 0.5</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">K3 - 10</label>
                    </td>
                </tr>
            </table>

            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <label for="rec-mecanica">LONGITUD: ________</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">C/Adaptador</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">S/Adaptador</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Ninguna</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">TIPO DE RODILLA:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Mecánica</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Hidráulica</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Neumática</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Geriátrica</label>
                    </td>
                </tr>
            </table>

            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Win Walker</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Össur</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Ottobock</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">LIMP</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">TIPO DE PIE:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Clásica</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Fibra de Carbono</label>
                    </td>
                </tr>
            </table>

            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Multiaxial</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Sach</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Tobillo Alto</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Tobillao Bajo</label>
                    </td>
                </tr>
            </table>

            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">LIMP</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Win Walker</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Össur</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">Otros: _________________</label>
                    </td>
                </tr>
            </table>

            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <label for="rec-mecanica">TALLA: _________________ LADO:</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">L</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-estetica">
                        <label for="rec-estetica">R</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">ACABADO ESTÉTICO:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Media</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Media con Funda Estética</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">Cover 3D</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">CONECTORES ESPECIALES:</div>
            <table class="checkbox-table">
                <tr>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-mecanica">
                        <label for="rec-mecanica">Si</label>
                    </td>
                    <td class="checkbox-item">
                        <input type="checkbox" id="rec-bionica">
                        <label for="rec-bionica">No</label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="new-page">
            <div class="section">
                <div class="section-title">EVALUACIONES INICIALES:</div>
                <table class="eval-table">
                    <tr>
                        <td class="eval-label">Movilidad (1-10):</td>
                        <td class="eval-nombre">_________________________</td>
                    </tr>
                    <tr>
                        <td class="eval-label">Fuerza Muscular (1-10): </td>
                        <td class="">_________________________</td>
                    </tr>
                    <tr>
                        <td class="eval-label">Equilibrio (1-10): </td>
                        <td class="">_________________________</td>
                    </tr>
                    <tr>
                        <td class="eval-label">Sensibilidad :  </td>
                        <td class="">_________________________</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">PRÓTESIS PREVIAS</div>
                <table class="eval-table">
                    <tr>
                        <td class="eval-label">Duración de uso:</td>
                        <td class="eval-nombre">( ) Sí    ( ) No </td>
                    </tr>
                </table>
            </div>

            <img src="<?= base_url('assets/media/img/M1.jpg') ?>" alt="evaluacion_transfemoral">
        </div>
    </div>
</body>

</html>