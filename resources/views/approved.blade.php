<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Quote approved</title>
</head>
<body>
  @if($approved == false)
    <p style="font-size:18px;color:green">Thank you, your quote has been approved as order, an confirmation email has been sent</p>
  @else
    <p style="font-size:18px;color:darkgreen">This quotation has allready been approved, an confirmation email has been sent</p>
  @endif
</body>
</html>