

@extends('emails.layouts.master')
@section("content")

        <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr style="border-collapse:collapse">
                <td align="center" style="padding:0;Margin:0">
                    <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                        <tr style="border-collapse:collapse">
                            <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                            <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:0px" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;position:relative"><img class="adapt-img" src="https://kuuepr.stripocdn.email/content/guids/bannerImgGuid/images/image1641892210247167.png" alt title width="560" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0">
                                                        <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Cairo;font-size:30px;font-style:normal;font-weight:normal;color:#12aca6">{{translate("Thanks For Your Order")}}</h1>
                                                    </td>
                                                </tr>

                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">{{translate("You will receive an email when your items have been shipped. If you have any questions")}} ، <br>{{translate("call us")}} : {{get_setting("contact_phone")}}</p>
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:15px"><span class="es-button-border" style="border-style:solid;border-color:#2cb543;background:#f04e22;border-width:0px;display:inline-block;border-radius:5px;width:auto;border-top-width:0px;border-bottom-width:0px"><a href="{{route("purchase_history.index")}}" class="es-button" style="mso-style-priority:100 !important;text-decoration:underline;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;border-style:solid;border-color:#f04e22;border-width:10px 20px 10px 20px;display:inline-block;background:#f04e22;border-radius:5px;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;border-top-width:10px;border-bottom-width:10px">{{translate("show order")}}</a></span></td>
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
        <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr style="border-collapse:collapse">
                <td align="center" style="padding:0;Margin:0">
                    <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                        <tr style="border-collapse:collapse">
                            <td align="left" style="Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:30px">
                                <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:280px" valign="top"><![endif]-->
                                <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                    <tr style="border-collapse:collapse">
                                        <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:280px">
                                            <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#e8eaee;border-color:#efefef;border-width:1px 0px 1px 1px;border-style:solid" width="100%" cellspacing="0" cellpadding="0" bgcolor="#e8eaee"
                                                role="presentation">
                                                <tr style="border-collapse:collapse">
                                                    <td align="right" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
                                                        <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:Cairo">{{translate("summary")}} : </h4>
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td align="right" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
                                                        <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left" role="presentation">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{translate("Order ID")}} : </td>
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{$order->code}}</td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{translate("Order Date")}} : </td>
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{ date('d-m-Y', $order->date) }}</td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{translate("Grand Total")}} : </td>
                                                                <td style="padding:0;Margin:0;font-size:14px;line-height:21px">{{ single_price($order->grand_total) }}</td>
                                                            </tr>
                                                        </table>
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px"><br></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td><td style="width:0px"></td><td style="width:280px" valign="top"><![endif]-->
                                	@php
                                      $shipping_address = json_decode($order->shipping_address);
                                  @endphp
                                  <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                    <tr style="border-collapse:collapse">
                                        <td align="left" style="padding:0;Margin:0;width:280px">
                                            <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#ffffff;border-width:1px;border-style:solid;border-color:#efefef" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
                                                <tr style="border-collapse:collapse">
                                                    <td align="right" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
                                                        <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'Cairo">{{translate("Shipping Address")}} : </h4>
                                                    </td>
                                                </tr>
                                                <tr style="border-collapse:collapse">
                                                    <td align="right" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;">{{ $shipping_address->country }} - {{ $shipping_address->city }}&nbsp;</p>
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">{{ $shipping_address->address }}</p>
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
                    <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                        <tr style="border-collapse:collapse">
                            <td align="right" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                <table class="es-right" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                    <tr style="border-collapse:collapse">
                                        <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:270px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" style="padding:0;Margin:0;padding-left:20px">
                                                        <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'Cairo">{{translate("Products")}}</h4>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                                <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td align="left" style="padding:0;Margin:0;width:270px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" style="padding:0;Margin:0">
                                                        <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" role="presentation">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;font-size:13px">{{translate("Product Name")}}</td>
                                                                <td style="padding:0;Margin:0;width:60px;font-size:13px;line-height:13px;text-align:center">{{translate("Quantity")}}</td>
                                                                <td style="padding:0;Margin:0;width:100px;font-size:13px;line-height:13px;text-align:center">{{translate("Price")}}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                        <tr style="border-collapse:collapse">
                            <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;border-bottom:1px solid #efefef;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px"></td>
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
                       @foreach ($order->orderDetails->where("seller_id",empty($order->orderDetails->first())?1:$order->orderDetails->first()->seller_id) as $key => $orderDetail)
                          <tr style="border-collapse:collapse">
                            <td align="left" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
                                <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                    <tr style="border-collapse:collapse">
                                        <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                        <a href="#" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#D48344;font-size:14px">
                                                            <img
                                                                        src="{{ uploaded_asset($orderDetail->product->thumbnail_img) }}"
                                                                        alt="{{  $orderDetail->product->getTranslation('name')  }}"
                                                                title="Natural Balance L.I.D., sale 30%"  style="display:block;border:0;width:125px;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                    >
                                                            </a>
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
                                                    <td align="left" style="padding:0;Margin:0">
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px"><br></p>
                                                        <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" role="presentation">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0">{{ $orderDetail->product->getTranslation('name') }}</td>
                                                                <td style="padding:0;Margin:0;width:60px;text-align:center">{{$orderDetail->quantity}}</td>
                                                                <td style="padding:0;Margin:0;width:100px;text-align:center">&nbsp;{{single_price($orderDetail->price)}}</td>
                                                            </tr>
                                                        </table>
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px"><br></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if mso]></td></tr></table><![endif]-->
                            </td>
                        </tr>

                      @endforeach
                        <tr style="border-collapse:collapse">
                            <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;border-bottom:1px solid #efefef;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px"></td>
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
                        <tr style="border-collapse:collapse">
                            <td align="left" style="Margin:0;padding-top:5px;padding-left:20px;padding-bottom:30px;padding-right:40px">
                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td valign="top" align="center" style="padding:0;Margin:0;width:540px">
                                            <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr style="border-collapse:collapse">
                                                    <td align="right" style="padding:0;Margin:0">
                                                        <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="right" role="presentation">
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Subtotal')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->orderDetails->sum('price')) }}
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Shipping')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->shipping_cost) }}
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Shipping Days')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ $order->shipping_days }}
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Tax')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->orderDetails->sum('tax')) }}
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Coupon Discount')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->coupon_discount) }}
                                                                </td>
                                                            </tr>
                                                            @if(!empty($order->special_offer_cart))
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Special Cart')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->special_offer_cart) }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @if(!empty($order->special_offer_categories))
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Special Category')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->special_offer_categories) }}
                                                                </td>
                                                            </tr>
                                                            @endif

                                                            @if(!empty($order->temp_discount))
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Temporary Discount')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                  {{ single_price($order->temp_discount) }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            <tr style="border-collapse:collapse">
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{ translate('Total')}}</td>
                                                                <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">
                                                                    <strong>{{ single_price($order->grand_total) }}</strong>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Cairo, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px"><br></p>
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
@endsection



