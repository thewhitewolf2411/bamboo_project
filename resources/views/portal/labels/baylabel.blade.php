<style>
    @page{
        margin:1cm;
    }
</style>
    
    <div style="margin-left:15%;">
        {!!$bay->getTrolleyBarcode()!!}
    </div>

    <div style='text-align:center;'>
        <p style='margin:auto;'>{{$bay->trolley_name}}</p><br>
        <p style="margin: 0 auto; margin-top:0.5cm; font-weight:600;text-decoration: underline; font-size:14pt;">{{$bay->trolley_name}}</p>
    </div>
    