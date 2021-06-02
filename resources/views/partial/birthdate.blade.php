<div class="birth-date-row-register m-0">
    <select name="birth_day" id="birth_day" class="form-control mr-2 @if(isset($greyborder)) input-grey-border @endif" @if($required) required @endif autofocus>
        <option value="" selected disabled hidden>Day</option>
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
    <select name="birth_month" id="birth_month" class="form-control @if(isset($greyborder)) input-grey-border @endif" @if($required) required @endif autofocus>
        <option value="" selected disabled hidden>Month</option>
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
    <select name="birth_year" id="birth_year" class="form-control ml-2 @if(isset($greyborder)) input-grey-border @endif"" @if($required) required @endif autofocus>
        <option value="" selected disabled hidden>Year</option>
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
<div class="alert alert-danger invisible" id="birth-date-alert"><p>Make sure that you are choosing valid birth date.</p></div>
<script>
    var dates;

    window.addEventListener('DOMContentLoaded', () => {
        dates = JSON.parse('{!!App\Helpers\Dates::getDates()!!}');
        document.getElementById('birth_month').addEventListener('change', function(){checkDays();});
        document.getElementById('birth_year').addEventListener('change', function(){checkDays();});
    });
    

    function checkDays(){
        let months = document.getElementById('birth_month');
        let days = document.getElementById('birth_day');
        let years = document.getElementById('birth_year');

        let selected_month = months.value;
        let selected_year = years.value;
        let selected_day = days.value;
        if(selected_year){
            // set days if month selected
            if(months.value){
                for (let index = 0; index < dates.length; index++) {
                    let year_data = dates[index];

                    if(year_data.year == selected_year){
                        let month_days = year_data.months[selected_month].days;

                        if(selected_day){

                            if(selected_day > month_days.length){

                                // clear options for selected month days
                                days.innerHTML = "";
                                let default_option = document.createElement("option");
                                default_option.selected = 'selected';
                                default_option.disabled = 'disabled';
                                default_option.hidden = 'hidden';
                                days.add(default_option);

                                // show alert
                                document.getElementById('birth-date-alert').classList.remove('invisible');
                                setTimeout(() => {
                                    document.getElementById('birth-date-alert').classList.add('invisible');
                                }, 3000);

                                // repopulate options
                                for (let day = 1; day < month_days.length; day++) {
                                    let day_info = month_days[day];
                                    var option = document.createElement("option");
                                    option.text = day_info;
                                    option.value = day_info;
                                    days.add(option);
                                }

                            }
 
                        } else {
                            // if day not selected, make sure correct days are displayed
                        }
                        // console.log(days.options);
                        // console.log(year_data.months[selected_month]);
                    }
                }
            }
            // set correct days for all months
        }
    }
</script>