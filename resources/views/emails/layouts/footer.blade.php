
        <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
            <tr style="border-collapse:collapse">
                <td align="center" style="padding:0;Margin:0">
                    <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FEF5E4;width:600px">
                        <tr style="border-collapse:collapse">
                            <td align="left" style="padding:20px;Margin:0">
                                <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
                                <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                    <tr style="border-collapse:collapse">
                                        <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-p0l es-m-txt-c" align="left" style="padding:0;Margin:0;font-size:0px">
                                                           @if($logo != null)
                                                                            <img loading="lazy"  src="{{ uploaded_asset($logo) }}" alt="Petshop logo" title="Petshop logo" width="118" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                                          @else
                                                                            <img loading="lazy"  src="{{ static_asset('assets/img/logo.png') }}" alt="Petshop logo" title="Petshop logo" width="118" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                            @endif
                                                      </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">{{get_setting("contact_address")}}</p>
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:5px">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px"><a target="_blank" href="tel:{{get_setting("contact_phone")}}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:14px">{{get_setting("contact_phone")}}</a><br>
                                                            <a target="_blank" href="mailto:{{get_setting("contact_email")}}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:14px">{{get_setting("contact_email")}}</a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td><td style="width:20px"></td><td style="width:362px" valign="top"><![endif]-->
                                <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td align="left" style="padding:0;Margin:0;width:362px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-txt-c" align="right" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:30px;color:#333333;font-size:20px">{{translate("informations")}}</p>
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td class="es-m-txt-c" align="right" style="padding:0;Margin:0">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">{{translate("You receive this email because you visited our website, asked us about our regular newsletter, or created a special request from our website")}}</p>
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr style="border-collapse:collapse">
                <td align="center" style="padding:0;Margin:0">
                    <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center">
                        <tr style="border-collapse:collapse">
                            <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                            <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;display:none"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </td>
        </tr>
        </table>
    </div>
</body>

</html>
