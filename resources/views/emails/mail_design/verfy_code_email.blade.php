@extends('emails.layouts.master')

@section('content')
    <table class="es-content" cellspacing="0" cellpadding="0" align="center"
        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
        <tr style="border-collapse:collapse">
            <td align="center" style="padding:0;Margin:0">
                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"
                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr style="border-collapse:collapse">
                        <td align="left"
                            style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr style="border-collapse:collapse">
                                    <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                        <table
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:0px"
                                            width="100%" cellspacing="0" cellpadding="0" role="presentation">
                                            <tr style="border-collapse:collapse">
                                                <td align="center" style="padding:0;Margin:0;position:relative"><img
                                                        class="adapt-img"
                                                        src="https://kuuepr.stripocdn.email/content/guids/bannerImgGuid/images/image16420007348291169.png"
                                                        alt title width="560"
                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="center" style="padding:0;Margin:0">
                                                    <h1
                                                        style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Cairo;font-size:30px;font-style:normal;font-weight:normal;color:#12aca6">
                                                        {{ translate('welcome') }}</h1>
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">

                                                <td align="center"
                                                    style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px">
                                                    <p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;">
                                                        {{ translate('hello') . ' ' . $array['sender'] . ' ' . translate('Thanks for joining us! You are now on the list to be the first to hear about our new collections and offers') }}
                                                    </p>
                                                </td>



                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="center"
                                                    style="padding:0;Margin:0;padding-bottom:10px;padding-top:15px"><span
                                                        class="es-button-border"
                                                        style="border-style:solid;border-color:#2cb543;background:#f04e22;border-width:0px;display:inline-block;border-radius:5px;width:auto;border-top-width:0px;border-bottom-width:0px">
                                                        {{-- <a href="{{ $array['link'] }}" class="es-button" style="mso-style-priority:100 !important;text-decoration:underline;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;border-style:solid;border-color:#f04e22;border-width:10px 20px 10px 20px;display:inline-block;background:#f04e22;border-radius:5px;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;border-top-width:10px;border-bottom-width:10px">{{translate("Go To The Store To Verfy")}}</a></span></td> --}}
                                                        <button class="es-button"
                                                            style="mso-style-priority:100 !important;text-decoration:underline;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;border-style:solid;border-color:#f04e22;border-width:10px 20px 10px 20px;display:inline-block;background:#f04e22;border-radius:5px;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;border-top-width:10px;border-bottom-width:10px"
                                                            disabled>{{ $array['content'] }}</button></span></td>
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
@endsection
