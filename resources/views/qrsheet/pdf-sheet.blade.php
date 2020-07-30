<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link type="text/css" href="public/css/app.css" rel="stylesheet" />
   <style>
      @page {
         margin: 6mm;
      }

      @font-face{
         font-family: 'Tahoma';
         font-weight: bold;
      }

      body{
         font-family: Tahoma, sans-serif;
         font-weight: bold;
         font-size: 16px;
      }

      .page-break {
         page-break-after: always;
      }

      .qr-item-head {
         font-weight: bold;
         text-align: center;
      }

   </style>
</head>
<body>
   @php
   //derived variables
   $pagemargin = 12;
   $itemWidth = (($sheet->page_width_mm - $pagemargin) / $sheet->cols_per_page) - 4;
   $itemHeight = (($sheet->page_height_mm - $pagemargin) / $sheet->rows_per_page) - 4;
   $qrsize = sqrt(($itemWidth * $itemHeight * 0.8 ) * 3.78);

   // dynamic rows
   $rowCount = 1;
   $colCount = 1;
   @endphp

   <!-- start by page -->
   @for($p = 0; $p < $sheet->pages; $p++)
      <table style="margin:auto;">
         @for($r = 0; $r < $sheet->rows_per_page; $r++)
            <tr>
               @for($c = 0; $c < $sheet->cols_per_page; $c++)
                  <td style="width:{{$itemWidth}}mm;height:{{$itemHeight}}mm;border:1px solid black; text-align:center;vertical-align:top;border-radius:1rem;">
                     @if($colCount <= $sheet->product_amount )
                        <p>{{ $sheet->products[$c]->kind}}</p>
                        <p>{{ $sheet->products[$c]->artnr}}</p>
                        <img width="{{$qrsize}}px" height="{{$qrsize}}px" src="data:image/png;base64, 
               {!! base64_encode(QrCode::errorCorrection('H')->format('png')->size($qrsize)->generate($sheet->products[$c]->artnr)) !!} ">
                        @endif
                  </td>
                  <!-- column counter -->
                  @php
                  $colCount++
                  @endphp
                  @endfor

                  <!-- row counter -->
                  @php
                  $rowCount++
                  @endphp
            </tr>
            @endfor
      </table>
      @if(($p+1) < $sheet->pages)
         <div class="page-break"></div>
      @endif
      @endfor

</body>
</html>
