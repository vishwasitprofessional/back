@extends('layouts.front')
@section('content')

<!-- ============================================== HEADER : END ============================================== -->

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
  <div class="container" style="margin-top:200px;">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <!-- <li><a href="{{route('index')}}">Home</a></li>
        <li><a href="{{route('shop')}}">Shop</a></li> -->
      </ul>
    </div>
    <!-- /.breadcrumb-inner -->
  </div>
  <!-- /.container -->
</div>
<div class="row">
			<div class="col-md-12 mycard py-5 text-center">
				<div class="mycards">
					<h4>Thank You for purchasing</h4>
					<a href="{{ route('shop') }}" class="button btn-upper btn-link outer-left-xs mt-5" style="background-color:#88be4c">Continue Shopping</a>
                    <br><br><br><br><br><br>
				</div>
			</div>
		</div>

@endsection