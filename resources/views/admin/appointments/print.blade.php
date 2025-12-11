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
            .tdBordered {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <img width="100%" src="data:image/png;base64,{{$HeadImage}}">
        <hr/>
        <table width="100%" style="text-align: left;margin:0 5px 10px;">
            <tr>
                <td colspan="2"><b>Nom et prénom : </b>{{$appointment->patient->name}}</td>
            </tr>
            <tr>
                <td><b>Numéro du dossier :</b> {{$appointment->patient->id}}</td>
                <td style="text-align:right">Date : {{$appointment->created_at}}
                </td>
            </tr>
        </table>
        <h3 style="text-align: center">Ordre : {{$appointment->ordre}}</h3>
        <table align="center" style="width: 60%; border: 1px solid black;border-collapse: collapse;">
            <tr>
                <th class="tdBordered">{{trans('cruds.facture.fields.reference')}}</th>
                <th class="tdBordered">{{trans('cruds.facture.fields.montant')}}</th>
                <th class="tdBordered">{{trans('cruds.facture.fields.status')}}</th>
            </tr>
            @foreach($appointment->factures as $key => $detail)
            <tr>  
                <td class="tdBordered">{{$detail->reference}}</td>
                <td class="tdBordered">{{$detail->montant}}</td>
                <td class="tdBordered">{{$detail->facturePaiements[0]->status->name ?? ''}}</td>
            </tr>
            @endforeach
        </table>

    <htmlpagefooter name="page-footer">
        <hr/>
       Cette facture est valable pendant 7 jours
    </htmlpagefooter>
</body>
</html>