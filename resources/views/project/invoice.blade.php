<html style="padding: 0; margin: 0; width: 100%; min-width: 100%; font-family: 'Calibri', serif; color: #464a4f;">
    <head>
        <title>Faktúra</title>
    </head>
    <body style="padding: 0; margin: 0; width: 100%; min-width: 100%;">
        <table style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="text-align: left; width: 100%;">
                <tr style="width: 100%;">
                    <th align="left" style="font-size: 27px; color: #35383d;">
                        <font family="Calibri" color="#464a4f">
                            Dodávateľ
                        </font>
                    </th>
                    <th align="right" style="font-size: 27px; color: #35383d;">
                        <font family="Calibri" color="#464a4f">
                            Faktúra č. {{$invoice_number}}
                        </font>
                    </th>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            Meno Priezvisko
                        </font>
                    </td>
                    <td align="right">
                        <font color="#464a4f" family="Calibri">
                            Dátum vystavenia: {{date('d.m.Y', strtotime($date_of_issue))}}
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            Adresa 12
                        </font>
                    </td>
                    <td align="right">
                        <font color="#464a4f" family="Calibri">
                            Dátum splatnosti: {{date('d.m.Y', strtotime($due_date))}}
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            111 11 Mesto
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            Zapísaný na ....
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            Číslo živnostenského registra: -----
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                <tr/>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            IČO: 1234567
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            DIČ: 1234567
                        </font>
                    </td>
                </tr>
            </thead>
            <br/>
            <br/>
            <br/>
            <br/>
            <tbody style="text-align: left; width: 100%;">
                <tr>
                    <th align="left" style="font-size: 27px;">
                        <font color="#464a4f" family="Calibri">
                            Odberateľ
                        </font>
                    </th>
                    <th align="right">
                        <font color="#464a4f" family="Calibri">
                            Bankové spojenie (IBAN)
                        </font>
                    </th>
                </tr>
                <tr>
                    <td align="left">
                        <font color="#464a4f" family="Calibri">
                            {!! add_paragraphs($purchaser) !!}
                        </font>
                    </td>
                    <td align="right">
                        <font color="#464a4f" family="Calibri">
                            SK123 123 123
                        </font>
                    </td>
                </tr>
            </tbody>
        </table>
        <br/>
        <br/>
        <table style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <tbody>
                <tr style="background-color: #4d4e4f;">
                    <th style="text-align:left">
                        <font style="text-align: left;" color="white" family="Calibri">
                            POLOŽKA
                        </font>
                    </th>
                    <th style="text-align:left">
                        <font style="text-align: left;" color="white" family="Calibri">
                            MNOŽSTVO
                        </font>
                    </th>
                    <th style="text-align:left">
                        <font style="text-align: left;" color="white" family="Calibri">
                            SADZBA
                        </font>
                    </th>
                    <th style="text-align:left">
                        <font style="text-align: left;" color="white" family="Calibri">
                            SUMA
                        </font>
                    </th>
                </tr>

                @foreach($table as $group => $value)
                    @if (is_array($value))
                        @if ($type == 2)
                            <tr>
                                <td>{{$group}}</td>
                                <td></td>
                                <td>
                                    {{ sprintf('%.2f', round($value['total_price'], 2)) }} €
                                </td>
                                <td>
                                    {{ sprintf('%.2f', round($value['total_price'], 2)) }} €
                                </td>
                            </tr>
                        @elseif($type == 1)
                            @foreach($value as $itemKey => $itemValue)
                                @if (isset($itemValue['item']))
                                    <tr>
                                        <td>{{$itemValue['item']['name']}}</td>
                                        <td>{{$itemValue['count']}} {{$itemValue['item']['unit']['name']}}</td>
                                        <td>{{sprintf('%.2f', round($itemValue['item']['price'])) }} €</td>
                                        <td>{{sprintf('%.2f', round($itemValue['price'], 2)) }} €</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach

                <tr>
                    <td colspan="4">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <font family="Calibri">
                            Dodávateľ nie je platiteľom DPH
                        </font>
                    </td>
                    <td>
                        <font family="Calibri">
                            Celková suma:
                        </font>
                    </td>
                    <td>
                        <font family="Calibri">
                            {{sprintf('%.2f', round($table['full_price'], 2))}} €
                        </font>
                    </td>
                </tr>
            </tbody>
        </table>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <table align="right">
            <tr>
                <td>
                    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </u>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <font family="Calibri">
                        Podpis a pečiatka
                    </font>
                </td>
            </tr>
        </table>
    </body>
</html>
