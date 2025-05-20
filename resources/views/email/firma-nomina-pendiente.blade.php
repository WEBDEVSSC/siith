<x-mail::message>

<x-mail::panel>

<p><strong>Firma de Nómina Pendiente</strong></p>
<p>Estimado(a) : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>

<p>Tienes una nómina pendiente por firmar. Por favor ingresa al sistema para revisarla.</p>

<x-mail::button :url="url('firmaCreate')">
    Firmar Nómina
</x-mail::button>

<p><strong>Atentamente</strong></p>
<p>Subdirección de Recursos Humanos</p>

</x-mail::panel>

<x-mail::subcopy>
  <p><small>Secretaría de Salud de Coahuila de Zaragoza</small></p>
</x-mail::subcopy>

</x-mail::message>
