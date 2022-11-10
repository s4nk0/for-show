{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            margin: 0 auto;--}}
{{--        }--}}

{{--        .class{--}}
{{--            width: 50%;--}}

{{--            background: #0a0a0a;--}}
{{--            display: inline;--}}

{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="class">--}}
{{--    test--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
@component('mail::message',['user'=>$user])
    <img style="width: 100%" src="{{asset('/img/email/Frame_1321315121.png')}}" alt="" />
<h1 style="text-align: center;font-size: 32px;line-height: 34px;margin-bottom: 0;font-weight: 600;margin-top: 60px">Вы хотели приобрести эти товары:</h1>

<p style="text-align: center; font-size: 18px; line-height: 34px;font-weight: 400;" >
    Мы сохранили для Вас подборку товаров в одном месте, чтобы <br> Вам было удобнее сделать свой выбор:</p>
<div class="table td-2">
<table >
    <tbody>
    @for($i = 0; $i < count($card); $i+=2)
    <tr><td>@isset($card[$i]) @component('components.email.card', ['card' =>$card[$i]]) @endcomponent @endisset</td><td>@isset($card[$i+1]) @component('components.email.card', ['card' =>$card[$i+1]]) @endcomponent @endisset</td></tr>
    @endfor
    </tbody>
</table>

</div>
<h1 style="text-align: center;padding: 30px;font-weight: 600;font-size: 26px;line-height: 40px;margin: 0">Помимо этого мы подобрали схожие товары, <br> которые возможно вас заинтересуют</h1>

<div class="table td-2">
    <table>
        <tbody>
        @for($i = 0; $i < count($recommended); $i+=2)
            <tr><td>@isset($recommended[$i]) @component('components.email.card', ['card' =>$recommended[$i]]) @endcomponent @endisset</td><td>@isset($recommended[$i+1]) @component('components.email.card', ['card' =>$recommended[$i+1]]) @endcomponent @endisset</td></tr>
        @endfor
        </tbody>
    </table>


</div>

@endcomponent
