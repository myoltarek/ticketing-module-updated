<!DOCTYPE html>
<html>
<head>
  <title>CRM</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <script src="https://use.fontawesome.com/3c93f095a2.js"></script> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <script src="{{ asset('/js/fontawesome.js') }}"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .hide{
            display: none;
        }

        .select2-container--default .select2-selection--single{
            padding:6px;
            height: 37px;
            width: auto;
            position: relative;
        }
    </style>
</head>
<body>
  <div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card bg-dark text-white" style="height: 850px;">
        <div class="card-header text-center">
          CRM: Phone No:<mark>{{ $phoneNumber }}</mark> & Agent: <mark>{{ $agent }}</mark>
        </div>
        <div class="card-body">
          <form action="{{ route('crm.store') }}" method="post" class="form-prevent-multiple-submits">
            @csrf
            <input type="hidden" class="form-control" id="" placeholder="" name="agent_name" value="<?php echo $agent; ?>" required>
            <input type="hidden" class="form-control" id="" placeholder="" name="customer_contact" value="<?php echo $phoneNumber; ?>" required>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label">Alternate Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alternate_number" name="alternate_number" value="<?php if(isset($alternate_number))echo $alternate_number; ?>" placeholder="Alternate Customer Number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Customer Gender</label>
                        <div class="col-sm-9">
                            {{ Form::select('customer_gender',['male' => 'Male', 'female' => 'Female'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Gender...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">District</label>
                        <div class="col-sm-9">
                            {{ Form::select('district_id', $districts, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select District...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Address</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="address" name="address" value="<?php if(isset($address))echo $address; ?>" placeholder="Address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Wing</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="wing_name" name="wing_name" value="<?php if(isset($wing_name))echo $wing_name; ?>" placeholder="Wing Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="dealer_division" name="dealer_division" value="<?php if(isset($dealer_division))echo $dealer_division; ?>" placeholder="Dealer/Distributor Division">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Area</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="area" name="area" value="<?php if(isset($area))echo $area; ?>" placeholder="Area">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Territory</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="territory" name="territory" value="<?php if(isset($territory))echo $territory; ?>" placeholder="Territory">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Region</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="region" name="region" value="<?php if(isset($region))echo $region; ?>" placeholder="Region">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Designation</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="designation" name="designation" value="<?php if(isset($designation))echo $designation; ?>" placeholder="Designation">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Distributor Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="distributor_name" name="distributor_name" value="<?php if(isset($distributor_name))echo $distributor_name; ?>" placeholder="Distributor Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Proprietor Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="proprietor_name" name="proprietor_name" value="<?php if(isset($proprietor_name))echo $proprietor_name; ?>" placeholder="Proprietor Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Verification Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="verification_code" name="verification_code" value="<?php if(isset($verification_code))echo $verification_code; ?>" placeholder="Verification Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Caller Type</label>
                        <div class="col-sm-9">
                            {{ Form::select('caller_type',['distributor' => 'Distributor', 'dealer' => 'Dealer', 'retailer' => 'Retailer', 'consumer' => 'Consumer'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Caller Type...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Conversation Details</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="conversation_details" name="conversation_details" placeholder="Conversation Details" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Query Type</label>
                        <div class="col-sm-9">
                            {{ Form::select('query_type_id', $query_types, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Query Type...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Department</label>
                        <div class="col-sm-9">
                            {{ Form::select('department_id', $departments, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Department...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Raise Ticket</label>
                        <div class="col-sm-9">
                            {{ Form::select('raiseTicket',array_merge(['no' => 'NO'], ['yes' => 'YES']), null, array('class'=>'form-control selectTwo', 'placeholder'=>'Raise Ticket', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Call Type</label>
                        <div class="col-sm-9">
                            {{ Form::select('call_type',['inbound' => 'Inbound', 'outbound' => 'Outbound'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Call Type...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-3 col-form-label ">Call Remarks</label>
                        <div class="col-sm-9">
                            {{ Form::select('call_remark_id', $call_remarks, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Please select ...', 'required')) }}
                        </div>
                    </div>
                </div>
            </div>
              <button type="submit" class="btn btn-primary btn-block button-prevent-multiple-submits">
              <i class="spinner fa fa-spinner fa-spin fa-lg"></i> Submit
              </button>
        </form>
        </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  {{-- <script src="{{ asset('/asset/js/select2.js')}}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("i").hide();
    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled','true');
        $("i").show();
    })

    $(".selectTwo").select2({
        allwClear: true
    });
</script>
</body>
</html>
