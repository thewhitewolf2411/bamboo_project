
<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>
<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>
<p>{{$user->first_name}} {{$user->last_name}}</p>
<p style='white-space: nowrap;'>{{$deladdress}}</p>
<br><br>
<p>Order#{{$tradein->barcode}} {{$tradein->created_at}}</p>
<p>Dear {{$user->first_name}} {{$user->last_name}}</p>
<p>Thank you very much for using Bamboo Recycle to recycle your mobile device(s). This package contains your TradePack which you can use to post your recycled device(s) back to Bamboo. Please follow the instructions below on how toreturn your recycled device(s) to Bamboo:</p>
    <ol>
        <li>Gather your recycled device(s) and remove any sim cards or memory cards from thedevice(s).</li>
        <li>Place the device(s) into the Trade Pack that you received from Bamboo with this package. (Please rememberwe only require the handset, unless of course the device you're recycling is brand new and boxed.)</li>
        <li>Next, seal the Trade Pack by folding over the sticky flap at the top.</li>
        <li>Finally, you must then place the Freepost Label, found on the bottom left of this letter, onto the front of the TradePack then post your Trade Pack back to Bamboo!</li>
    </ol>
<p>Once your recycled device(s) are received by Bamboo you will be sent an email confirming this. Your device(s) will thenbe tested to make sure they match the conditions that were set when placing the order. After each device has beensuccessfully tested you will receive a final email confirming payment for the device using the method that you selected.(Please note: Payment will be made on a per device basis.)<br>If you have any problems returning your device(s) please view the FAQs section on our website or contact us directly byemailing customersupport@bamboorecycle.com with your enquiry.</p>
<p>Kind Regards,</p>
<p>Bamboo Mobile</p>
<h3>Freepost return address</h3>
<div style='clear:both; position:relative; display:flex;'>
    <div style='width:190pt; height:150px;' >
                            <p>FREEPOST 555880PR</p>
                            <p>Bamboo Recycle (9100)</p>
                            <p>C/O Bamboo Distribution Ltd</p>
                            <p>Unit 1, I.O Centre</p>
                            <p>Lea Road</p>
                            <p>Waltham Abbey</p>
                            <p>Hertfordshire</p>
                            <p>EN9 1AS</p>
                            <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>{!!$barcode!!}</div><p>{{$tradein->barcode}}</p></div>
    </div>
    <div style='margin-left:200pt; margin-top:-150px; width:190pt; height:150px;'>
                            <p>FREEPOST 555880PR</p>
                            <p>Bamboo Recycle (9100)</p>
                            <p>C/O Bamboo Distribution Ltd</p>
                            <p>Unit 1, I.O Centre</p>
                            <p>Lea Road</p>
                            <p>Waltham Abbey</p>
                            <p>Hertfordshire</p>
                            <p>EN9 1AS</p>
                            <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>{!!$barcode!!}</div><p>{{$tradein->barcode}}</p></div>
    </div>
</div>