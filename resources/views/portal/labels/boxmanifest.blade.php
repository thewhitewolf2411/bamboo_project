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
    
        <h2>Box {{$boxname}} manifest</h2>
        <table>
            <tr>
                <th>Box number</th>
                <th>Trade-in Barcode number</th>
                <th>Make/Model</th>
                <th>Grade</th>
                <th>IMEI</th>
            </tr>
            @foreach ($tradeins as $tradein)
            <tr>
                <td>{{$boxname}}</td>
                <td>{{$tradein->barcode}}</td>
                <td>{{$tradein->getProductName($tradein->product_id)}}</td>
                <td>{{$tradein->cosmetic_condition}}</td>
                <td>{!! $tradein->getIMEIBarcode() !!} <br> {{$tradein->imei_number}}</td>
            </tr>
            @endforeach


        </table>

    
    </div>