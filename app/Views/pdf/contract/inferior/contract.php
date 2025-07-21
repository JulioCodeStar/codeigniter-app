<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
            font-size: 9.5pt;
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
            <h4>CONTRATO DE SERVICIOS</h4>
        </div>

        <?php if ($mayor_edad == 'No') { ?>

            <div class="data-compact">
                <p>Conste por el presente documento, el Contrato de Locación de Servicios que celebran de una parte <strong>KYP BIO INGEN SAC </strong> con RUC. N° 20600880081 domiciliado en la Calle Max Palma Arrué N° 119 distrito de Los Olivos - Lima - Lima, representado por su Gerente General Sr. <strong>PERCY GIOVANY MAGUIÑA VARGAS</strong>, identificado con DNI N° 45077305 según poder inscrito en el Asiento N° A0001 de la Partida Electrónica N° 13526119 del Registro de Personas Jurídicas de la Oficina Registral de Lima, a quien en adelante se denominará <strong>KYP BIO INGEN SAC</strong>, y de la otra parte <strong><?= $nombres_apoderado ?></strong> identificado con DNI N° <?= $dni_apoderado ?>, en su calidad de <strong>REPRESENTANTE LEGAL</strong> del menor <strong><?= $paciente ?></strong> identificado con DNI N° <?= $dni ?>, a quien en adelante se le denominará <strong>EL REPRESENTANTE LEGAL</strong> y en conjunto con <strong>KYP BIO INGEN SAC</strong> se les denominará "Las Partes", en los términos y condiciones siguientes:</p>
            </div>

        <?php } else { ?>

            <div class="data-compact">
                <p>Conste por el presente documento, el Contrato de Locación de Servicios que celebran de una parte parte <strong>KYP BIO INGEN SAC</strong> con RUC. N° 20600880081 domiciliado en la Calle Max palma Arrué N° 119 distrito de Los Olivos - Lima - Lima, representado por su Gerente General Sr. <strong>PERCY GIOVANY MAGUIÑA VARGAS</strong>, identificado con DNI N° 45077305 según poder inscrito en el Asiento N° A0001 de la Partida Electrónica N° 13526119 del Registro de Personas Jurídicas de la Oficina Registral de Lima, a quien en adelante se denominará <strong>KYP BIO INGEN SAC</strong>, y de la otra parte <strong><?= $paciente ?></strong> identificado con DNI N° <?= $dni ?> con domicilio en <?= $direccion ?>, a quien en adelante se le denominará <strong>EL CLIENTE</strong> y en conjunto con <strong>KYP BIO INGEN SAC</strong> se les denominará "Las Partes", en los términos y condiciones siguientes: </p>
            </div>

        <?php } ?>

        <div class="data-compact">
            <strong>PRIMERA: DE LAS PARTES</strong>
            <p>KYP BIO INGEN SAC es una persona jurídica de derecho privado constituida como Sociedad Anónima Cerrada y bajo el régimen MYPE (MICROEMPRESA), cuyo objeto social es la elaboración y comercialización de prótesis para personas con discapacidad, el cual cumple con las formalidades de Ley, permisos y autorizaciones que se requiere para la realización de la actividad y/o servicio que presta.</p>

            <?php if ($mayor_edad == 'No') { ?>
                <p>EL REPRESENTANTE LEGAL es una persona natural que actúa en representación del menor <strong><?= $paciente ?></strong>, quien requiere se le brinde el servicio de elaboración de una prótesis por discapacidad. El representante legal declara tener la patria potestad y/o tutela legal del menor, así como la capacidad legal para contratar en su nombre y representación.</p>

            <?php } else { ?>
                <p>EL CLIENTE es una persona natural que requiere se le brinde el servicio de elaboración de una prótesis por discapacidad.</p>
            <?php } ?>
        </div>

        <div class="data-compact">
            <strong>SEGUNDA: DEL OBJETO</strong>
            <?php if ($mayor_edad == 'No') { ?>
                <p>Por el presente documento, KYP BIO INGEN SAC se obliga frente a <strong>EL REPRESENTANTE LEGAL</strong> a la elaboración de una prótesis biomecánica funcional para el menor <strong><?= $paciente ?></strong>, de acuerdo a las especificaciones y plazos anotados en la hoja de requerimiento, el cual constituye parte integrante del presente contrato.</p>
            <?php } else { ?>
                <p>Por el presente documento, KYP BIO INGEN SAC se obliga frente a <strong>EL CLIENTE</strong> a la elaboración de una prótesis biomecánica funcional de acuerdo a las especificaciones y plazos anotadas en la hoja de requerimiento. el cual constituye parte integrante del presente contrato.</p>
            <?php } ?>
        </div>

        <div class="data-compact">
            <strong>TERCERA: DE LA NATURALEZA DEL CONTRATO</strong>

            <?php if ($mayor_edad == 'No') { ?>
                <p>Se deja expresa constancia que todo lo no previsto en el presente Contrato se aplicarán las disposiciones contenidas en el Código Civil y el Código de los Niños y Adolescentes, pues, conforme se aprecia de las condiciones del servicio, el presente contrato tiene naturaleza civil, según lo dispuesto en los artículos 1764° y 1769° del Código Civil peruano, por lo que éste no implica ningún tipo de subordinación ni dependencia laboral alguna de KYP BIO INGEN SAC con <strong>EL REPRESENTANTE LEGAL</strong>.</p>
            <?php } else { ?>
                <p>Se deja expresa constancia que todo lo no previsto en el presente Contrato se aplicarán las disposiciones contenidas en el Código Civil, pues, conforme se aprecia de las condiciones del servicio, el presente contrato tiene naturaleza civil, según lo dispuesto en los artículos 1764° y 1769° del Código Civil peruano, por lo que éste no implica ningún tipo de subordinación ni dependencia laboral alguna de KYP BIO INGEN SAC con <strong>EL CLIENTE</strong>.</p>
            <?php } ?>
        </div>

        <div class="data-compact">
            <strong>CUARTA: PRESTACIÓN INDEPENDIENTE Y AUTONOMA DE LOS SERVICIOS </strong>

            <?php if ($mayor_edad == 'No') { ?>
                <p>Para los efectos de la ejecución del presente contrato, <strong>KYP BIO INGEN SAC</strong> prestará sus servicios profesionales en la forma, fecha, tiempo y demás condiciones acordadas previamente con <strong>EL REPRESENTANTE LEGAL</strong>, con sus propios recursos. En tal sentido, KYP BIO INGEN SAC tiene plena libertad en el ejercicio de sus servicios.</p>
            <?php } else { ?>
                <p>Para los efectos de la ejecución del presente contrato, <strong>KYP BIO INGEN SAC</strong> prestará sus servicios profesionales en la forma, fecha, tiempo y demás condiciones acordadas previamente con <strong>EL CLIENTE</strong>, con sus propios recursos. En tal sentido, KYP BIO INGEN SAC tiene plena libertad en el ejercicio de sus servicios.</p>
                <p>Se deja establecido que, por la naturaleza del servicio que se contrata, no estará sujeto a jornada u horario alguno ni a supervisión o fiscalización de ninguna índole.</p>
            <?php } ?>
        </div>

        <div class="new-page">
            <div class="data-compact">
                <strong>QUINTA: RETRIBUCIÓN ECONÓMICA</strong>

                <?php if ($mayor_edad == 'No') { ?>
                    <p>Las Partes acuerdan que la retribución que pagará <strong>EL REPRESENTANTE LEGAL</strong> a <strong>KYP BIO INGEN SAC</strong> como contraprestación por los servicios prestados al menor asciende a <?= $moneda ?> <?= $total ?> (<?= $total_letter ?>) más IGV, el cual será cancelado de la siguiente manera:</p>

                    <ul>
                        <li>El 50% del monto (más IGV) a la firma del presente contrato.</li>
                        <li>El 50% del monto (más IGV) a la entrega de la prótesis con el pre encaje.</li>
                    </ul>

                    <p>Para el pago de la retribución económica, <strong>KYP BIO INGEN SAC</strong> entregará a <strong>EL REPRESENTANTE LEGAL</strong> el respectivo comprobante de pago. En caso se produzca retraso injustificado en el recojo y/o pago de la prótesis por más de 15 días por parte de <strong>EL REPRESENTANTE LEGAL</strong>, <strong>KYP BIO INGEN SAC</strong> tendrá derecho a la no devolución del monto adelantado como penalidad y a exigir el pago de los intereses moratorios.</p>

                <?php } else { ?>

                    <p>Las Partes acuerdan que la retribución que pagará <strong>EL CLIENTE</strong> a <strong>KYP BIO INGEN SAC</strong> como contraprestación por los servicios prestados asciende a <?= $moneda ?> <?= $total ?> (<?= $total_letter ?>) mas IGV, el cual será cancelado de la siguiente manera:</p>

                    <ul>
                        <li>El 50% del monto (más IGV) a la firma del presente contrato.</li>
                        <li>El 50% del monto (más IGV) a la entrega de la prótesis con el pre encaje.</li>
                    </ul>

                    <p>Para el pago de la retribución económica, <strong>KYP BIO INGEN SAC</strong> entregará a <strong>EL CLIENTE</strong> el respectivo comprobante de pago. En caso se produzca retraso injustificado en el recojo y/o pago de la prótesis por más de 15 días por parte de <strong>EL CLIENTE</strong>, <strong>KYP BIO INGEN SAC</strong> tendrá derecho a la no devolución del monto adelantado como penalidad y a exigir el pago de los intereses moratorios, que se devengarán desde la fecha en que se produzca el incumplimiento injustificado del pago.</p>
                <?php } ?>
            </div>

            <div class="data-compact">
                <strong>SEXTA: DE LAS OBLIGACIONES DE LAS PARTES</strong>
                <p><strong>KYP BIO INGEN SAC</strong>, en virtud al presente Contrato, se obliga a: </p>

                <?php if ($mayor_edad == 'No') { ?>
                    <ul>
                        <li>Realizar las asesorías requeridas por <strong>EL REPRESENTANTE LEGAL</strong>.</li>
                        <li>Proporcionar los informes que sean requeridos por <strong>EL REPRESENTANTE LEGAL</strong> respecto al servicio materia del presente Contrato.</li>
                        <li>Cumplir con los plazos estipulados en la hoja de requerimiento.</li>
                        <li>Mantener un ambiente adecuado y seguro para la atención de menores de edad.</li>
                    </ul>
                    <p><strong>EL REPRESENTANTE LEGAL</strong>, en virtud al presente Contrato, se obliga a: </p>
                    <ul>
                        <li>Asumir el pago de la retribución económica según lo estipulado en el presente contrato.</li>
                        <li>Acompañar al menor a las instalaciones de KYP BIO INGEN SAC cada vez que esta lo requiera para la elaboración de la prótesis.</li>
                        <li>Velar por el cumplimiento de las indicaciones médicas y de cuidado por parte del menor.</li>
                    </ul>
                <?php } else { ?>
                    <ul>
                        <li>Realizar las asesorías requeridas por EL CLIENTE.</li>
                        <li>Proporcionar los informes que sean requeridos por EL CLIENTE respecto al servicio materia del presente Contrato.</li>
                        <li>Cumplir con los plazos estipulados en la hoja de requerimiento.</li>
                        <li>Otras que le sean solicitadas por EL CLIENTE en el marco del objeto del presente contrato.</li>
                    </ul>
                    <p>EL CLIENTE, en virtud al presente Contrato, se obliga a: </p>
                    <ul>
                        <li>Asumir el pago de la retribución económica según lo estipulado en el presente contrato.</li>
                        <li>Apersonarse a las instalaciones de KYP BIO INGEN SAC cada vez que esta lo requiera para la elaboración de la prótesis.</li>
                        <li>Otras obligaciones que pudiesen emanar de las estipulaciones del presente contrato.</li>
                    </ul>
                <?php } ?>
            </div>

            <div class="data-compact">
                <strong>SÉPTIMA: PLAZO</strong>
                <?php if ($mayor_edad == 'No') { ?>
                    <p>El presente Contrato tendrá un plazo de duración de acuerdo a lo pactado en la hoja de requerimiento suscrito por las partes, salvo KYP BIO INGEN SAC comunique a <strong>EL REPRESENTANTE LEGAL</strong>, de manera justificada, la necesidad de un mayor plazo.</p>
                <?php } else { ?>
                    <p>El presente Contrato tendrá un plazo de duración de acuerdo a lo pactado en la hoja de requerimiento suscrito por las partes, salvo KYP BIO INGEN SAC comunique a <strong>EL CLIENTE</strong>, de manera justificada, la necesidad de un mayor plazo.</p>
                <?php } ?>
            </div>

            <div class="data-compact">
                <strong>OCTAVA: RESERVA, CONFIDENCIALIDAD Y PROPIEDAD INTELECTUAL</strong>

                <?php if ($mayor_edad == 'No') { ?>
                    <p><strong>EL REPRESENTANTE LEGAL</strong> se compromete y obliga a no usar en su propio provecho ni divulgar directa o indirectamente a ninguna persona, empresa o entidad de cualquier índole, la información proporcionada por <strong>KYP BIO INGEN SAC</strong> para la prestación del servicio a su cargo.</p>
                    <p><strong>EL REPRESENTANTE LEGAL</strong> se compromete y obliga a no reproducir, entregar o permitir que se entregue o que se acceda y/o use información a que se refiere el numeral precedente, salvo que exista autorización previa y por escrito del <strong>KYP BIO INGEN SAC</strong>.</p>
                    <p>La obligación de confidencialidad a que se refiere la presente cláusula tendrá una vigencia de (1) año calendario contados a partir de la suscripción del presente documento.</p>
                <?php } else { ?>
                    <p><strong>EL CLIENTE</strong> se compromete y obliga a no usar en su propio provecho ni divulgar directa o indirectamente a ninguna persona, empresa o entidad de cualquier índole, la información proporcionada por <strong>KYP BIO INGEN SAC</strong> para la prestación del servicio a su cargo.</p>
                    <p><strong>EL CLIENTE</strong> se compromete y obliga a no reproducir, entregar o permitir que se entregue o que se acceda y/o use información a que se refiere el numeral precedente, salvo que exista autorización previa y por escrito del <strong>KYP BIO INGEN SAC</strong>.</p>
                    <p>La obligación de confidencialidad a que se refiere la presente cláusula tendrá una vigencia de (1) año calendario contados a partir de la suscripción del presente documento.</p>
                <?php } ?>
            </div>
        </div>

        <div class="new-page">
            <div class="data-compact">
                <?php if ($mayor_edad == 'No') { ?>
                    <p>La información y/o documentación que se produzca en la ejecución del presente Contrato será de propiedad exclusiva del <strong>KYP BIO INGEN SAC</strong>, encontrándose incluida dentro de los alcances de reserva y confidencialidad estipulados en la presente cláusula.</p>
                    <p><strong>EL REPRESENTANTE LEGAL</strong> declara que la violación de esta obligación facultará a <strong>KYP BIO INGEN SAC</strong> a resolver el presente contrato y a exigir judicial o extrajudicialmente una indemnización por los daños y perjuicios.</p>
                <?php } else { ?>
                    <p>La información y/o documentación que se produzca en la ejecución del presente Contrato será de propiedad exclusiva del <strong>KYP BIO INGEN SAC</strong>, encontrándose incluida dentro de los alcances de reserva y confidencialidad estipulados en la presente cláusula.</p>
                    <p><strong>EL CLIENTE</strong> declara que la violación de esta obligación facultará a <strong>KYP BIO INGEN SAC</strong> a resolver el presente contrato y a exigir judicial o extrajudicialmente una indemnización por los daños y perjuicios.</p>
                <?php } ?>
            </div>

            <div class="data-compact">
                <strong>NOVENA: GARANTÍA</strong>
                <?php if ($mayor_edad == 'No') { ?>
                    <p><strong>KYP BIO INGEN SAC</strong> se compromete a otorgar una garantía por el PRE ENCAJE de hasta 30 días calendarios desde su entrega sólo en caso de adaptabilidad y reducción del muñón; siendo que posterior a dicho plazo se dará paso a la elaboración del socket de fibra de vidrio para dar por finalizado el servicio contratado.</p>
                    <p>La no comunicación expresa de <strong>EL REPRESENTANTE LEGAL</strong> a <strong>KYP BIO INGEN SAC</strong> respecto al pre encaje conforme a la causal y plazo estipulado en el párrafo anterior implicará la renuncia a cualquier reclamo por parte de <strong>EL REPRESENTANTE LEGAL</strong> y su conformidad respecto al mismo.</p>
                    <p>Asimismo, al momento de tener el socket en fibra de carbono final si necesita cambios o uno nuevo deberé asumir el costo de este tanto como de un nuevo linner si fuera necesario.</p>
                    <p><strong>KYP BIO INGEN SAC</strong> otorgará el servicio de mantenimiento de hasta un (01) año respecto a la prótesis materia de contrato siempre y cuando la misma no haya sufrido ningún daño estructural que permita su normal funcionamiento por parte de <strong>EL REPRESENTANTE LEGAL</strong>.</p>
                <?php } else { ?>
                    <p><strong>KYP BIO INGEN SAC</strong> se compromete a otorgar una garantía por el PRE ENCAJE de hasta 30 días calendarios desde su entrega sólo en caso de adaptabilidad y reducción del muñón; siendo que posterior a dicho plazo se dará paso a la elaboración del socket de fibra de vidrio para dar por finalizado el servicio contratado.</p>
                    <p>La no comunicación expresa de <strong>EL CLIENTE</strong> a <strong>KYP BIO INGEN SAC</strong> respecto al pre encaje conforme a la causal y plazo estipulado en el párrafo anterior implicará la renuncia a cualquier reclamo por parte de <strong>EL CLIENTE</strong> y su conformidad respecto al mismo.</p>
                    <p>Asimismo, al momento de tener el socket en fibra de carbono final si necesita cambios o uno nuevo deberé asumir el costo de este tanto como de un nuevo linner si fuera necesario.</p>
                    <p><strong>KYP BIO INGEN SAC</strong> otorgará el servicio de mantenimiento de hasta un (01) año respecto a la prótesis materia de contrato siempre y cuando la misma no haya sufrido ningún daño estructural que permita su normal funcionamiento por parte de <strong>EL CLIENTE</strong>.</p>
                <?php } ?>
            </div>

            <div class="data-compact">
                <strong>DÉCIMA: DISPOSICIONES FINALES</strong>
                <p>Las partes declaran que el Contrato constituye el acuerdo y entendimiento íntegros a los que han llegado con relación al objeto materia del presente documento y que el Contrato sustituye todas las negociaciones y todos los acuerdos que hubieran sido celebrados previamente.</p>
                <p>Cualquier modificación o ampliación de los términos del presente Contrato deberá realizarse por escrito y con participación de las partes.</p>
                <p>En señal de conformidad, las partes suscriben el presente documento en dos (2) ejemplares originales en los mismos términos y con la misma validez, en la ciudad de <?= $sede ?> el <?= fecha_spanish($contract_date) ?>.</p>
            </div>

            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-content">
                            <img src="<?= base_url('assets/media/img/firma_digital.png') ?>" class="signature-img" alt="Firma KYP">
                            <hr class="signature-line">
                            <div class="signature-name">KYP BIO INGEN SAC</div>
                            <div>RUC: 20600880081</div>
                        </div>
                    </td>
                    <td>
                        <?php if ($mayor_edad == 'No') { ?>
                            <div class="signature-content">
                                <hr class="signature-line">
                                <div class="signature-name">EL REPRESENTANTE LEGAL</div>
                                <div>DNI: <?= $dni_apoderado ?></div>
                            </div>
                        <?php } else { ?>
                            <div class="signature-content">
                                <hr class="signature-line">
                                <div class="signature-name">EL CLIENTE</div>
                                <div>DNI: <?= $dni ?></div>
                            </div>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="new-page">
            <div class="data-compact">
                <div class="section-title">HOJA DE REQUERIMIENTOS:</div>

                <table style="width: 100%; padding-top: 10px; padding-bottom: 20px;">
                    <tr>
                        <td>Nombre del Paciente: <?= $paciente ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Peso del Paciente (kg.): <?= $peso ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de Servicio: <?= $trabajo ?></td>
                        <td></td>
                    </tr>
                </table>

                <strong>LISTA DE COMPONENTES COTIZADOS:</strong>

                <ul>
                    <?php foreach ($id_coti as $item) : ?>
                        <li><?= $item['cantidad'] . ' ' . $item['title'] . ': ' . $item['descripcion'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="data-compact">
                <strong>AJUSTES ADICIONALES:</strong>
                <p><?= $ajustes ?></p>
            </div>
        </div>

        <div class="new-page">
            <div class="data-compact">
                <div class="section-title">HOJA DE REQUERIMIENTOS:</div>

                <table style="width: 100%; padding-top: 10px; padding-bottom: 20px;">
                    <tr>
                        <td>Nombre del Paciente: <?= $paciente ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Peso del Paciente (kg.): <?= $peso ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de Servicio: <?= $trabajo ?></td>
                        <td></td>
                    </tr>
                </table>

                <strong>LISTA DE COMPONENTES COTIZADOS:</strong>

                <ul>
                    <?php foreach ($id_coti as $item) : ?>
                        <li><?= $item['cantidad'] . ' ' . $item['title'] . ': ' . $item['descripcion'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="data-compact">
                <strong>AJUSTES ADICIONALES:</strong>
                <p><?= $ajustes ?></p>
            </div>
        </div>

        <div class="new-page">
            <div class="header-compact">
                <h4>CONSENTIMIENTO INFORMADO PARA INICIO DE PROTETIZACIÓN</h4>
            </div>

            <div class="data-compact">
                <?php if ($mayor_edad == 'No') { ?>

                    <p>Yo, <strong><?= $nombres_apoderado ?></strong>, identificado con DNI <?= $dni_apoderado ?> en calidad de <strong><?= $vinculo_apoderado ?></strong> y representante legal de mi hijo(a) <strong><?= $paciente ?></strong>, menor de edad, identificado(a) con DNI <?= $dni ?>, en pleno uso de mis facultades y entendiendo plenamente la naturaleza de este consentimiento, otorgo mi consentimiento informado para que el personal profesional capacitado de la empresa <strong>KYP BIO INGEN S.A.C</strong> realice el contacto físico necesario durante el tratamiento y cuidado de la condición de amputación de mi hijo(a).</p>
                <?php } else { ?>
                    <p>Yo, <strong><?= $paciente ?></strong>, identificado con DNI <?= $dni ?> en pleno uso de mis facultades mentales y entendiendo plenamente la naturaleza de este consentimiento, otorgo mi consentimiento informado para que el personal profesional capacitado de la empresa <strong>KYP BIO INGEN S.A.C</strong> realicen el contacto físico necesario durante el tratamiento y cuidado de mi condición de amputación.</p>
                <?php } ?>

                <?php if ($mayor_edad == 'No') { ?>
                    <p>Entiendo que el contacto físico puede ser necesario para realizar una evaluación adecuada, proporcionar tratamiento PROTÉSICO, llevar a cabo procedimientos terapéuticos y mejorar el bienestar general de mi menor hijo(a). Comprendo que el contacto físico puede incluir, pero no se limita a, la inspección visual, la palpación, la movilización de extremidades y la aplicación de dispositivos médicos y ortopédicos.</p>
                <?php } else { ?>
                    <p>Entiendo que el contacto físico puede ser necesario para realizar una evaluación adecuada, proporcionar tratamiento PROTÉSICO, llevar a cabo procedimientos terapéuticos y mejorar mi bienestar general como persona amputada. Comprendo que el contacto físico puede incluir, pero no se limita a, la inspección visual, la palpación, la movilización de extremidades y la aplicación de dispositivos médicos y ortopédicos.</p>
                <?php } ?>

                <p>Además, se me ha proporcionado información detallada sobre los procedimientos específicos que implicarán contacto físico, así como los riesgos y beneficios asociados. Así mismo me explicaron el uso de la media compresiva (LINNER), su limpieza, manera de colocarla y que el material del cual está fabricado es silicona americana hipoalergénica y si podría producir algún tipo de enrojecimiento es por el tipo de piel que el usuario presenta (sensibilidad, alergia u otro factor) y es de mi completa responsabilidad.</p>

                <?php if ($mayor_edad == 'No') { ?>
                    <p>Entiendo el hecho de que el muñón de mi menor hijo(a) varíe de volumen teniendo en cuenta, el peso, la alimentación, enfermedades de base, etc. que requerirán cambios de socket. Asimismo, al momento de tener el <strong>SOCKET EN FIBRA DE CARBONO FINAL</strong> si su menor hijo(a) necesita cambios o uno nuevo <strong>DEBERÉ ASUMIR EL COSTO DE ESTE TANTO COMO DE UN NUEVO LINNER SI FUERA NECESARIO.</strong> He tenido la oportunidad de hacer preguntas y todas ellas han sido respondidas satisfactoriamente.</p>
                <?php } else { ?>
                    <p>Entiendo el hecho de que mi muñón varíe de volumen teniendo en cuenta, el peso, la alimentación, enfermedades de base, etc. que requerirán cambios de socket. Asimismo, al momento de tener el <strong>SOCKET EN FIBRA DE CARBONO FINAL</strong> si necesita cambios o uno nuevo <strong>DEBERÉ ASUMIR EL COSTO DE ESTE TANTO COMO DE UN NUEVO LINNER SI FUERA NECESARIO.</strong> He tenido la oportunidad de hacer preguntas y todas ellas han sido respondidas satisfactoriamente.</p>
                <?php } ?>

                <?php if ($mayor_edad == 'No') { ?>

                    <p>Declaro que este consentimiento ha sido otorgado de manera voluntaria y sin ninguna forma de coerción o presión. Soy plenamente consciente de las implicaciones y consecuencias del contacto físico y autorizo expresamente a los profesionales de KYP BIO INGEN S.A.C a realizar en mi hijo(a) los procedimientos descritos. Además, autorizo que toda la información relacionada con este contacto físico y tratamiento sea documentada y almacenada de forma segura en el historial médico de mi hijo(a).</p>
                <?php } else { ?>
                    <p>Declaro que este consentimiento ha sido otorgado de manera voluntaria y sin ninguna forma de coerción o presión. Soy plenamente consciente de las implicaciones y consecuencias del contacto físico y autorizo a los profesionales capacitados de la empresa KYP BIO INGEN S.A.C a llevar a cabo dichos procedimientos en mi persona. Además, doy mi consentimiento para que se documente y almacene de manera segura cualquier información relacionada con el contacto físico en mi historial médico.</p>
                <?php } ?>

                <div style="margin-top: 90px; text-align: center;">
                    <hr class="signature-line">
                    <div style="font-size: 9.5pt;">Firma del Paciente/Representante Legal</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>