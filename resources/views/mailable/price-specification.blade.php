<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Quote Price Specification</title>
</head>
<body>
  <table>
    <tr>
      <th colspan="2">customer details</th>
    </tr>
        <tr>
      <td>Contact</td>
      <td>{{$data['customer']->contact}}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{$data['customer']->email}}</td>
    </tr>
    <tr>
      <td>Company</td>
      <td>{{$data['customer']->company}}</td>
    </tr>
    <tr>
      <td>Phone</td>
      <td>{{$data['customer']->phone}}</td>
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
  <br>
  <h1>Quotation</h1>
  <p>
  @php
    $date = date_create($data['specification']->created_at);
    $dformat = date_format($date, 'm-d-Y');
  @endphp
    City, {{ $dformat }}
  </p>
  <p>
    Regarding: Quotation for product: {{$data['product']['artnr']}} - {{$data['product']['name']}}
    QuotationNo: {{$data['id']}}
    Your reference code: {{$data['customer']->token}}
  </p>
  <p>
    Dear {{$data['customer']->contact}},<br>
    We send you this email to notify we made up a price specification for your request. We are pleased to offer you the following quotation for the dilivery of:
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
  </p>
  below you can see your specification details:
  <table>
  <tr><td>Subtotal</td><td>{{$data['specification']->subtotal}} EUR</td></tr>
  <tr><td>Discount</td><td>-{{$data['specification']->discount}} EUR</td></tr>
  <tr><td>Tax</td><td>{{$data['specification']->tax}} EUR</td></tr>
  <tr><td>Shipping</td><td>{{$data['specification']->shipping}} EUR</td></tr>
  <tr><td>Shipping Tax</td><td>{{$data['specification']->shippingtax}} EUR</td></tr>
  <tr><td><b>Total</b></td><td><b>{{$data['specification']->total}} EUR</b></td></tr>
  </table>

  <p>
    This quotation is without obligation as long as you do not convert the quotation into an order.
    In case you agree to make an order from this offer, please click the link below. Once clicked your order will be processed and an confirmation email on this email-address will be sent.
  </p>
  <p>
    <a href="#">Yes, I want to convert my request into an order</a>
  </p>
</body>
</html>
