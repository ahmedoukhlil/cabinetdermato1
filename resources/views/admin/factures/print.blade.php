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
        </style>
    </head>
    <body>
        <table style='text-align: center;width: 100%;'>
            <tr>
                <td width='40%'><b>{{$ordonnance->medecin->grade->code}}. {{$ordonnance->medecin->name}}</b></td>
                <td rowspan="5" colspan="2"><img src="{{asset('images/logo.jpg')}}"/></td>
                <td width='40%'><b>الدكتورة السالمة يحي</b></td>
            </tr>
            <tr>
                <td>Dermatologie-Vénérologie, </td>
                <td>أخصائية الأمراض الجلديه والجنسية</td>
            </tr>
            <tr>
                <td>Dermatologie Esthétique</td>
                <td>وطب التجميل</td>
            </tr>
            <tr>
                <td>Maladie de la peau, ongles et cheveux</td>
                <td>أمراض الجلد، الشعر و الأظافر</td>
            </tr>
            <tr>
                <td>Tél: {{$ordonnance->medecin->contact}} </td>
                <td>هاتف: {{$ordonnance->medecin->contact}} </td>
            </tr>
            <tr>
                <td colspan="2">Avenue Charles de Gaulle, Immeuble laboratoire Bio24/1ère Etage</td>
                <td colspan="2">شارع شارل ديغول ، عمارة مختبر بيو24 / الطابق1</td>
            </tr>
            <tr>
                <td colspan="2">Tevragh Zeina - Nouakchott - Mauritanie</td>
                <td colspan="2">تفرغ زينة ـ نواكشوط ـ موريتانيا</td>
            </tr>
        </table>
        <hr/>
        <table width="100%" style="text-align: left;margin:0 5px 10px;">
            <tr>
                <td colspan="2"><b>Nom et prénom : </b>{{$ordonnance->patient->name}}</td>
            </tr>
            <tr>
                <td><b>Numéro du dossier :</b> {{$ordonnance->patient->id}}</td>
                <td style="text-align:right">Date : {{$ordonnance->created_at}}
                </td>
            </tr>
        </table>
        <br/><br/>
        <table width="100%" >
            @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $detail)
            <tr>

                <td colspan="3"> {{ $loop->index+1}}- <b>{{$detail->medicament}}</b> ({{$detail->posologie}})
                </td>
                <td style="text-align:center">
                    <b>{{$detail->forme->name}}</b>
                </td>
            </tr>
            <tr>  
                <td></td>
                <td colspan="2">
                    ({{$detail->quantity}})
                </td>
                <td>
                    <b>{{$detail->duration}} J</b>
                </td>
            </tr>
            @endforeach
        </table>

    <htmlpagefooter name="page-footer">
        <hr/>
        يرجى إحضار الوصفة في الموعد القادم<br/>
        Prière rapporter l'ordonnance au prochain rendez-vous
    </htmlpagefooter>
</body>
</html>