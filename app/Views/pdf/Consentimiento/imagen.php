<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Permiso de Uso de Imagen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 210mm;
            margin: 5mm auto;
            padding: 7mm;
        }

        .header-compact {
            text-align: center;
            padding-top: 10px;
            margin-bottom: 7px;
            padding-bottom: 2px;
            border-bottom: 1px solid #216E71;
        }

        .data-compact {
            font-size: 10.5pt;
            text-align: justify;
        }

        .new-page {
            page-break-before: always;
            padding-top: 70px;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            font-size: 9.5pt;
            padding: 10px 30px;
            vertical-align: bottom;
            height: 120px;
        }

        .signature-content {
            position: relative;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto 5px auto;
        }

        .signature-name {
            font-weight: bold;
            font-size: 9.5pt;
            margin-top: 5px;
        }

        .signature-img {
            display: block;
            position: absolute;
            bottom: 30px;
            left: 0;
            right: 0;
            margin: 0 auto;
            max-width: 20%;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header-compact">
            <h4>Ref.: PERMISO DE USO DE IMAGEN</h4>
        </div>

        <div class="data-compact">
            <p>Yo, <?= $paciente ?>, identificado con DNI Nº <?= $dni ?>. con domicilio en <?= $direccion ?>, otorgo mi consentimiento expreso a la empresa KYP - BIO INGEN S.A.C., con RUC Nº 20600880081 y domicilio legal en Cal. Max Palma Arrue Nro.1117 Urb. Venus. para utilizar mi imagen en fotografías y/o videos tomados por un equipo profesional.</p>

            <p>Este permiso abarca el uso de mi imagen en redes sociales, plataformas en Línea, material impreso, publicidades, material promocional y cualquier otro medio de difusión que KYP - BIO INGEN S.A.C. considere necesario para la promoción de sus servicios.</p>

            <p>Entiendo que las imágenes serán utilizadas exclusivamente con el propósito de promocionar los servicios ofrecidos por KYP - BIO INGEN S.AC. y no serán utilizadas para ningún otro propósito sin mi consentimiento expreso.</p>

            <p>Además, renunció a cualquier derecho de compensación o regalía por el uso de estas imágenes.</p>

            <p>Este permiso es válido desde La fecha de la firma y permanecerá en vigor durante un período de 1 año a partir de dicha fecha.</p>

            <p>En caso de revocación.cualquier material en el que mi imagen haya sido utilizada deberá ser retirado de a circulación en un plazo razonable de 15 días hábiles.</p>
        </div>

        <div class="data-compact">
            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name"><?= $paciente ?></div>
                            <div>DNI: <?= $dni ?></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>