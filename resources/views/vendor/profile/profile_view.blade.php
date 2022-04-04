@extends('layouts.vendor')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Profile Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='3'><b>Firm Name: </b>{{$vendor->firm_name}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Firm Type: </b>{{$vendor->firm_type}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='3'><b>Firm Address: </b>{{$vendor->firm_address}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Contact Person Name: </b>{{$vendor->contact_person_name}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Contact Person Number: </b>{{$vendor->contact_person_no}}</td>
                                        <td></td>
                                        <td colspan='3'><b>PAN Number: </b>{{$vendor->pan_no}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Godown Address: </b>{{$vendor->godown_address}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Nature of Business: </b>{{$vendor->nature_of_business}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Product type: </b>{{$vendor->product_type}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Brand Name: </b>{{$vendor->brand_name}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Firm Registration No: </b>{{$vendor->firm_registration_no}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Date of Registration: </b>{{$vendor->date_of_registration}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>FSSAI Lic.No: </b>{{$vendor->fssai_lic_no}}</td>
                                        <td></td>
                                        <td colspan='3'><b>GST No: </b>{{$vendor->gst_no}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Year of establishment: </b>{{$vendor->year_of_establishment}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Bank Account Name: </b>{{$vendor->bank_account_name}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Bank Account Number: </b>{{$vendor->bank_account_no}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Bank Name: </b>{{$vendor->bank_name}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Bank Branch Name: </b>{{$vendor->bank_branch_name}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Bank IFSC code: </b>{{$vendor->bank_ifsc_code}}</td>
                                    </tr>

                                </table>
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
    </section>
</div><!-- /.container-fluid -->

<!-- /.content-wrapper -->


@endsection