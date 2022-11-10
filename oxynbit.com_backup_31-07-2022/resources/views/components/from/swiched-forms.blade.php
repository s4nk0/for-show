@props(['submit'])


{{--need--}}
{{--$links=[--}}
{{--['btc','Bitcoin'],--}}
{{--['eth','Ethereum'],--}}
{{--['ltc','Litecoin'],--}}
{{--['usd','USD'],--}}
{{--];--}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
    </div>
    <div class="card-body" id="deposits">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @for($i = 0; $i < count($links); $i++)
                <li class="nav-item nav-item-link">
                    <a data-value="{{$links[$i][0]}}" class="nav-link nav-item-icon-{{$links[$i][0]}} {{ ($i == 0) ? "active" : "" }}" data-toggle="tab" href="#tab{{($i+1)}}">{{$links[$i][1]}}</a>
                </li>
            @endfor
        </ul>

        <div class="tab-content">
            @for($i = 0; $i < count($links); $i++)
            <div class="tab-pane fade {{ ($i == 0) ? "active show" : "" }}" id="tab{{($i+1)}}">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        {{ ${"form_".$links[$i][0]} }}
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

