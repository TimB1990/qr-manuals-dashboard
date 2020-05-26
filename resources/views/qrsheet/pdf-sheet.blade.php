<html>
   <head>
      <style>
         .page-break{
            page-break-after: always;
         }
      </style>
   </head>
   <body>
   @for($i = 1; $i <= $sheet->pages)
      <span>page {{ $i }} of {{$sheet->pages}}</span>
      <div id="sheet" class="sheet">
         <div class="sheet__blueprint">
            @for($i = 0; $i < ($sheet->rows_per_page * $sheet->cols_per_page))
               <div class="qr-item-blueprint"></div>
            @endfor
         </div>
         <div class="sheet__items">
            @for($i = 0; $i < $sheet->product_amount; $i++)
            <div class="qr-item">
               <div class="qr-item-head">
               <p>{{$sheet->items[$i]['item_name']}}</p>
               <p>{{$sheet->items[$i]['item_artnr']}}</p>
               </div>
               <div>
                  {!! QrCode::size(100)->generate($sheet->items[$i]['item_artnr']) !!}
               </div>
            </div>
            @endfor
         </div>
      </div>
      @if($sheet->product_amount > ($sheet->rows_per_page * $sheet->cols_per_page))
         <div class="page-break"></div>
      @endif
   @endfor
   </body>
</html>