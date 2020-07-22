<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Quote will be converted to an order</title>
</head>
<body>


  <p>
  Dear {{$data['customer']->contact}}, <br>
  Thank you, Your quotation has now been converted to an order. We will deliver your order at the following adres:  </p> <br>

  <table>
    <tr>
      <td>address</td>
      <td>{{$data['customer']->address}}</td>
    </tr>
    <tr>
      <td>Postcode</td>
      <td>{{$data['customer']->post_code}}</td>
    </tr>
    <tr>
      <td>City</td>
      <td>{{$data['customer']->residence}}</td>
    </tr>
  </table>

  <p>below you receipt:</p>

      <table>
      <tr>
        <td>name:</td>
        <td>{{$data['product']['name']}}</td>
      </tr>
      <tr>
        <td>artnr:</td>
        <td>{{$data['product']['artnr']}}</td>
      </tr>
      <tr>
        <td>amount:</td>
        <td>{{$data['product']['amount']}}</td>
      </tr>
    </table>

  <table>
  <tr><td>Subtotal</td><td>{{$data['specification']->subtotal}} EUR</td></tr>
  <tr><td>Discount</td><td>-{{$data['specification']->discount}} EUR</td></tr>
  <tr><td>Tax</td><td>{{$data['specification']->tax}} EUR</td></tr>
  <tr><td>Shipping</td><td>{{$data['specification']->shipping}} EUR</td></tr>
  <tr><td>Shipping Tax</td><td>{{$data['specification']->shippingtax}} EUR</td></tr>
  <tr><td><b>Total</b></td><td><b>{{$data['specification']->total}} EUR</b></td></tr>
  </table>

  <p>kind regards,</p>
  <p>Exalto</p>

</body>
</html>