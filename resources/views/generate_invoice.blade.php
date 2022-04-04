<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Invoice</title>
  <style>
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      font-size: 12px;
      line-height: 18px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #000;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    tr.top {
      font-weight: 500;
      font-size: 12px;
    }

    .bill-detail {
      background: #000;
      color: #fff;
    }

    .hline {
      border-bottom: 1px solid #eee;
    }

    .bold-text {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tbody>
              <tr>

                <!-- <td><img src="<?php //$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data); 
                                    ?>" style="width:172px; height:94px"></td> -->
                <td><img src="{{$pic}}" style="width:172px; height:94px"></td>
                <td style="text-align:right"><span style="font-weight:bold">Shreshta Enterprises</span> <br>
                  Shreshta Enterprises <br>
                  Shreshta’s SQube Plot no:104, Saptagiri<br>
                  Colony, Near Vivekananda Nagar Colony,<br>
                  Kukatpally, Hyderabad-500072<br>
                  Cell:7032715127<br>
                  GSTN:36AEGFS1239F1Z4 <br>
                  fssai :10020047001857 </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td style="font-weight:bold; padding-left: 28px; font-size: 24px; text-transform: uppercase;">Invoice </td>
      </tr>
      <tr>
        <td>
          <table style="padding-bottom:30px;">
            <tbody style="padding-bottom:30px;">
              <tr>
                <td>
                  <table style="padding-bottom:30px;">
                    <tbody style="padding-bottom:30px;">
                      <tr>
                        <td style="padding-left:21px; width:25%;">
                          <h3 style="border-bottom:1px solid #000;">Billing Address:</h3>
                          {{$order->relShippingAddress->b_name}}<br>
                          {{$order->relShippingAddress->b_address}}<br>
                          {{$order->relShippingAddress->b_locality}}<br>
                          {{$order->relShippingAddress->b_city}} {{$order->relShippingAddress->b_pincode}}<br>
                          @if(!empty($order->relShippingAddress->relBCountry->name)) {{$order->relShippingAddress->relBCountry->name}} @endif<br>
                          @if(!empty($order->relShippingAddress->relBState->name)) {{$order->relShippingAddress->relBState->name}} @endif<br>
                          {{$order->relShippingAddress->b_contact}}
                        </td>
                        <td style="width:25%">
                          <h3 style="border-bottom:1px solid #000;">Shipping Address:</h3>
                          {{$order->relShippingAddress->name}}<br>
                          {{$order->relShippingAddress->address}}<br>
                          {{$order->relShippingAddress->locality}}<br>
                          {{$order->relShippingAddress->city}} {{$order->relShippingAddress->pincode}}<br>
                          @if(!empty($order->relShippingAddress->relCountry->name)) {{$order->relShippingAddress->relCountry->name}} @endif<br>
                          @if(!empty($order->relShippingAddress->relState->name)) {{$order->relShippingAddress->relState->name}} @endif<br>
                          {{$order->relShippingAddress->contact}}
                        </td>
                        <td style="width:20%; padding-top:51px;">Invoice Number: {{$order->id}}<br>
                          Invoice Date: {{date('d-M-Y')}}<br>
                          Order Number: {{$order->id}}<br>
                          Order Date: {{date('d-M-Y', strtotime($order['created_at']))}}<br>
                          Payment Method: {{$order->payment_mode}}</td>
                        
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr class="bill-detail">
        <td>
          <table>
            <tbody>
              <tr>
                <td style="width:40%; padding-left:23px;">Product</td>
                <td style="width:10%;">Brand</td>
                <td style="width:10%;">Net Weight</td>
                <td style="width:10%;">Gross Weight</td>
                <td style="width:10%;">Quantity</td>
                <td style="width:20%;">Price</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>

      @foreach($order_items as $row)
      <tr>
        <td class="hline">
          <table>
            <tbody>
              <tr class="hline">
                <td style="width:40%;">{{$row->relProductVarient->relProduct->title}}<br>
                  <!-- Weight: {{--$row->relProductVarient->title--}} -->
                </td>
                <td style="width:10%;">{{$row->relVendor->brand_name}}</td>
                <td style="width:10%;">{{$row->relProductVarient->title}}</td>
                <td style="width:10%;">{{$row->relProductVarient->gross_weight}}</td>
                <td style="width:10%;">{{$row['quantity']}}</td>
                <td style="width:20%;">RS.{{$row['price']}}</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      @endforeach
      <tr>
        <td>
          <table>
            <tbody>
              <tr>
                <td style="width:40%;  text-align:right;"></td>
                <td style="width:20%; border-top:1px solid #333; border-bottom:1px solid #333;">
                  <table>
                    <tbody >
                      <tr>
                        <td class="bold-text" style="width:20%">Total Weight</td>
                        <td style="width:20%">{{$order->weight}}.Kg</td>
                        <td class="bold-text" style="width:20%">Subtotal</td>
                        <td style="width:20%">RS.{{$order->total_amount}}</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="width:40%"></td>
                <td style="width:20%; border-bottom:1px solid #333;">
                  <table style="text-align:right;">
                    <tbody>
                      <tr>
                        <td class="bold-text" style="width:20%; text-align:right;">Shipping</td>
                        <td style="width:20%; text-align:right;">RS.{{$order->shipping_cost}} via Weight<br>
                          Based Shipping</td>
                      </tr>
                    </tbody>
                  </table>
              </tr>
              <tr>
                <td style="width:40%"></td>
                <td style="width:20%; border-bottom:1px solid #333;">
                  <table style="text-align:right;">
                    <tbody>
                      <tr style="border-bottom:1px solid #eee;">
                        <td class="bold-text" style="width:20%">CGST</td>
                        <td style="width:20%">RS.{{$order->total_cgst}}</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="width:40%"></td>
                <td style="width:20%; border-bottom:1px solid #333;">
                  <table style="text-align:right;">
                    <tbody>
                      <tr style="border-bottom:1px solid #eee;">
                        <td class="bold-text" style="width:20%">SGST</td>
                        <td style="width:20%">RS.{{$order->total_sgst}}</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="width:40%"></td>
                <td style="width:20%; border-bottom:1px solid #333;">
                  <table style="text-align:right;">
                    <tbody>
                      <tr style="border-bottom:1px solid #eee;">
                        <td class="bold-text" style="width:20%">Total</td>
                        <td style="width:20%">RS.{{$order->grand_amount}}</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
    </table>
    <table cellpadding="0" cellspacing="0" style="padding-top:50px;">
      <tbody>
        <tr>
          <td class="hline"></td>
        </tr>
        <tr>
          <td style="text-align:center;">Your order will be delivered within 4 working days.</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>