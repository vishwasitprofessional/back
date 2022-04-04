@extends('layouts.vendor')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->

                        <div class="card-body">
                            <!-- <div class="tab-content"> -->
                            @if(count($errors)>0)
                            <div class='alert alert-danger'>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif<br>
                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{route('vendor-profile-update-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="_method" value="Patch" />
                                    <input type="hidden" name="id" class="form-control {{ $errors->has('body')? 'is-invalid':''}} " value="{{old('id',$vendor->id)}}">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Firm Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="firm_name" class="form-control" placeholder="Firm Name" value="{{old('firm_name',$vendor->firm_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Firm Type</label>
                                        <div class="col-sm-10">
                                            <select name="firm_type" class="form-control">
                                                <option value="">-- Select Firm Type --</option>
                                                <option value="Propreitor" {{$vendor->firm_type=='Propreitor' ? 'selected' : ''}}>Propreitor</option>
                                                <option value="Partnership" {{$vendor->firm_type=='Partnership' ? 'selected' : ''}}>Partnership</option>
                                                <option value="Trust" {{$vendor->firm_type=='Trust' ? 'selected' : ''}}>Trust</option>
                                                <option value="society" {{$vendor->firm_type=='society' ? 'selected' : ''}}>society</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Firm Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="firm_address" class="form-control" placeholder="Firm Address" value="{{old('firm_address',$vendor->firm_address)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Contact Person Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="contact_person_name" class="form-control" placeholder="Contact Person Name" value="{{old('contact_person_name',$vendor->contact_person_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Contact Person Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="contact_person_no" class="form-control" placeholder="Contact Person Number" value="{{old('contact_person_no',$vendor->contact_person_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PAN Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="pan_no" class="form-control" placeholder="PAN Number" value="{{old('pan_no',$vendor->pan_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mfg Unit / Godown Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="godown_address" class="form-control" placeholder="Mfg Unit / Godown Address" value="{{old('godown_address',$vendor->godown_address)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nature of Business</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nature_of_business" class="form-control" placeholder="Nature of Business" value="{{old('nature_of_business',$vendor->nature_of_business)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Product type</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="product_type" class="form-control" placeholder="Product type" value="{{old('product_type',$vendor->product_type)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Brand Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="{{old('brand_name',$vendor->brand_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Brand Logo</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="{{ URL::to('/') }}/public/images/brands/logo/{{$vendor->brand_logo}}" id="output2" alt="..." height="100" width="100">
                                            <input type="hidden" name="old_brand_logo" value="{{$vendor->brand_logo}}" class="form-control">
                                            <input type="file" name="new_brand_logo" id="image2" accept="image/*" class="form-control" onchange="loadFile2(event)">
                                            <script>
                                                var loadFile2 = function(event) {
                                                    var image2 = document.getElementById('output2');
                                                    image2.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output2').slideDown();
                                                };
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Firm Registration No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="firm_registration_no" class="form-control" placeholder="Firm Registration No" value="{{old('firm_registration_no',$vendor->firm_registration_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Date of Registration</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="date_of_registration" class="form-control" placeholder="Date of Registration" value="{{old('date_of_registration',$vendor->date_of_registration)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">FSSAI Lic.No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fssai_lic_no" class="form-control" placeholder="FSSAI Lic.No" value="{{old('fssai_lic_no',$vendor->fssai_lic_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">GST No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gst_no" class="form-control" placeholder="GST No" value="{{old('gst_no',$vendor->gst_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Year of establishment</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="year_of_establishment" class="form-control" placeholder="Year of establishment" value="{{old('year_of_establishment',$vendor->year_of_establishment)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Account Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bank_account_name" class="form-control" placeholder="Bank Account Name" value="{{old('bank_account_name',$vendor->bank_account_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Account Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bank_account_no" class="form-control" placeholder="Bank Account Number" value="{{old('bank_account_no',$vendor->bank_account_no)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="{{old('bank_name',$vendor->bank_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Branch Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bank_branch_name" class="form-control" placeholder="Bank Branch Name" value="{{old('bank_branch_name',$vendor->bank_branch_name)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank IFSC code</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bank_ifsc_code" class="form-control" placeholder="Bank IFSC code" value="{{old('bank_ifsc_code',$vendor->bank_ifsc_code)}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Address proof to be attached</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="{{ URL::to('/') }}/public/images/brands/address_proof_image/{{$vendor->address_proof_image}}" id="output1" alt="..." height="100" width="100">
                                            <input type="hidden" name="old_address_proof_image" value="{{$vendor->address_proof_image}}" class="form-control">
                                            <input type="file" name="new_address_proof_image" id="image1" accept="image/*" class="form-control" onchange="loadFile1(event)">
                                            <script>
                                                var loadFile1 = function(event) {
                                                    var image1 = document.getElementById('output1');
                                                    image1.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output1').slideDown();
                                                };
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Cancelled Cheque</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="{{ URL::to('/') }}/public/images/brands/cancelled_cheque/{{$vendor->cancelled_cheque}}" id="output2" alt="..." height="100" width="100">
                                            <input type="hidden" name="old_cancelled_cheque" value="{{$vendor->cancelled_cheque}}" class="form-control">
                                            <input type="file" name="new_cancelled_cheque" id="image2" accept="image/*" class="form-control" onchange="loadFile2(event)">
                                            <script>
                                                var loadFile2 = function(event) {
                                                    var image2 = document.getElementById('output2');
                                                    image2.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output2').slideDown();
                                                };
                                            </script>
                                        </div>
                                    </div>
                                    @if(Auth::user()->approved_status=='approved')
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection