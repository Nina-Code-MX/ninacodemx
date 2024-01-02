<?php
\Carbon\Carbon::setLocale('en');

return [
    'hero' => [
        'p' => 'Budgets tailored to your business.'
    ],
    'h2' => 'Request a quote',
    'p' => [
        'At Nina Code we specialize in providing solutions tailored to each business, whether you need a website, a mobile application, or an enterprise management system, we help you achieve it.',
        'If you are interested in any of our services, or have any questions, do not hesitate to contact us.'
    ],
    'form' => [
        'info' => 'By submitting this form you agree to our <a class="text-secondary" href=":privacy" target="_blank">Privacy Policy</a> and <a class="text-secondary" href=":terms" target="_blank">Terms of Service</a>. Once we receive your request, we will contact you as soon as possible.',
        'submit' => 'Send',
        'title' => 'A project a button away',
    ],
    'mail' => [
        'subject' => 'New quote request: :service',
        'content' => '<div style="background-color:rgb(236,236,236);font-size:0.85rem;font-family:Helvetica,Arial,sans-serif;margin:0px;text-align:center;padding:0px;width:100%">
            <div style="margin:0px auto;max-width:620px;width:100%">
                <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                    <thead>
                        <tr>
                            <th bgcolor="#ececec" align="left">
                                <div style="padding:0.25rem;font-weight:normal">
                                #<span style="font-size:0.85rem;text-align:center">SLCTD-</span><span style="font-size:0.85rem;text-align:center">Quote</span></div>
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
                                    <h1 style="padding:0px;margin:0px;font-weight:500;font-size:1.5rem;line-height:24px">Request for quotation</h1>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="left" bgcolor="#ffffff" color="#445566" colspan="2">
                                <div style="font-size:1rem;padding:1rem;line-height:1.25rem">
                                    <strong>Hello :full_name,</strong>
                                    <p>Thank you for your interest in :service, we got your request an soon we are going to be in touch with you.</p>
                                    <p style="background:#cccccc;font-style:italic;padding:1rem;color:#707070;font-size:0.80rem;">... ":message"...</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#ffffff" color="#445566" colspan="2">
                                <div style="border-top:1px solid rgb(236,236,236);color:rgb(68,85,102);font-size:0.85rem;padding:1rem">
                                    <i>Web development / Infraestructure / Design / Marketing / SEO &amp; SEM</i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#f3f3f3" color="#888888" valign="top" width="50%">
                                <div style="color:rgb(136,136,136);font-size:0.85rem;padding:0.5rem 1rem">
                                    <a href="https://www.ninacode.mx/en/" target="_blank">www.ninacode.mx/en/</a>
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
                                    <p>Coming soon, new location.</p>
                                    <br>
                                    <a href="tel:+523222100264" target="_blank">+52 322 210 0264</a><br>
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
                                    Icons by <a target="_blank" href="https://icons8.com">Icons8</a>
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
                                    <a href="https://www.ninacode.mx/en/terms-and-conditions" style="color:rgb(51,51,51);text-decoration-line:none" target="_blank">Terms and Conditions</a>
                                </div>
                            </th>
                            <th align="cemter" bgcolor="#ececec" color="#333333">
                                <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem">
                                    <a href="https://www.ninacode.mx/en/privacy-policy" style="color:rgb(51,51,51);text-decoration-line:none" target="_blank">Privacy Policy</a>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <p>&nbsp;</p>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <b>Communication Notice:</b>&nbsp;This email is self-administered, and is not linked to a particular individual. For a better experience and prompt response, identify yourself in the body or subject of the email with your name, brand or company.
                    </div>
                </div>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <br>
                    </div>
                </div>
                <div style="margin:0px auto;max-width:620px;width:100%">
                    <div style="color:rgb(51,51,51);font-size:0.75rem;padding:0px 0.70rem;text-align:left;">
                        <b>Notice of confidentiality:</b>&nbsp;This message, including any attachments, is for the exclusive use of the recipient(s) and may contain confidential and/or privileged information. If you are not one of the legitimate recipients, please contact the sender and delete it completely. It is prohibited to use, copy, reveal, or take any action based on the information contained therein without express authorization, since it is CONFIDENTIAL in nature subject to professional secrecy and whose disclosure is prohibited by the Federal Data Protection Law. Persons in Possession of Private Parties, and is subject to the established sanctions; Likewise, you are informed that all the Information contained herein is for informational purposes only and does not reflect the will of Nina Code, until it is signed by a legal representative with sufficient powers to fulfill its obligation.
                    </div>
                </div>
            <div>
        </div>'
    ]
];
