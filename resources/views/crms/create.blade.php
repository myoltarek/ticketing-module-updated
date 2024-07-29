<!DOCTYPE html>
<html>
<head>
  <title>CRM</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/asset/style.css">
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
        .show_btn{
            background-color: #008CBA;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            width: 80px;
            height: 30px;
            backdrop-filter: blur(50px);
            border: 1px solid #2f3335;
            border-radius: 2rem;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .close_btn{
            background-color: #f44336;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            width: 80px;
            height: 30px;
            backdrop-filter: blur(50px);
            border: 1px solid #2f3335;
            border-radius: 2rem;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .card{
            border: 2px solid rgba(52, 53, 53, 1);
        }
        .card .crm-header{
            background:  rgba(52, 53, 53, 1);
            color: #fff;
        }

        .card .crm-header input{
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('/img/telephone-auricular-with-cable.png');
            background-position: 10px 5px;
            background-repeat: no-repeat;
            padding: 5px 10px 5px 40px;
        }

        .msg{
            padding: 20px;
            background-color: #4BB543;
            color: white;
        }
        .errorMsg{
            padding: 20px;
            background-color: #f44336;
            color: white;
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
        <div class="card" style="height: 100%;">
            <div class="card-header crm-header text-center">
                Phone No:  <input type="text" class="phone_show_input" value="{{ $phoneNumber }}" width="100px" readonly> & Agent: <span class="badge badge-danger">{{ $agent }}</span>
            </div>
            <div class="card-body">
            <form action="{{ route('crm.store') }}" method="post" class="form-prevent-multiple-submits">
                @csrf
                <input type="hidden" class="form-control" id="agent_name" placeholder="" name="agent_name" value="<?php echo $agent; ?>" required>
                <input type="hidden" class="form-control" id="customer_contact" placeholder="" name="customer_contact" value="<?php echo $phoneNumber; ?>" required>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label">Customer Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if(isset($crmLast->customer_name))echo $crmLast->customer_name; ?>" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alternate_number" class="col-sm-3 col-form-label">Alternate Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alternate_number" name="alternate_number" value="<?php if(isset($crmLast->alternate_number))echo $crmLast->alternate_number; ?>" placeholder="Alternate Customer Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_gender" class="col-sm-3 col-form-label ">Customer Gender</label>
                            <div class="col-sm-9">
                                {{ Form::select('customer_gender',['male' => 'Male', 'female' => 'Female'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Gender...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="districts" class="col-sm-3 col-form-label ">District</label>
                            <div class="col-sm-9">
                                {{ Form::select('district_id', $districts, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select District...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label ">Address</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="address" name="address" value="<?php if(isset($crmLast->address))echo $crmLast->address; ?>" placeholder="Address" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wing_name" class="col-sm-3 col-form-label ">Wing</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="wing_name" name="wing_name" value="<?php if(isset($wing_name))echo $wing_name; ?>" placeholder="Wing Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dealer_division" class="col-sm-3 col-form-label ">Division</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dealer_division" name="dealer_division" value="<?php if(isset($dealer_division))echo $dealer_division; ?>" placeholder="Dealer/Distributor Division">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area" class="col-sm-3 col-form-label ">Area</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="area" name="area" value="<?php if(isset($area))echo $area; ?>" placeholder="Area">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="territory" class="col-sm-3 col-form-label ">Territory</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="territory" name="territory" value="<?php if(isset($territory))echo $territory; ?>" placeholder="Territory">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="region" class="col-sm-3 col-form-label ">Region</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="region" name="region" value="<?php if(isset($region))echo $region; ?>" placeholder="Region">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-sm-3 col-form-label ">Designation</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="designation" name="designation" value="<?php if(isset($designation))echo $designation; ?>" placeholder="Designation">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="distributor_name" class="col-sm-3 col-form-label ">Distributor Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="distributor_name" name="distributor_name" value="<?php if(isset($distributor_name))echo $distributor_name; ?>" placeholder="Distributor Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="proprietor_name" class="col-sm-3 col-form-label ">Proprietor Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="proprietor_name" name="proprietor_name" value="<?php if(isset($proprietor_name))echo $proprietor_name; ?>" placeholder="Proprietor Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verification_code" class="col-sm-3 col-form-label ">Verification Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="verification_code" name="verification_code" value="<?php if(isset($verification_code))echo $verification_code; ?>" placeholder="Verification Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="caller_type" class="col-sm-3 col-form-label ">Caller Type</label>
                            <div class="col-sm-9">
                                {{ Form::select('caller_type',['distributor' => 'Distributor', 'dealer' => 'Dealer', 'retailer' => 'Retailer', 'consumer' => 'Consumer'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Caller Type...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="conversation_details" class="col-sm-3 col-form-label ">Conversation Details</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="conversation_details" name="conversation_details" placeholder="Conversation Details" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="query_type" class="col-sm-3 col-form-label ">Query Type</label>
                            <div class="col-sm-9">
                                {{ Form::select('query_type_id', $query_types, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Query Type...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="complain_type" class="col-sm-3 col-form-label ">Complain Type</label>
                            <div class="col-sm-9">
                                {{ Form::select('complain_type_id', $complain_types, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Complain Type...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-sm-3 col-form-label ">Department</label>
                            <div class="col-sm-9">
                                {{ Form::select('department_id', $departments, null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Department...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="raiseTicket" class="col-sm-3 col-form-label ">Raise Ticket</label>
                            <div class="col-sm-9">
                                {{ Form::select('raiseTicket',array_merge(['no' => 'NO'], ['yes' => 'YES']), null, array('class'=>'form-control selectTwo', 'placeholder'=>'Raise Ticket', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="call_type" class="col-sm-3 col-form-label ">Call Type</label>
                            <div class="col-sm-9">
                                {{ Form::select('call_type',['inbound' => 'Inbound', 'outbound' => 'Outbound'], null, array('class'=>'form-control selectTwo', 'placeholder'=>'Select Call Type...', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="call_remarks" class="col-sm-3 col-form-label ">Call Remarks</label>
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
        <div class="card mt-3">
            <div id="ticketCloseMsg"></div>
            <div class="card-body">
                <form id="form" name="form" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" name="select_date" id="datepicker" class="form-control input-sm dt_pick" placeholder="Select Date" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" name="ticket_id" id="ticket_id" class="form-control input-sm" placeholder="Enter Ticket Id" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {{ Form::select('ticket_type',['NEW' => 'NEW', 'WIP' => 'Work In Progress', 'ANSWERED' => 'ANSWERED'], null, array('class'=>'form-control selectTwo','id' => 'ticket_type','placeholder'=>'Select Ticket Type', 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary center-align" onClick="get_ticket_history(this.value);" style="padding: 5px 65px;"> Search </button>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr style="margin-top: 0px;">
                <div id="ticket_info">
                    <table id= "table" class="table table-bordered" style="width:100%">
                        <thead>
                            <th>Ticket Id</th>
                            <th>Agent</th>
                            <th>Customer Name</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>

                      </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ticketDetailsModal" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ticketDetailsModalId">Ticket Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <table id= "showTable1" class="table table-bordered"">
                                    <thead class="text-center">
                                        <span class="badge badge-warning">Customer Info</span>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table id= "showTable2" class="table table-bordered"">
                                    <thead class="text-center">
                                        <span class="badge badge-warning">Ticket Details</span>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <label><strong>Comments</strong> <i class="fas fa-comment-alt ml-1"></i></label>
                        <div class="comment-section" id="comment-section"></div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script>
    $(".spinner").hide();
    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled','true');
        $("i").show();
    })

    $(".selectTwo").select2({
        allwClear: true
    });

    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    function get_ticket_history(type){
        let values = {
                // "phone": document.getElementById("cus_phone_number").value,
                "ticket_id" : document.getElementById("ticket_id").value,
                "ticket_type" : document.getElementById("ticket_type").value,
                "created_at": document.getElementById("datepicker").value
        };
        var dataString ='';

        var i = 0;
        for (var key in values) {

            if(values[key] != "" && i != 0){
                dataString += '&'+key+'='+ values[key];
            }
            if(values[key] != "" && i === 0){
                dataString += key+'='+ values[key];
                i++;
            }
        }

        if (values.created_at == "" && values.ticket_type == "" && values.ticket_id == "") {
            alert("Please Enter At Least One Value");
        } else {
            $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketByAjax') }}",
                data: dataString,
                cache: false,
                success: function(data) {
                    $('#table tbody').empty();
                        var tr;
                        if(data.length != 0){
                            for (var i = 0; i < data.length; i++) {
                                tr = $('<tr/>');
                                tr.append("<td>" + data[i].id + "</td>");
                                tr.append("<td>" + data[i].crm.agent_name + "</td>");
                                tr.append("<td>" + data[i].crm.customer_name + "</td>");
                                tr.append("<td>" + data[i].crm.verbatim + "</td>");
                                tr.append("<td>" + data[i].status + "</td>");
                                tr.append("<td>" + data[i].created_at + "</td>");
                                tr.append("<td><button class='show_btn' onclick='showModal("+data[i].id+")' type='submit'>Show</button>"+(data[i].status != 'CLOSED' ? "<button class='close_btn' onclick='closeTicket("+data[i].id+")' type='submit' data-id='"+data[i].id+"'>Close</button>" : "")+"</td>");
                                // tr.append("<td><button class='close_btn' onclick='closeTickettest(this)' type='submit' data-id='"+data[i].id+"'>Close</button></td>");
                                $('#table tbody').append(tr);
                            }
                        }else{
                            tr = $('<tr/>');
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+'No Data Found'+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            $('#table tbody').append(tr);
                        }

                    }
            });
        }
        return false;
    }

    function showModal(id){
        $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketByAjaxByID') }}",
                data: {ticket_id: id},
                cache: false,
                success: function(data) {
                    console.log(data);
                    $('#showTable1').empty();
                        var tr1;
                        tr1 = $('<tr/>');
                        tr1.append("<tr>" +"<td width='30%'><label>Crm Id</label></td>"+"<td width='30%'>"+data.crm_id+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Customer Name</label></td>"+"<td width='30%'>"+data.crm.customer_name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Phone no</label></td>"+"<td width='30%'>"+data.crm.customer_contact+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Division</label></td>"+"<td width='30%'>"+data.crm.district.division.name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>District</label></td>"+"<td width='30%'>"+data.crm.district.name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Address</label></td>"+"<td width='30%'>"+data.crm.address+"</td>"+"</tr>");
                    $('#showTable1').append(tr1);

                    $('#showTable2').empty();
                        var tr2;
                        tr2 = $('<tr/>');
                        tr2.append("<tr>" +"<td width='30%'><label>Ticket Id</label></td>"+"<td width='30%'>"+data.id+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Call Type</label></td>"+"<td width='30%'>"+data.crm.call_type+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Query Type</label></td>"+"<td width='30%'>"+data.crm.query_type.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Complain Type</label></td>"+"<td width='30%'>"+data.crm.complain_type.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Department</label></td>"+"<td width='30%'>"+data.crm.department.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Ticket Status</label></td>"+"<td width='30%'>"+data.status+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Customer Query</label></td>"+"<td width='30%'>"+data.crm.verbatim+"</td>"+"</tr>");
                    $('#showTable2').append(tr2);
                    $('#comment-section').empty();
                    if(data.ticket_response.length != 0){
                        for(var j=0 ; j< data.ticket_response.length ; j++){
                            var html = '<div class="container-fluid mt-1">';
                            html += '<div class="row">';
                            html += '<div class="col-sm-1">';
                            html += '<div class="user_avatar">';
                            html += '<img src="{{ asset('/img/profile.png') }}" class="" alt="User Image">';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="col-sm-11">';
                            html += '<div class="comment_body">';
                            html += "<p>"+ data.ticket_response[j].response+"</p>";
                            html += '</div>';
                            html += '<div class="comment_toolbar">';
                            html += '<div class="comment_details">';
                            html += '<ul>';
                            html += "<li>"+"<i class='fa fa-clock mr-1'></i>"+ data.ticket_response[j].created_time+"</li>";
                            html += "<li>"+"<i class='fa fa-calendar mr-1'></i>"+ data.ticket_response[j].created_date+"</li>";
                            html += "<li>"+"<i class='fa fa-pencil mr-1'></i>"+ data.ticket_response[j].user.name+"</li>";
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            $('#comment-section').append(html);
                        }
                    }else{
                        $('#comment-section').append("Nothing to show");
                    }

                }

            });
        $('#ticketDetailsModal').modal("show");
    }

    function closeTicket(id){
        var result = confirm("Want to close?");
        if(result){
            $(document).on('click', '.close_btn', function(){
                $(this).parents('tr').remove();
            });
            $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketCloseByAjax') }}",
                data: {ticket_id: id, action: 'Send to close'},
                cache: false,
                success: function(data) {
                    $('#ticketCloseMsg').html("<div class='msg'><strong>Success!</strong>Ticket closed successfully</div>").fadeIn('slow') //also show a success message
                    $('#ticketCloseMsg').delay(5000).fadeOut('slow');
                }
            });
        }

    }

</script>
</body>
</html>
