<div class="notifications-list">
    @foreach($notifications as $notification)
    
        <div class="notification-card @if($notification->status === 'alert' && $notification->resolved === false) red-border @endif">
            @if($notification->status === 'alert')
                @if($notification->resolved)
                    <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_tick.svg')}}">
                @else
                    <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                @endif

                {!!$notification->content!!}

                @if(Route::getCurrentRoute()->uri() === 'userprofile')
                    @if($notification->resolved) @else
                    <a href="/userprofile/{{$notification->tradein_id}}" class="notification-action">
                        <p>Take me there</p>
                        <img class="right-link-img" src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}">
                    </a>
                    @endif
                @endif
            @endif
            
            @if($notification->status === 'info')
                <img class="notification-green-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_bell.svg')}}">
                <p class="notification-content @if($notification->status === 'alert') bold @endif">{!!$notification->content!!}</p>

            @endif
        </div>
        <div class="notification-card-border"></div>

    @endforeach
</div>