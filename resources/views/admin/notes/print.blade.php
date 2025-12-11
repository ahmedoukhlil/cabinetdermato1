<!doctype html>
<html lang="en">
    <head>
        <!--<script>window.print();</script>-->
        <meta charset="UTF-8">
        <title>Cabinet PRINT</title>
        <style type="text/css">
            footer { position: fixed; bottom: -30px; right: 20px; height: 30px; text-align: center}
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            @page {
                header: page-header;
                footer: page-footer;
            }
            ul {
                list-style-type: circle;
            }
        </style>
    </head>
    <body>
        <img width="100%" src="data:image/png;base64,{{$HeadImage}}">

        <hr/>
        <table width="100%" style="text-align: left;margin:0 5px 10px;">
            <tr>
                <td colspan="2"><b>Nom et prénom : </b>{{$note->patient->name}}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right">Date : {{$note->created_at}}
                </td>
            </tr>
        </table>
        <h3 align='center'>{{$note->objet}}</h3>
        <br/>
        {!! $content !!}
    </body>
</html>