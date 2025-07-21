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
                <p>Conste por el presente documento, el Contrato de Locación de Servicios que celebran de una parte <strong>KYP BIO INGEN SAC </strong> con RUC. N° 20600880081 domiciliado en la Calle Max Palma Arrué N° 119 distrito de Los Olivos - Lima - Lima, representado por su Gerente General Sr. <strong>PERCY GIOVANY MAGUIÑA VARGAS</strong>, identificado con DNI N° 45077305 según poder inscrito en el Asiento N° A0001 de la Partida Electrónica N° 13526119 del Registro de Personas Jurídicas de la Oficina Registral de Lima, a quien en adelante se denominará <strong>KYP BIO INGEN SAC</strong>, y de la otra parte <strong><?= $nombres_apoderado ?></strong> identificado con DNI N° <?= $dni_apoderado ?>, en su calidad de REPRESENTANTE LEGAL del menor <strong><?= $paciente ?></strong> identificado con DNI N° <?= $dni ?>, a quien en adelante se le denominará <strong>EL REPRESENTANTE LEGAL</strong> y en conjunto con <strong>KYP BIO INGEN SAC</strong> se les denominará "Las Partes", en los términos y condiciones siguientes:</p>
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
                <p>KYP BIO INGEN SAC, en virtud al presente Contrato, se obliga a: </p>
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
                <p>La información y/o documentación que se produzca en la ejecución del presente Contrato será de propiedad exclusiva del KYP BIO INGEN SAC, encontrándose incluida dentro de los alcances de reserva y confidencialidad estipulados en la presente cláusula.</p>
                <p>EL CLIENTE declara que la violación de esta obligación facultará a KYP BIO INGEN SAC a resolver el presente contrato y a exigir judicial o extrajudicialmente una indemnización por los daños y perjuicios.</p>
            </div>

            <div class="data-compact">
                <strong>NOVENA: PROCESO DE ELABORACIÓN, CARACTERISTICAS, APROBACION, MULTAS, INTERVENCIONES QUIRUJICAS, PUNTUALIDAD Y MANTENIMIENTO</strong>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>1. MANOS PARCIAL Y MANOS COMPLETAS</strong>
                    <ul>
                        <li>De 80 a 90 días hábiles para la entrega de la prótesis.</li>
                        <li>Como mínimo 2 a 3 visitas para la prueba de encaje.</li>
                        <li>Si en caso el paciente sea de provinicia se le notifica o se les informa respecto a las visitas que son como mínimo 2, estas visitas serán flexibles respecto al paciente por el viaje.</li>
                        <li>Si en todo caso el paciente no pueda quedarse para el pintado se programara otra cita para dicha labor.</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>2. DEDOS (FALANGE PARCIAL O TOTAL CON MEMBRANA)</strong>
                    <ul>
                        <li>De 40 a 50 días hábiles para la entrega de la prótesis.</li>
                        <li>Las visitas se harán como mínimo de 1 a 2 oportunidades para la prueba de succión.</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>3. MICROTIA TIPO 1 Y 2 O TIPO 3 Y 4</strong>
                    <ul>
                        <li>De 30 a 40 días hábiles para la entrega de la prótesis.</li>
                        <li>Las visitas se harán como mínimo de 1 a 2 oportunidades para la prueba de encaje.</li>
                        <li>Las esculturas realizadas tendrán como mínimo 1 visita para la conformidad de esta, las modificaciones pasado la firma de conformidad de escultura ya no se realizarán</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>4. NARIZ PARCIAL O TOTAL</strong>
                    <ul>
                        <li>De 50 a 60 días hábiles para la entrega de la prótesis.</li>
                        <li>Las visitas se harán como mínimo de 2 a 3 oportunidades para la prueba de adherencia y similitud estético, si en todo caso tanto como la adherencia y similitud quede conforme se hará el pintado..</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>5. PIES MITONES, DEDOS INDIVIDUAL Y PIES COMPLETOS</strong>
                    <ul>
                        <li>De 30 a 40 días por dedo, de 50 a 60 días para los mitones de pie y pies completo de 80 a 90 días hábiles para la entrega total.</li>
                        <li>Para las prótesis de falange individual de pies las visitas se harám como mínimo de 2 a 4 oportunidades para la prueba de succión y similitud estético, no obstante, se hará pruebas de marcha para ver como la prótesis se adapta al pie, si la prótesis tiene la aprobación tanto como el paciente y el supervisor la prótesis procederá a pintarse.</li>
                        <li>En casos de mitones de pie se harán de 3 a 4 como mínimo y máximo de visitas para poder realizar las pruebas de encaje y escultura (medidas y dimensiones), la prótesis sienda aprobada por el paciente y el supervisor se procederá hacer el pintado.</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="new-page">
            <div class="data-compact">
                <ul>
                    <li>En caso de pies completos se citará de 3 a 4 veces como mínimo y máximo de visitas para poder realizar las pruebas de encaje y escultura (medidas y dimensiones), la prótesis sienda aprobada por el paciente y el supervisor se procederá hacer el pintado.</li>
                </ul>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>Características de las Prótesis:</strong>
                    <ul>
                        <li>Las prótesis presentan un alto grado de realiasmo en cuanto al color y modelado dependiendo el grado de complejidad de la zona a tratar.
                        <li>Se recomienda que el paciente mantenga una tonalidad pareja para lograr un resultado más realista y armonioso con otras partes del cuerpo.</li>
                        </li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>Aprobación en Fase II y Multas:</strong>
                    <ul>
                        <li>Una vez aprobada la Fase II (escultura), no se admiten modificaciones en la FASE IV, y realizar cambios conlleva una multa.</li>
                        <li>En caso de microtias, se deja una menbrana para mayor adhesión, pero su reducción corre por cuenta del paciente, eximiendo a la empresa de responsabilidad por pérdida de firmeza.</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>Intervención Quirúrgica y Puntualidad:</strong>
                    <ul>
                        <li>El paciente debe informar cualquier intervención quirúrjica duarnte la elaboración, evitando multas y retrasos.</li>
                        <li>A partir de la FASE IV, la empresa no asume responsabilidad por variaciones en medidas no informadas previamente.</li>
                        <li>Se insta a la puntualidad. Se recomienda a los pacientes de provincia llegar con anticipación.</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>Cuidados y Mentenimientos:</strong>
                    <ul>
                        <li>Se aconseja aplicar aceite de bebe o vaselina en el muñón según sea necesario para facilitar el deslizamiento de la prótesis.</li>
                        <li>La extracción debe hacerse con cuidado, evitando fuerza excesiva, fricción de todo tiempo para prevenir roturas irreparables.</li>
                        <li>Se detallan condiciones de resistencia y debilidades del material de la prótesis, indicando precauciones para su uso adecuado.</li>
                    </ul>
                </div>

                <div class="data-compact" style="margin-top: 10px;">
                    <strong>Reparaciones y Consideraciones Finales:</strong>
                    <ul>
                        <li>Cualquier corte en la prótesis debe ser atendido en las instalaciones de la empresa para evitar riesgos. Se desaconseja la reparación por cuenta propia.</li>
                        <li>Se proporcionan recomendaciones específicas, como evitar la inmersión en sales marinas, cargar objetos pesados o realizar flexiones bruscas.</li>
                    </ul>
                </div>


            </div>


        </div>

        <div class="new-page">
            <div class="data-compact">
                <strong>DÉCIMA: DISPOSICIONES FINALES</strong>
                <p>Las partes declaran que el Contrato constituye el acuerdo y entendimiento íntegros a los que han llegado con relación al objeto materia del presente documento y que el Contrato sustituye todas las negociaciones y todos los acuerdos que hubieran sido celebrados previamente.</p>
                <p>Cualquier modificación o ampliación de los términos del presente Contrato deberá realizarse por escrito y con participación de las partes.</p>
                <p>En señal de conformidad, las partes suscriben el presente documento en dos (2) ejemplares originales en los mismos términos y con la misma validez, en la ciudad de <?= $sede ?> el <?= fecha_spanish($contract_date) ?>.</p>
            </div>

            <div class="data-compact">
                <strong>ONCEAVA: RESOLUCIÓN DEL CONTRATO</strong>
                <p>KYP BIOINGEN SAC se encuentra facultado a resolver el presente Contrato, durante la vigencia del mismo, bastando para ello que curse una comunicación simple con cinco (05) días de anticipación a la fecha en que solicita opere la resolución, en caso se dé el incumplimiento a las obligaciones estipuladas en el presente Contrato y/o en la hoja de requerimiento del servicio por parte de EL CLIENTE.</p>
            </div>

            <div class="data-compact">
                <strong>ONCEAVA PRIMERA: NOTIFICACIONES EN DOMICILIO Y/O CORREO ELECTRÓNICO</strong>
                <p>Para la validez de todas las comunicaciones y notificaciones entre las partes, con motivo de la ejecución de este contrato, estas se realizarán a través de sus domicilios y/o correos electrónicos, señalados en la introducción de este documento. La variación de domicilio de cualquiera de las partes surtirá efecto desde la fecha de comunicación de dicho cambio a la otra parte, por cualquier medio escrito.</p>
            </div>

            <div class="data-compact">
                <strong>ONCEAVA SEGUNDA: COMPETENCIA Y LEGISLACIÓN</strong>
                <p>LAS PARTES acuerdan que para efectos de cualquier controversia que se genere con motivo de la celebración y/o ejecución de este contrato, serán resueltas de manera definitiva mediante ARBITRAJE.</p>
            </div>

            <div class="data-compact">
                <strong>ONCEAVA TERCERA: CLAÚSULA DE NO DEVOLUCIÓN</strong>
                <p>Las "PARTES" declaran en el contrato que la prótesis/ortesis será diseñada y fabricada de acuerdo con sus necesidades y especificaciones técnicas, y que la entrega y aceptación de la misma representan el cumplimiento por parte de la empresa de prótesis/ortesis de sus obligaciones contractuales. Por lo tanto, en el caso de que el paciente decida voluntariamente no utilizar la prótesis/ortesis una vez entregada y aceptada, ya sea por razones personales, médicas u otras, el paciente comprende y acepta que no tendrá derecho a solicitar un reembolso o devolución del dinero pagado por la prótesis/ortesis. La empresa de prótesis/ortesis no será responsable por la no utilización de la prótesis/ortesis por parte del paciente ni estará obligada a realizar ningún reembolso o devolución de dinero en tales circunstancias.</p>
            </div>

            <div class="data-compact">
                <strong>ONCEAVA CUARTA: CLAÚSULA DE PENALIDAD Y REPROGRAMACIÓN DE ENTREGA</strong>
                <p>En caso de que la parte contratante no asista a la programación de entrega final, se aplicará una penalidad equivalente al 10% del valor total del contrato. Si la parte contratante desea reprogramar la entrega, deberá hacerlo dentro de la misma semana de la fecha original de entrega programada.</p>
                <p>En caso de no poder realizar la reprogramación dentro de la semana indicada, la nueva fecha de entrega se fijará en un plazo no menor a 30 días calendario a partir de la fecha de la reprogramación fallida. Cualquier costo adicional generado por esta reprogramación será responsabilidad exclusiva de la parte contratante.</p>
            </div>


        </div>

        <div class="new-page">
            <div class="data-compact">
                <strong>ONCEAVA QUINTA: DISPOSICIONES FINALES</strong>
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
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name">EL CLIENTE</div>
                            <div>DNI: <?= $dni ?></div>
                        </div>
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
                <p>Yo, <strong><?= $paciente ?></strong>, identificado con DNI <?= $dni ?> en pleno uso de mis facultades mentales y entendiendo plenamente la naturaleza de este consentimiento, otorgo mi consentimiento informado para que el personal profesional capacitado de la empresa KYP BIO INGEN S.A.C realicen el contacto físico necesario durante el tratamiento y cuidado de mi condición de amputación.</p>

                <p>Entiendo que el contacto físico puede ser necesario para realizar una evaluación adecuada, proporcionar tratamiento PROTÉSICO, llevar a cabo procedimientos terapéuticos y mejorar mi bienestar general como persona amputada. Comprendo que el contacto físico puede incluir, pero no se limita a, la inspección visual, la palpación, la movilización de extremidades y la aplicación de dispositivos médicos y ortopédicos.</p>

                <p>Además, se me ha proporcionado información detallada sobre los procedimientos específicos que implicarán contacto físico, así como los riesgos y beneficios asociados. Así mismo me explicaron el uso de la prótesis, su limpieza, manera de colocarla, el material del cual está fabricado (SILICONA MÉDICA) y que si produce algún tipo de enrojecimiento es por el tipo de piel que el usuario presenta (sensibilidad, alergia u otro); entendiendo que esto último es de mi completa responsabilidad.</p>

                <p>También acepto y me comprometo a asistir puntualmente a mis citas y controles programados; de no ser así, me comprometo a comunicarme con antelación mínima de una hora para reprogramar dicha cita a disponibilidad de la agenda que KYP BIO INGEN S.A.C tenga en ese momento</p>

                <p>Declaro que este consentimiento ha sido otorgado de manera voluntaria y sin ninguna forma de coerción o presión. Soy plenamente consciente de las implicaciones y consecuencias del contacto físico y autorizo a los profesionales capacitados de la empresa KYP BIO INGEN S.A.C a llevar a cabo dichos procedimientos en mi persona. Además, doy mi consentimiento para que se documente y almacene de manera segura cualquier información</p>

                <div style="margin-top: 90px; text-align: center;">
                    <hr class="signature-line">
                    <div style="font-size: 9.5pt;">Firma del Paciente/Representante Legal</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>