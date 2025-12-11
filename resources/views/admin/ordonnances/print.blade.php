<!doctype html>
<html lang="en">
    <head>
        <!--<script>window.print();</script>-->
        <meta charset="UTF-8">
        <title>Ordonnance PRINT</title>
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
        <img width="100%" src="data:image/png;base64,{{$HeadImage}}">

        <hr/>
        <table width="100%" style="text-align: left;margin:0 5px 10px;">
            <tr>
                <td colspan="2"><b>Nom et prénom : </b>{{$ordonnance->patient->name}}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right">Date : {{$ordonnance->created_at}}
                </td>
            </tr>
        </table>
        <br/><br/>
        <table width="100%">
            @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $detail)
            <tr>

                <td colspan="3"> {{ $loop->index+1}}- <b>
                    @if($detail->article)
                        {{$detail->article->name ?? ''}}
                        @if($detail->article->forme)
                            , {{$detail->article->forme->name}}
                        @endif
                    @else
                        {{$detail->medicament ?? ''}}
                    @endif
                </b> </td>
                <td style="text-align:center">
                    {{$detail->quantity}} @if((int) $detail->quantity == 1) {{'Boite'}} @else {{'Boites'}} @endif
                </td>
            </tr>
            <tr>  
                <td></td>
                <td colspan="3">
                    {{$detail->posologie}} pendant <b>{{$detail->duration}}</b> @if((int) $detail->duration == 1) {{'Jour'}} @else {{'Jours'}} @endif                    
                </td>
            </tr>
            @endforeach
        </table>

    <htmlpagefooter name="page-footer">
       <img width="100%" src="data:image/png;base64,{{$FooterImage}}">
    </htmlpagefooter>
</body>
</html>