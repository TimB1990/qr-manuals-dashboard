<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Quote Request Email Confirmation</title>
</head>
<body>
   <h1>You have requested a quote</h1>
   <p>You received this email, because you requested a quote for the product with artnr: <strong>{{$input['product_artnr']}}</strong></p>

   <p>You provided us with the following data</p>
   <table>
      <tr>
         <td><strong>company</strong></td>
      <td>{{$input['company']}}</td>
      </tr>
      <tr>
         <td><strong>contact</strong></td>
         <td>{{$input['contact']}}</td>
      </tr>
      <tr>
         <td><strong>email</strong></td>
         <td>{{$input['email']}}</td>
      </tr>
      <tr>
         <td><strong>phonenumber</strong></td>
         @if(isset($input['phone']))
            <td>{{$input['phone']}}</td>
         @else
            <td>no phone number provided</td>
         @endif
      </tr>
      <tr>
         <td><strong>amount</strong></td>
         <td>{{$input['amount']}}</td>
      </tr>
   </table>
</body>
</html>