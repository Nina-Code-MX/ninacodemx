<?php
\Carbon\Carbon::setLocale('es');

return [
    'hero' => [
        'p' => 'Presupuestos a la medida de tu negocio.'
    ],
    'h2' => 'Solicita una cotización',
    'p' => [
        'En Nina Code nos especializamos en proveer soluciones a la medida para cada negocio, ya sea que necesites una página web, una aplicación móvil, o un sistema de gestión empresarial, nosotros te ayudamos a lograrlo.',
        'Si estás interesado en alguno de nuestros servicios, o tienes alguna duda, no dudes en contactarnos.'
    ],
    'form' => [
        'info' => 'Al enviar este formulario aceptas nuestra <a class="text-secondary" href=":privacy" target="_blank">Política de Privacidad</a> y <a class="text-secondary" href=":terms" target="_blank">Términos de Servicio</a>. Una vez recibamos tu solicitud, nos pondremos en contacto contigo lo antes posible.',
        'submit' => 'Enviar',
        'title' => 'Un proyecto a un botón de distancia',
    ],
    'mail' => [
        'subject' => 'Solicitud de cotización: :service',
        'content' => '<div style="background-color:rgb(236,236,236);font-size:0.85rem;font-family:Helvetica,Arial,sans-serif;margin:0px;text-align:center;padding:0px;width:100%">
            <div style="margin:0px auto;max-width:620px;width:100%">
                <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                    <thead>
                        <tr>
                            <th bgcolor="#ececec" align="left">
                                <div style="padding:0.25rem;font-weight:normal">
                                #<span style="font-size:0.85rem;text-align:center">SLCTD-</span><span style="font-size:0.85rem;text-align:center">Cotización</span></div>
                            </th>
                            <th bgcolor="#ececec" align="right">
                                <div style="padding:0.25rem;font-weight:normal">' . \Carbon\Carbon::now()->toIso8601String() . '</div>
                            </th>
                        </tr>
                        <tr>
                            <th color="#ffffff" bgcolor="#4cb5ff" align="center" colspan="2">
                                <div style="color:rgb(255,255,255);padding:1rem 0.5rem;font-weight:normal">
                                    <img src="https://www.ninacode.mx/images/logo-ninacode-mx-1024.png" height="100" width="100">
                                    <br>
                                    <br>
                                    <h1 style="padding:0px;margin:0px;font-weight:500;font-size:1.5rem;line-height:24px">Solcitid de Cotización</h1>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="left" bgcolor="#ffffff" color="#445566" colspan="2">
                                <div style="font-size:1rem;padding:1rem;line-height:1.25rem">
                                    <strong>Hola :full_name,</strong>
                                    <p>Gracias por su interés en :service, recibimos su solicitud y pronto nos comunicaremos con usted.</p>
                                    <p style="background:#cccccc;font-style:italic;padding:1rem;color:#707070;font-size:0.80rem;">... ":message"...</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#ffffff" color="#445566" colspan="2">
                                <div style="border-top:1px solid rgb(236,236,236);color:rgb(68,85,102);font-size:0.85rem;padding:1rem">
                                    <i>Desarrollo web / Infraestructura / Diseño / Marketing / SEO & SEM</i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#f3f3f3" color="#888888" valign="top" width="50%">
                                <div style="color:rgb(136,136,136);font-size:0.85rem;padding:0.5rem 1rem">
                                    <a href="https://www.ninacode.mx/es/" target="_blank">www.ninacode.mx/es/</a>
                                </div>
                            </td>
                            <td align="right" bgcolor="#f3f3f3" color="#888888" valign="top" width="50%">
                                <div style="color:rgb(136,136,136);font-size:0.85rem;padding:0.5rem 1rem">
                                    <a href="mailto:contacto@ninacode.mx" target="_blank">contacto@ninacode.mx</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#f3f3f3" color="#888888" valign="top" width="50%">
                                <div style="color:rgb(136,136,136);font-size:0.85rem;padding:0.5rem 1rem">
                                    <strong>Puerto Vallarta</strong>
                                    <br>
                                    <p>Próximamente, nueva ubicación.</p>
                                    <br>
                                    <br>
                                    <a href="tel:+523222100264" target="_blank">+52 322 210 0264</a>
                                </div>
                            </td>
                            <td align="right" bgcolor="#f3f3f3" color="#888888" valign="top" width="50%">
                                <div style="color:rgb(136,136,136);font-size:0.85rem;padding:0.5rem 1rem">
                                    <strong>Guadalajara</strong>
                                    <br>
                                    <p>Castilla la Mancha #68 - 130, <br>Col. Real de Valdepeñas, <br>Zapopan, Jalisco.</p>
                                    <a href="tel:+523339025911" target="_blank">+52 33 3902 5911</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center" bgcolor="#ececec" color="#333333" colspan="2">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:1rem">
                                    <ul style="margin:0px;padding:0px;list-style:none">
                                        <li style="display:inline-block;margin-right:10px">
                                            <a href="https://wa.me/523339025911?text=Hola!%20Vi%20su%20sitio%20en%20internet,%20estoy%20interesado%20en%20sus%20servicios.%20Porfavor%20contacten%20me." target="_blank"><img src="' . asset('images/icons/whatsapp.png') . '" width="20" alt="WhatsApp" /></a>
                                        </li>
                                        <li style="display:inline-block;margin-right:10px">
                                            <a href="https://www.facebook.com/ninacodemx/" target="_blank"><img src="' . asset('images/icons/facebook.png') . '" width="20" alt="Facebook" /></a>
                                        </li>
                                        <li style="display:inline-block;margin-right:10px">
                                            <a href="https://twitter.com/ninacodemx/" target="_blank"><img src="' . asset('images/icons/x.png') . '" width="20" alt="X" /></a>
                                        </li>
                                        <li style="display:inline-block;margin-right:10px">
                                            <a href="https://www.instagram.com/ninacodemx/" target="_blank"><img src="' . asset('images/icons/instagram.png') . '" width="20" alt="Instagram" /></a>
                                        </li>
                                        <li style="display:inline-block;margin-right:10px">
                                            <a href="https://www.youtube.com/channel/UCoaWaOoAMzyf99D192HyMBQ/" target="_blank"><img src="' . asset('images/icons/youtube.png') . '" width="20" alt="YoutTube" /></a>
                                        </li>
                                        <li style="display:inline-block;margin-right:0px">
                                            <a href="https://www.linkedin.com/company/ninacode/" target="_blank"><img src="' . asset('images/icons/linkedin.png') . '" width="20" alt="LinkedIn" /></a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ececec" color="#333333" colspan="2">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem">
                                    Iconos por <a target="_blank" href="https://icons8.com">Icons8</a>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ececec" color="#333333" colspan="2">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem">
                                    &nbsp;
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th align="cemter" bgcolor="#ececec" color="#333333">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem">
                                    <a href="https://www.ninacode.mx/es/terminos-y-condiciones" style="color:rgb(51,51,51);text-decoration-line:none" target="_blank">Terminos y Condiciones</a>
                                </div>
                            </th>
                            <th align="cemter" bgcolor="#ececec" color="#333333">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem">
                                    <a href="https://www.ninacode.mx/es/aviso-de-privacidad" style="color:rgb(51,51,51);text-decoration-line:none" target="_blank">Políticas de Privacidad</a>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <p>&nbsp;</p>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <b>Aviso de Comunicación:</b>&nbsp;Este correo es autoadministrado, y no está ligado a un individuo en particular, para una mejor experiencia y pronta respuesta, identifiquese en el cuerpo o asunto del correo con su nombre, marca o empresa.
                    </div>
                </div>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <br>
                    </div>
                </div>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <b>Aviso de Confidencialidad:</b>&nbsp;Este mensaje, incluyendo cualquier archivo adjunto, es para uso exclusivo del/los destinatario/s y puede contener información confidencial y/o privilegiada. Si usted no es uno de los destinatarios legítimos, por favor contacte al remitente y proceda a la supresión total del mismo. Está prohibido utilizar copiar, revelar, o tomar ninguna acción basada en la información contenida en el mismo sin autorización expresa, en virtud de que la misma es de carácter CONFIDENCIAL sometida a secreto profesional y cuya divulgación está prohibida por la Ley Federal de Protección de Datos Personales en Posesión de Particulares, y se encuentra sujeta a las sanciones establecidas; asimismo, se hace de su conocimiento que toda la Información aquí contenida, sólo tiene propósitos informativos y no reflejan la voluntad de Nina Code, hasta en tanto no sea suscrita de forma autógrafa por un representante legal con facultades suficientes para su obligación.
                    </div>
                </div>
            <div>
        </div>'
    ]
];
