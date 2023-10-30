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
                -webkit-transform: skew(-50deg); 
                 -moz-transform: skew(-20deg); 
                 -o-transform: skew(-20deg); 
                background-color:#0C3E62;
                
                /** Extra personal styles **/
                font-family: Arial, Helvetica, sans-serif;
                text-transform: capitalize;
                height: 400px;
                margin-left: -900px;
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
                -webkit-transform: skew(-50deg);
                -moz-transform: skew(-20deg);
                -o-transform: skew(-20deg);
                background-color:#0C3E62;
                

                /** Extra personal styles **/
                height: 400px; 
                margin-left: 900px;
                background-position: top;
                background-size: 100% auto;
                color: black;
                font-size: 14px;
                text-align: right;
                line-height: 35px;
            }
            #container {
                z-index: 200;
                top: 200px;
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
                border-color:cadetblue;
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
                color:cadetblue;
                font-size: 27px;
                font-weight: bolder;
                text-align: center;
            }
            th {
                /** background-image: url("{{ asset('resources/images/templates/1.tablehead.jpg') }}");
                background-color: transparent;
                background-position: top;
                background-size: 100% auto; 
                background-color:cadetblue;**/
                font-size: 35px;
                color: green;
                text-align: center;
                
            }
            td {
                
            
                text-align: center;
                
            }
            #titulo{
                font-size: 40px;
                color: #0C3E62;
                text-align: center;
            }
            #subtitulo{
                font-size: 25px;
                
                text-align: center;
            }
            #titulonegrita{
                font-size: 20px;
                font-weight: bold;
                text-align: center;
            }
        </style>

        <script>

        </script>
        <title></title>
    </head>
    <body>
        <header>
        
        </header>
       
            

        <footer>
            <div id="powered">Powered By: <b>Nexus IT</b> &#174; - Academy</div>
        </footer>
        <div id="container" name="container">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th colspan="3">Genomax - Academy</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">Cetifica a</td>
                    </tr>
                    <tr >
                        <td colspan="3"><div id="titulo">{{ $info_data['username'] }}</div></td>
                    </tr>
                    <tr>
                        <td colspan="3">Por participar y aprobar el</td>
                    </tr>
                    <tr >
                        <td colspan="3"><div id="subtitulo">CURSO DE</div></td>
                    </tr>
                    <tr >
                        <td colspan="3"><div id="titulo">{{ $info_data['coursename'] }}</div></td>
                    </tr>
                    <tr >
                        <td><img src="images/{{ $info_data['Signature1'] }}" alt="Logo"></td>
                        <td><img src="images/{{ $info_data['logo'] }}" alt="Logo"></td>
                        <td><img src="images/{{ $info_data['Signature2'] }}" alt="Logo"></td>
                    </tr>
                    <tr>
                        <td colspan="3">Certificado de aprobacion online</td>
                    </tr>
                    <tr>
                        <td colspan="3"><div id="titulonegrita">Aprobado el {{ $info_data['approvaldate'] }}</div></td>
                    </tr>
                    <tr>
                        <td colspan="3">{{ $info_data['coursehour'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- Fin div container  -->
    </body>
</html>
