<title>Portal</title>

<form method="POST" action="/portal/payments/setforfc/apply" style="padding: 10px">
    @csrf
    <h2>Make tradein ready for FC batch</h2>
    <label for="tradein">Tradein barcode:</label>
    <input type="text" name="tradein" required>
    <button type="submit">Apply</button>
</form>

@if(Session::has('success'))
    <h3 style="padding-left: 10px">{!!Session::get('success')!!}</h3>
@endif
@if(Session::has('fail'))
    <h3 style="padding-left: 10px">{!!Session::get('fail')!!}</h3>
@endif