<style>
    @page{
        margin:5%;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        border: 1px solid black;
    }

    td, th {
        padding: 8px;
        border: 1px solid black;
        text-align: center
    }

    th{
        background: #C0C0C0;
    }

</style>
    
    <div style='text-align:center;'>
    
        <h2>Box summary</h2>
        <h3>Box no: {{$boxname}}</h3>
        <h3>Total Number of Devices: {{$box->number_of_devices}}</h3>

        <table>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Qty</th>
            </tr>
            @foreach ($tradeins as $tradein)
            <tr>
                <td>{{$brand}}</td>
                <td>{{$tradein[1]}}</td>
                <td>{{$tradein[2]}}</td>
            </tr>
            @endforeach
            <tr>
                <th></th>
                <th></th>
                <th><strong>Total</strong><br>{{$box->number_of_devices}}</th>
            </tr>

        </table>

    
    </div>