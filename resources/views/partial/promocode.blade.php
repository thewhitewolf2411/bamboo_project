<div class="cart-promotional-code">
    <label for="promotional_code" class="mt-4 mb-2">Enter Promotional Code</label>
    <div class="promotional-code-row">
        <input type="text" name="promotional_code" id="promotional_code" class="form-input promotional-code">
        <div class="btn btn-primary apply-promo-code" id="applyPromo">Apply</div>
    </div>
    <div class="promotional-code-message" id="promotional-code-info">
        <p id="promotional-code-info-text" class="text-center mt-1"></p>
    </div>
</div>

<script type="application/javascript">
    if(document.getElementById('applyPromo')){
        document.getElementById('applyPromo').addEventListener('click', function(){
            let promocode = document.getElementById('promotional_code').value;

            $.ajax({
                url: '/cart/sell/promocode',
                type: 'POST',
                data: {
                    _token:     $('meta[name="csrf-token"]').attr('content'),
                    promo_code: promocode
                },
                success: function (response) {
                    if(response.data.pass === true){
                        document.getElementById('promotional-code-info-text').innerHTML = response.data.message;
                        document.getElementById('promotional-info').classList.remove('invisible');
                        document.getElementById('promo-percentage').innerHTML = response.data.percentage;
                        document.getElementById('total-sell-price').innerHTML = '£'+response.data.total;
                    }
                }
            }); 
        });
    }
</script>