<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  max-width: 1000px;;
}

#customers td, #customers th {
  border: 2px solid #1e888a;
  padding: 10px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers td:nth-child(odd){color: white;background-color: #86991c;}

#customers tr:hover {background-color: #ddd;}

caption {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #1e888a;
  color: #fff;
}
</style>
</head>
<body>

<table id="customers">
    <caption>Ticket Details</caption>
    <tr>
        <td>Ticket Id:</td>
        <td>{{ $ticketDetails['id'] }}</td>
        <td>CRM Id:</td>
        <td>{{ $ticketDetails['crm_id'] }}</td>
    </tr>
    <tr>
        <td>Ticket Status:</td>
        <td>{{ $ticketDetails['status'] }}</td>
        <td>Ticket Created Time:</td>
        <td>{{ $ticketDetails['created_at'] }}</td>
    </tr>
    <tr>
        <td>Customer Name:</td>
        <td>{{ $ticketDetails->crm['customer_name'] }}</td>
        <td>Customer Mobile No:</td>
        <td>{{ $ticketDetails->crm['customer_contact'] }}</td>
    </tr>
    <tr>
        <td>Division:</td>
        <td>{{ $ticketDetails->crm->district->division['name'] }}</td>
        <td>District:</td>
        <td>{{ $ticketDetails->crm->district['name'] }}</td>
    </tr>
    <tr>
        <td>Address:</td>
        <td>{{ $ticketDetails->crm['address'] }}</td>
        <td>Profession:</td>
        <td>{{ $ticketDetails->crm['profession'] }}</td>
    </tr>
    <tr>
        <td>Department:</td>
        <td>{{ $ticketDetails->crm->department['name'] }}</td>
        <td>Call Remarks:</td>
        <td>{{ $ticketDetails->crm->call_remark['name'] }}</td>
    </tr>
    <tr>
        <td>Query Type:</td>
        <td>{{ $ticketDetails->crm->query_type['name'] }}</td>
        <td>Complain Type:</td>
        <td>{{ $ticketDetails->crm->complain_type['name'] }}</td>
    </tr>
    <tr>
        <td>Agent Name:</td>
        <td>{{ $ticketDetails->crm['agent_name'] }}</td>
        <td>Assigned Person:</td>
        <td>{{ $ticketDetails->user['name'] }}</td>
    </tr>
    <tr>
        <td>Problem Details:</td>
        <td colspan="3">{{ $ticketDetails->crm['verbatim'] }}</td>
    </tr>
</table>

</body>
</html>
