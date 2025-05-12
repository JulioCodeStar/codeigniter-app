<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      font-size: 11pt;
      line-height: 1.5;
      color: #333;
      margin: 0;
    }

    .consentimiento {
      padding-top: 50px;
    }

    .lista-procedimientos li {
      margin-bottom: 8px;
    }

    .firma-compact {
      margin-top: 30px;
      padding-top: 20px;
      font-size: 8.5pt;
    }

    .contenido-legal p {
      text-align: justify;
    }
  </style>
</head>

<body>
  <div class="consentimiento">
    <h2 style="color: #000; text-align: center;">Consentimiento Informado para el Contacto Físico con Pacientes Amputados</h2>

    <div class="contenido-legal">
      <p>Yo, <strong><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos'])  ?></strong>, en pleno uso de mis facultades mentales y entendiendo plenamente la naturaleza de este consentimiento, otorgo mi consentimiento informado para que el personal médico y los profesionales capacitados de la empresa KYP BIO INGEN S.A.C realicen el contacto físico necesario durante el tratamiento y cuidado de mi condición de amputación.</p>

      <p>Entiendo y acepto que el contacto físico puede ser necesario para realizar una evaluación
        adecuada, proporcionar tratamiento médico, llevar a cabo procedimientos terapéuticos y
        mejorar mi bienestar general como paciente amputado. Comprendo que el contacto físico
        puede incluir, pero no se limita a, la inspección visual, la palpación, la movilización de
        extremidades y la aplicación de dispositivos médicos y ortopédicos.</p>

      <p>Además, se me ha proporcionado información detallada sobre los procedimientos específico
        que implicarán contacto físico, así como los riesgos y beneficios asociados. He tenido la
        oportunidad de hacer preguntas y todas ellas han sido respondidas satisfactoriamente.</p>

      <p>También entiendo que tengo el derecho de retirar mi consentimiento en cualquier aspecto de
        mi tratamiento o cuidado.</p>

      <p>Declaro que este consentimiento ha sido otorgado de manera voluntaria y sin ninguna forma
        de coerción o presión. Soy plenamente consciente de las implicaciones y consecuencias del
        contacto físico y autorizo a los profesionales capacitados de la empresa KYP BIO INGEN S.A.C a
        llevar a cabo dichos procedimientos en mi persona.
      </p>

      <p>Además, doy mi consentimiento para que se documente y almacene de manera segura
        cualquier información relacionada con el contacto físico en mi historial médico.</p>

      <!-- Firmas -->
      <div class="firma-compact">
        <table style="width: 100%; margin-top: 12px;">
          <tr>
            <td style="width: 48%; text-align: left;" >
              <div style="border-top: 1px solid #000; width: 80%; margin: 0 auto;"></div>
              <div style="font-size: 11pt;">Firma del paciente</div>
            </td>
          </tr>
          <tr>
            <td style="text-align: left; font-size: 11pt; margin-top: 5px;">
              Fecha:
            </td>
          </tr>
        </table>

      </div>
    </div>
  </div>
</body>

</html>