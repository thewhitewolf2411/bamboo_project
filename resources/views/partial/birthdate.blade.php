<div class="birth-date-row-register m-0">
    <select name="birth_day" id="birth_day" class="form-control mr-2" required autofocus>
        @foreach((App\Helpers\Dates::getDays()) as $day)
            @if(Auth::user())
                @if($day === Auth::user()->getBirthDay())
                    <option selected value="{{$day}}">{{$day}}</option>
                @else
                    <option value="{{$day}}">{{$day}}</option>
                @endif
            @else
                <option value="{{$day}}">{{$day}}</option>
            @endif
        @endforeach
    </select>
    <select name="birth_month" id="birth_month" class="form-control ml-2" required autofocus>
        @foreach((App\Helpers\Dates::getMonths()) as $val => $month)
            @if(Auth::user())
                @if($val === Auth::user()->getBirthDay())
                    <option selected value="{{$val}}">{{$month}}</option>
                @else
                    <option value="{{$val}}">{{$month}}</option>
                @endif
            @else
                <option value="{{$val}}">{{$month}}</option>
            @endif
        @endforeach
    </select>
    <select name="birth_year" id="birth_year" class="form-control ml-2" required autofocus>
        @foreach((App\Helpers\Dates::getYears()) as $val)
            @if(Auth::user())
                @if($val === Auth::user()->getBirthDay())
                    <option selected value="{{$val}}">{{$val}}</option>
                @else
                    <option value="{{$val}}">{{$val}}</option>
                @endif
            @else
                <option value="{{$val}}">{{$val}}</option>
            @endif
        @endforeach
    </select>
</div>