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
                        <label for="Customer_name" class="col-sm-2 col-form-label">Customer Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label">Alternate Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Customer Number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Customer Gender</label>
                        <div class="col-sm-10">
                            {{-- {{ Form::label('Customer Gender', array('class' => 'col-sm-2 col-form-label')) }} --}}
                            {{ Form::select('customer_gender',['male' => 'Male', 'female' => 'Female'], null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">District</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Wing</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Division</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Area</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Teritory</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Region</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Designation</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Distributor Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Proprietor Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Verification Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Caller Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Conversation Detail</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Query Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Department</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Raise Ticket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Call Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-sm-2 col-form-label ">Call Remarks</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group row col-md-6">
                    <label for="Customer_name" class="col-sm-2 col-form-label ">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($customer_name))echo $customer_name; ?>" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group row col-md-6">
                    <label for="Customer_name" class="col-sm-2 col-form-label ">Alternate Number</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="altername_number" name="altername_number" value="<?php if(isset($altername_number))echo $altername_number; ?>" placeholder="Altername number">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
                    {{ Form::label('Customer Gender') }}
                    {{ Form::select('customer_gender',['male' => 'Male', 'female' => 'Female'], null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
                <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
                    {{ Form::label('District Name') }}
                    {{ Form::select('district_id', $districts, null, array('class'=>'form-control','id' => 'selectTwo', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
            </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php if(isset($address))echo $address; ?>" placeholder="Address" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="profession">Profession</label>
                  <input type="text" class="form-control" id="profession" name="profession" value="<?php if(isset($profession))echo $profession; ?>" placeholder="Profession" required>
                </div>
                <div class="form-group col-md-3">

                    {{ Form::label('Query Type') }}
                    {{ Form::select('query_type_id', $query_types, null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('Department Name') }}
                    {{ Form::select('department_id', $departments, null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
                <div class="form-group col-md-3">
                  {{ Form::label('Complain Type') }}
                  {{ Form::select('complain_type_id', $complain_types, null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  {{ Form::label('Call Remarks') }}
                  {{ Form::select('call_remark_id', $call_remarks, null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required')) }}
                </div>
                <div class="form-group col-md-6">
                  <label for="raiseTicket">Raise Ticket</label>
                  <select name="raiseTicket" id="raiseTicket" class="form-control" required>
                    <option value="No">No</option>
                    <option value="yes">Yes</option>
                  </select>

                </div>
              </div>
              <div class="form-group">
                <label for="verbatim">Verbatim</label>
                <input type="text" class="form-control" id="verbatim" name="verbatim" placeholder="Enter Verbatim">
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

    $("#selectTwo").select2({
        allwClear: true
    });
</script>
</body>
</html>
