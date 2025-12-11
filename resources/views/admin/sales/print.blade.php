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
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #eceeef;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #eceeef;
            }

            .table tbody + tbody {
                border-top: 2px solid #eceeef;
            }

            .table .table {
                background-color: #fff;
            }

            .table-sm th,
            .table-sm td {
                padding: 0.3rem;
            }

            .table-bordered {
                border: 1px solid #eceeef;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #eceeef;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.075);
            }

            .table-active,
            .table-active > th,
            .table-active > td {
                background-color: rgba(0, 0, 0, 0.075);
            }

            .table-hover .table-active:hover {
                background-color: rgba(0, 0, 0, 0.075);
            }

            .table-hover .table-active:hover > td,
            .table-hover .table-active:hover > th {
                background-color: rgba(0, 0, 0, 0.075);
            }

            .table-success,
            .table-success > th,
            .table-success > td {
                background-color: #dff0d8;
            }

            .table-hover .table-success:hover {
                background-color: #d0e9c6;
            }

            .table-hover .table-success:hover > td,
            .table-hover .table-success:hover > th {
                background-color: #d0e9c6;
            }

            .table-info,
            .table-info > th,
            .table-info > td {
                background-color: #d9edf7;
            }

            .table-hover .table-info:hover {
                background-color: #c4e3f3;
            }

            .table-hover .table-info:hover > td,
            .table-hover .table-info:hover > th {
                background-color: #c4e3f3;
            }

            .table-warning,
            .table-warning > th,
            .table-warning > td {
                background-color: #fcf8e3;
            }

            .table-hover .table-warning:hover {
                background-color: #faf2cc;
            }

            .table-hover .table-warning:hover > td,
            .table-hover .table-warning:hover > th {
                background-color: #faf2cc;
            }

            .table-danger,
            .table-danger > th,
            .table-danger > td {
                background-color: #f2dede;
            }

            .table-hover .table-danger:hover {
                background-color: #ebcccc;
            }

            .table-hover .table-danger:hover > td,
            .table-hover .table-danger:hover > th {
                background-color: #ebcccc;
            }

            .thead-inverse th {
                color: #fff;
                background-color: #292b2c;
            }

            .thead-default th {
                color: #464a4c;
                background-color: #eceeef;
            }

            .table-inverse {
                color: #fff;
                background-color: #292b2c;
            }

            .table-inverse th,
            .table-inverse td,
            .table-inverse thead th {
                border-color: #fff;
            }

            .table-inverse.table-bordered {
                border: 0;
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .table-responsive.table-bordered {
                border: 0;
            }
            
            td,th {
                border-collapse: collapse;
                border: 1px solid black;
            }
            th{
                text-align: left;
            }
            table{
                margin:15px;
                border-collapse: collapse;
                font-size: 85%;
            }
            
        </style>

    </head>
    <body>
        <img width="100%" src="data:image/png;base64,{{$HeadImage}}">
        <hr/>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>{{ trans('cruds.sale.fields.reference') }}</th>
                    <td>{{ $sale->reference }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.sale.fields.montant') }}</th>
                    <td>{{ number_format($sale->montant, 0, '.', ' ') }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.sale.fields.patient') }}</th>
                    <td>{{ $sale->patient->name ?? '' }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.patient.fields.solde') }}</th>
                    <td>{{ number_format($sale->patient->solde, 0, '.', ' ') ?? '0' }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right">{{ $sale->user->name ?? '' }}, le {{ $sale->created_at }}</td>
                </tr>
            </tbody>
        </table>
        <h3 style="text-align: center">{{trans('cruds.saleDetail.title_singular')}}</h3>
        <table class=" table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cruds.saleDetail.fields.article') }}</th>
                    <th>{{ trans('cruds.saleDetail.fields.quantity') }}</th>
                    <th>{{ trans('cruds.saleDetail.fields.prix_unitaire') }}</th>
                    <th>{{ trans('cruds.saleDetail.fields.montant_total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleDetails as $key => $saleDetail)
                <tr>
                    <td>{{ $saleDetail->article->name ?? '' }}</td>
                    <td align='right'>{{ number_format($saleDetail->quantity, 0, '.', ' ') ?? '' }}</td>
                    <td align='right'>{{ number_format($saleDetail->prix_unitaire, 0, '.', ' ') ?? '' }}</td>
                    <td align='right'>{{ number_format($saleDetail->montant_total, 0, '.', ' ') ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>