<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="generator" content="maite" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <style type="text/css">
            /** Define the margins of your page **/
            @page {
                margin-top: 0;
                margin-bottom: 0;
                margin-left: 0;
                margin-right: 0;
                /** 
                width: 816px;
                height: 1056px;
                **/
            }
            html {
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #242424;
                font-size: 12px;
            }
            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                width: 100%;
                -webkit-transform: skew(-20deg);
                -moz-transform: skew(-20deg);
                -o-transform: skew(-20deg);
                background-color: #41BF42;
                
                /** Extra personal styles **/
                font-family: Arial, Helvetica, sans-serif;
                text-transform: capitalize;
                height: 55px;
                margin-left: 75px;
                font: 25px arial;
                font-weight: bold;
                color: white;
                text-align: center;
                line-height: 35px;
                background-position: top;
                background-size: 100% auto;
                
            }
            footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                font-size: 20px;
                width: 100%;
                -webkit-transform: skew(-20deg);
                -moz-transform: skew(-20deg);
                -o-transform: skew(-20deg);
                background-color: #41BF42;

                /** Extra personal styles **/
                height: 30px; 
                margin-left: -75px;
                background-position: top;
                background-size: 100% auto;
                color: white;
                font-size: 14px;
                text-align: center;
                line-height: 35px;
            }
            #container {
                z-index: 200;
                top: 60px;
                left: 30px;
                right: 30px;
                /** border-color: red;
                border-style:solid;
                border-width: 2px; **/
                /** width: 796px; **/
                /** height: 1036px; **/
                position: absolute;

            }
            #numinvx {
                border-color: #39A839;
                border-width: 2px;
                border-style:double;
            }
            #number_title {
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                font-size: 9px;
                background-color: #F1F9EE;
            }
            #number_invoice {
                font-family: 'Courier New', Courier, monospace;
                color: #39A839;
                font-size: 27px;
                font-weight: bolder;
                text-align: center;
            }
            th {
                /** background-image: url("{{ asset('resources/images/templates/1.tablehead.jpg') }}");
                background-color: transparent;
                background-position: top;
                background-size: 100% auto; **/
                background-color: #40BC42;
                color: white;
                text-align: center;
                
            }
            #powered {
               /*  z-index: 20;
                position: absolute;
                right:-35px;
                top:-951px;
                width: 100%;
                text-align: center;
                color:gray;
                font-family:Verdana, Geneva, Tahoma, sans-serif;
                word-spacing: 6px;
                font-size: 12px;
                writing-mode: vertical-lr;
                transform: rotate(250deg);
                border-color: red;
                border-width: 2;
                border-style: solid; */
            }
        </style>

        <script>

        </script>
        <title></title>
    </head>
    <body>
        <header>
        {{ $info_data['mycomercialname'] }}
        </header>
        <footer>
            <div id="powered">Powered By: <b>maite</b> &#174; - Facturación Ilimitada</div>
        </footer>
        <div id="container" name="container">
            <table style="width: 100%;" >
                <tr>
                    <td>
                        <div id="show_invoice">
                            <table id="numinvx"><tr><td style="text-align:center;"><span id="number_title" style=" border-bottom-color: #39A839; border-bottom-width: 1px; border-bottom-style:solid;"> FACTURA ELECTRONICA DE VENTA</span></td></tr>
                            <tr><td style="text-align:center;"><span id="number_invoice">{{ $info_data['invoice_number'] }}</span></td></tr>
                            </table>
                        </div>
                    </td>
                    <td style="text-align: center; " valign="center">
                        <table style="width: 100%"><tr><td valign="center" style="text-align: center;">
                            <div id="img_logo" style="text-align:center;">
                                <img src="{{ $info_data['logo_company'] }}" alt="logo" width="250px" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
                            </div>
                        </td></tr></table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        FECHA: {{ date('d/m/Y', strtotime($info_data['order_date'])) }}
                    </td>
                    <td style="text-align:center">
                            <table style="width: 100%;">
                            <tr><td style="text-align:center"><span ><b> {{ $info_data['myname'] }}</b></span></td></tr>
                            <tr><td style="text-align:center"><span >{{ $info_data['nit'] }}</span></td></tr>
                            <tr><td style="text-align:center"><span >{{ $info_data['myaddress'] }}</span></td></tr>
                            <tr><td style="text-align:center"><span >{{ $info_data['myphone'] }}</span></td></tr></table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="info_customer">
                            <table><tr><td><span > CLIENTE:</span></td></tr>
                            <tr><td><span >{{ $info_data['comercialname'] }}</span></td></tr>
                            <tr><td><span ><b>{{ $info_data['order_receiver_name'] }}</b></span></td></tr>
                            <tr><td><span >{{ $info_data['order_receiver_nit'] }}</span></td></tr>
                            <tr><td><span >{{ $info_data['order_receiver_address'] }} - {{ $info_data['order_receiver_phone']}}</span></td></tr></table>
                        </div>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            <table style="width: 100%;"><tr><td style="text-align:center">
            <span style="font-size:9px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">{{ $info_data['order_resolution_info']}}</span>
            </td></tr></table>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>CANTIDAD</th>
                        <th>VAL. UNIT.</th>
                        <th>DCTO</th>
                        <th>IVA/IC</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $varbool="#DEF3E6"; ?>
                    @foreach ($item_data as $item)
                    <?php if ($varbool=="#DEF3E6") { $varbool="#F1F9EE"; } else { $varbool="#DEF3E6"; } ?>
                    <tr style="background-color:<?php echo $varbool;?>;">
                        <td >{{ $item['order_item_id'] }}</td>
                        <td>{{ $item['item_code'] }}</td>
                        <td>{{ $item['item_name'] }} {{ $item['descripcion']}} - {{ $item['reference'] }} </td>
                        <td style="text-align:center">{{ $item['order_item_quantity'] }}</td>
                        <td style="text-align:right">{{ $item['order_item_price'] }}</td>
                        <td style="text-align:right">{{ $item['order_item_desc'] }}</td>
                        <td style="text-align:right">{{ $item['order_item_iva'] }}</td>
                        <td style="text-align:right">{{ $item['order_item_final_amount'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table style="width: 100%;">
                <tr><td style="text-align:left; width:50%"  valign="top">
                <span style="font-size:9px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><b>NOTA: </b>{{ $info_data['note']}}</span>
                </td>
                <td style="text-align:right">
                    <table style="width: 60%; border-style:double; border-color: #39A839;border-width: 2px;" align="right">
                    <tr style="background-color:honeydew"><td style="text-align:left">SubTotal:</td><td style="text-align:right">$ {{ number_format($info_data['order_subtotal_before_tax'], 2, ',', '.') }}</td></tr>
                    <tr style="background-color:gainsboro"><td style="text-align:left">Descuento:</td><td style="text-align:right">$ {{ number_format($info_data['order_total_desc'], 2, ',', '.') }}</td></tr>
                    <tr style="background-color:honeydew"><td style="text-align:left">Total Base:</td><td style="text-align:right">$ {{ number_format($info_data['order_total_before_tax'], 2, ',', '.') }}</td></tr>
                    <tr style="background-color:azure"><td style="text-align:left">Total IVA/IC:</td><td style="text-align:right">$ {{ number_format($info_data['order_total_tax'], 2, ',', '.') }}</td></tr>
                    <tr style="background-color:aliceblue"><td style="text-align:left">TOTAL FACTURA:</td><td style="text-align:right">$ {{ number_format($info_data['order_total_after_tax'], 2, ',', '.') }}</td></tr>
                    </table>
                </td>
                </tr>
            </table>
            <table style="width: 100%;">
            <tr>
                <td style="text-align:left"> {{$info_data['numerotexto']}}</td>
            </tr>
            </table>
            <?php if ($info_data['cufe']!='0') { ?>
            <table style="border-width: 1px; border-style:dotted; border-color:#DEF3E6; width: 100%;">
                <tr>
                    <td style="text-align:center;" colspan="2">
                    CUFE: {{ $info_data['cufe'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td style="text-align:right;">
                    <img src="{{ $info_data['qrdir'] }}" alt="logo" width="25%" >
                    </td>
                </tr>
            </table>
            <?php } ?>
        </div> <!-- Fin div container  -->
    </body>
</html>
