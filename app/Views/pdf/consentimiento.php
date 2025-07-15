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

    <?php if ($paciente['mayor_edad'] === 'No'): ?>
      <div class="contenido-legal">
        <p>Yo, <strong><?= mb_strtoupper($paciente['nombres_apoderado'] . ' ' . $paciente['apellidos_apoderado'])  ?></strong>, identificado/a con DNI N.º <strong><?= $paciente['dni_apoderado'] ?></strong>, en calidad de <strong><?= $paciente['vinculo_apoderado'] ?></strong> del menor <strong><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?></strong>, quien se encuentra bajo mi tutela legal, declaro que otorgo mi consentimiento informado para que el personal médico y los profesionales capacitados de la empresa <strong>KYP BIO INGEN S.A.C</strong> realicen el <strong>contacto físico</strong> necesario durante el tratamiento, evaluación y cuidado relacionado con su condición de amputación.</p>

        <p>Entiendo y acepto que dicho contacto físico puede ser requerido para llevar a cabo evaluaciones para la colocación de dispositivos ortopédicos y protésicos, con el fin de contribuir al bienestar del menor. Esto puede incluir, pero no se limita a: inspección visual, palpación, movilización de extremidades y adaptación de componentes.</p>

        <p>He recibido información clara y suficiente sobre los procedimientos que implican contacto físico, así como los posibles riesgos y beneficios, y se me ha brindado la oportunidad de realizar todas las preguntas necesarias, las cuales han sido respondidas satisfactoriamente.</p>

        <p>Asimismo, comprendo que tengo el derecho de revocar este consentimiento en cualquier momento y que dicha decisión no afectará el acceso a la atención médica del menor.</p>

        <p>Declaro que este consentimiento ha sido otorgado de manera libre, voluntaria y sin ningún tipo de coacción, y autorizo al personal de <strong>KYP BIO INGEN S.A.C</strong> a proceder con los procedimientos que impliquen contacto físico con el menor bajo mi responsabilidad.</p>

        <p>También autorizo que toda información relacionada con dichos procedimientos sea documentada y almacenada de forma segura en el historial de atención del paciente.</p>

        <div class="firma-compact" style="margin-top: 40px;">
          <div>
            <!-- Firma -->
            <div style="display: inline-block; width: 250px; vertical-align: top; text-align: center; margin-right: 60px; margin-bottom: 10px;">
              <div style="border-top: 1px solid #000; margin-bottom: 5px;"></div>
              <div style="font-size: 11pt;">Firma del paciente</div>
            </div>

            <!-- Cuadro de huella -->
            <div style="display: inline-block; width: 100px; height: 100px; border: 1px solid #000; vertical-align: top; text-align: center;">
              <div style="font-size: 10pt; padding-top: 80px;">Huella</div>
            </div>
          </div>

          <!-- Fecha -->
          <div style="margin-top: 20px; font-size: 11pt;">
            Fecha:
          </div>
        </div>



      </div>
    <?php else: ?>
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
          cualquier información relacionada con el contacto físico en mi historial de atención.</p>

        <!-- Firmas -->
        <div class="firma-compact">
          <table style="width: 100%; margin-top: 12px;">
            <tr>
              <td style="width: 48%; text-align: left;">
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
    <?php endif; ?>


  </div>
</body>

</html>