<tr>
<td class="header" style="padding: 23px 0 15px 0;">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
    <tr ><td style="height: 20px; background: #d7d8d9; max-width: 800px; margin: 0 auto;"> </td></tr>
</tr>
