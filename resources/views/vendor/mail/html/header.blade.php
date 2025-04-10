@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
    @if (trim($slot) === 'Laravel')
        <img src="{{ asset('storage/LOGO-35.png') }}" class="logo" alt="S.S. Coahuila" style="height: 80px;">
    @else
        {{ $slot }}
    @endif
        </a>
    </td>
</tr>
