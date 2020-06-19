Customers

<table>
    <tr>
        <th>Name</th>
        <th>Company</th>
        <th>User Type</th>
        <th>Default Address</th>
        <th>Default Email Address</th>
        <th>Default Telephone number</th>
        <th></th>
    </tr>
    @foreach($customers as $customer)
    <tr>
        <td>{{ $customer->first_name . " " . $customer->surename }}</td>
        <td>{{ $customer->company_name }}</td>
        <td>@if($customer->type_of_user == 0) Public @endif</td>
        <td>{{ $customer->address . " " . $customer->city }}</td>
        <td>{{ $customer->email }}</td>
        <td>{{ $customer->phone_number }}</td>
        <td><a href="#">Action</a></td>
    </tr>
    @endforeach
</table>