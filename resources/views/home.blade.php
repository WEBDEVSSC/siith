@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


@section('content_header')
    <h1><strong>Sistema Integral de Información de Talento Humano</strong></h1>
@stop

@section('content')

@auth

@if(auth()->user()->role === 'root' || auth()->user()->role === 'admin'|| auth()->user()->role === 'directivo')


<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$profesionalesActivos}}</h3>

              <p>Trabajadores Activos</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i>
            </div>
          </div>
    </div>
    <div class="col-md-3">
      <!-- small box -->
      <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$profesionalesBajaTemporal}}</h3>

            <p>Baja Temporal</p>
          </div>
          <div class="icon">
            <i class="ion-ios-minus"></i>
          </div>
        </div>
  </div>
  <div class="col-md-3">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$profesionalesActivosMasculino}}</h3>

          <p>Hombres</p>
        </div>
        <div class="icon">
          <i class="ion-male"></i>
        </div>
      </div>
</div>
<div class="col-md-3">
  <!-- small box -->
  <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$profesionalesActivosFemenino}}</h3>

        <p>Mujeres</p>
      </div>
      <div class="icon">
        <i class="ion-female"></i>
      </div>
    </div>
</div>
</div>

{{-- --------------------------------------------------------------------------------------------------------------------------------- --}}

<div class="row mt-2">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Jurisdicción</strong></h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <canvas id="profesionalesPorJurisdiccion" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6">
            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J1 - Piedras Negras</td>
                  <td>{{$profesionalesJurisdiccion1}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J2 - Acuña</td>
                  <td>{{$profesionalesJurisdiccion2}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J3 - Sabinas</td>
                  <td>{{$profesionalesJurisdiccion3}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J4 - Monclova</td>
                  <td>{{$profesionalesJurisdiccion4}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J5 - Cuatro Ciénegas</td>
                  <td>{{$profesionalesJurisdiccion5}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J6 - Torreón</td>
                  <td>{{$profesionalesJurisdiccion6}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(0, 204, 102, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J7 - Fco. I. Madero</td>
                  <td>{{$profesionalesJurisdiccion7}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 102, 255, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J8 - Saltillo</td>
                  <td>{{$profesionalesJurisdiccion8}}</td>
                </tr>
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 204, 255, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">J9 - Unidades de Apoyo</td>
                  <td>{{$profesionalesJurisdiccion9}}</td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
        
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Nómina de Pago</strong></h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6"><canvas id="profesionalesNominaDePago" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas></div>
          <div class="col-md-6">

            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">REG</span>
                  </td>
                  <td>{{$nominaRegularizado}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 204, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">IB</span>
                  </td>
                  <td>{{$nominaImssBienestar}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">FOR</span>
                  </td>
                  <td>{{$nominaFormalizadoUno}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(204, 153, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">UNE</span>
                  </td>
                  <td>{{$nominaUnemes}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">FOR 2</span>
                  </td>
                  <td>{{$nominaFormalizadoDos}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 153, 153, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">DIF PS</span>
                  </td>
                  <td>{{$nominaDifPs}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">FOR 3</span>
                  </td>
                  <td>{{$nominaFormalizadoTres}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(204, 255, 153, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">DIF OC</span>
                  </td>
                  <td>{{$nominaDifOc}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">610</span>
                  </td>
                  <td>{{$profesionalesJurisdiccion5}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 255, 204, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">RAMO 12</span>
                  </td>
                  <td>{{$nominaRamoDoce}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">6MR</span>
                  </td>
                  <td>{{$nominaMedicoResidente}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 102, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">PASANTE SP</span>
                  </td>
                  <td>{{$nominaPasanteSinPago}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">FED</span>
                  </td>
                  <td>{{$nominaFederal420}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 255, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">HON</span>
                  </td>
                  <td>{{$nominaHonorarios}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(0, 204, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">EVE</span>
                  </td>
                  <td>{{$nominaEventual}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 178, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">ISSREEI</span>
                  </td>
                  <td>{{$nominaIssreei}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 153, 204, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">HOM</span>
                  </td>
                  <td>{{$nominaHomogado}}</td>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(178, 255, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">UMM</span>
                  </td>
                  <td>{{$nominaUmmFam}}</td>
                </tr>

                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 204, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">BUR</span>
                  </td>
                  <td>{{$nominaBurocrata}}</td>
                </tr>
              </tbody>
            </table>


          </div>
        </div>
        
      </div>
    </div>
  </div>

</div>

<div class="row mt-2">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Tipo de Contrato</strong></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <canvas id="profesionalesContratos" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6">

            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Confianza</span>
                  </td>
                  <td>{{$ramaPersonalEnFormacion}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Base</span>
                  </td>
                  <td>{{$ramaAdministrativa}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Eventual</span>
                  </td>
                  <td>{{$ramaAFin}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Honorarios</span>
                  </td>
                  <td>{{$ramaEnfermeria}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Becas</span>
                  </td>
                  <td>{{$ramaMedica}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Otros</span>
                  </td>
                  <td>{{$ramaParamedica}}</td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
        
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Ramas</strong></h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <canvas id="profesionalesRamas" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6">
            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">En Formación</span>
                  </td>
                  <td>{{$ramaPersonalEnFormacion}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Administrativa</span>
                  </td>
                  <td>{{$ramaAdministrativa}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Afín</span>
                  </td>
                  <td>{{$ramaAFin}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Enfermería</span>
                  </td>
                  <td>{{$ramaEnfermeria}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Médica</span>
                  </td>
                  <td>{{$ramaMedica}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Paramédica</span>
                  </td>
                  <td>{{$ramaParamedica}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
    </div>
  </div>

</div>

{{-- --------------------------------------------------------------------------------------------------------------------------------- --}}

<div class="row mt-2">

  

</div>


<!-- ---------------------------------------------------------- -->


<!-- ---------------------------------------------------------- -->

@endif

<!-- ---------------------------------------------------------- -->
@if(
auth()->user()->role === 'csuyr' || 
auth()->user()->role === 'hospital'|| 
auth()->user()->role === 'ofJurisdiccional'|| 
auth()->user()->role === 'criCree'|| 
auth()->user()->role === 'samuCrum'|| 
auth()->user()->role === 'ofCentral'|| 
auth()->user()->role === 'almacen'|| 
auth()->user()->role === 'psiParras'|| 
auth()->user()->role === 'oncologico'|| 
auth()->user()->role === 'cets'|| 
auth()->user()->role === 'lesp'|| 
auth()->user()->role === 'cesame'|| 
auth()->user()->role === 'ceam'|| 
auth()->user()->role === 'hospitalNino'
)

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$profesionalesActivosUnidad}}</h3>

              <p>Trabajadores Activos</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i>
            </div>
          </div>
    </div>
    <div class="col-md-3">
      <!-- small box -->
      <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$profesionalesBajaTemporalUnidad}}</h3>

            <p>Baja Temporal</p>
          </div>
          <div class="icon">
            <i class="ion-ios-minus"></i>
          </div>
        </div>
  </div>
  <div class="col-md-3">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$profesionalesActivosMasculinoUnidad}}</h3>

          <p>Hombres</p>
        </div>
        <div class="icon">
          <i class="ion-male"></i>
        </div>
      </div>
</div>
<div class="col-md-3">
  <!-- small box -->
  <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$profesionalesActivosFemeninoUnidad}}</h3>

        <p>Mujeres</p>
      </div>
      <div class="icon">
        <i class="ion-female"></i>
      </div>
    </div>
</div>
</div>

<!-- ---------------------------------------------------- -->

<div class="row mt-3">
  <div class="col-md-6">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomastico->isEmpty())
              <p class="text-center">No hay profesionales que cumplan años hoy.</p>
          @else
              <table class="table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Puesto</th>
                          <th>Correo</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($profesionalesHonomastico as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->nombre ?? 'Sin puesto' }}</td>
                              <td>{{ $profesional->email ?? 'No registrado' }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @endif
      </div>
  </div>

  </div>
</div>
   
@endif

<!-- ---------------------------------------------------------- -->

<!-- ---------------------------------------------------------- -->
@if(auth()->user()->role === 'ensenanza')

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$contadorEnsenanza610}}</h3>

              <p>610 - Pasante en Servicio Social</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i>
            </div>
          </div>
    </div>
    <div class="col-md-3">
      <!-- small box -->
      <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$contadorEnsenanza6MR}}</h3>

            <p>6MR - Médico Residente</p>
          </div>
          <div class="icon">
            <i class="ion-android-contacts"></i>
          </div>
        </div>
  </div>
  <div class="col-md-3">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$contadorEnsenanzaPSP}}</h3>

          <p>Pasante - Sin pago</p>
        </div>
        <div class="icon">
          <i class="ion-android-contacts"></i>
        </div>
      </div>
</div>
<div class="col-md-3">
  <!-- small box -->
  <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$contadorEnsenanzaEnfIB}}</h3>

        <p>Pasante ENF - BN</p>
      </div>
      <div class="icon">
        <i class="ion-android-contacts"></i>
      </div>
    </div>
</div>
</div>

<!-- ---------------------------------------------------- -->

<div class="row">
 

    <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Jurisdicción</strong></h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <canvas id="profesionalesPorJurisdiccion" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6">
            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td style="color: rgba(255, 99, 132, 0.6); font-weight: bold;">J1 - Piedras Negras</td>
                  <td>{{$contadorEnsenanzaJ1}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(255, 159, 64, 0.6); font-weight: bold;">J2 - Acuña</td>
                  <td>{{$contadorEnsenanzaJ2}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(255, 205, 86, 0.6); font-weight: bold;">J3 - Sabinas</td>
                  <td>{{$contadorEnsenanzaJ3}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(75, 192, 192, 0.6); font-weight: bold;">J4 - Monclova</td>
                  <td>{{$contadorEnsenanzaJ4}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(54, 162, 235, 0.6); font-weight: bold;">J5 - Cuatro Cienegas</td>
                  <td>{{$contadorEnsenanzaJ5}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(153, 102, 255, 0.6); font-weight: bold;">J6 - Torreón</td>
                  <td>{{$contadorEnsenanzaJ6}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(0, 204, 102, 0.6); font-weight: bold;">J7 - Fco. I. Madero</td>
                  <td>{{$contadorEnsenanzaJ7}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(255, 102, 255, 0.6); font-weight: bold;">J8 - Saltillo</td>
                  <td>{{$contadorEnsenanzaJ8}}</td>
                </tr>
                <tr>
                  <td style="color: rgba(102, 204, 255, 0.6); font-weight: bold;">J9 - Unidades de Apoyo</td>
                  <td>{{$contadorEnsenanzaJ9}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
    </div>
  </div>

  
</div>
   
@endif

<!-- --------------------------------------------------------------- -->

@if(auth()->user()->role === 'sistematizacion')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Ramas</strong></h3>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-md-6">
            <canvas id="profesionalesRamas" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6">
            <table class="table table-sm small">
              <tbody>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">En Formación</span>
                  </td>
                  <td>{{$ramaPersonalEnFormacion}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Administrativa</span>
                  </td>
                  <td>{{$ramaAdministrativa}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Afín</span>
                  </td>
                  <td>{{$ramaAFin}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Enfermería</span>
                  </td>
                  <td>{{$ramaEnfermeria}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Médica</span>
                  </td>
                  <td>{{$ramaMedica}}</td>
                </tr>
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Paramédica</span>
                  </td>
                  <td>{{$ramaParamedica}}</td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
        
        
      </div>
    </div>
  </div>
</div>

@endif

<!-- --------------------------------------------------------------- -->

@endauth

@stop

@include('partials.footer')

@section('css')
    {{-- Estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesPorJurisdiccion').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['J1','J2','J3','J4','J5','J6','J7','J8','J9'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$profesionalesJurisdiccion1}}, {{$profesionalesJurisdiccion2}}, {{$profesionalesJurisdiccion3}}, {{$profesionalesJurisdiccion4}}, {{$profesionalesJurisdiccion5}}, {{$profesionalesJurisdiccion6}}, {{$profesionalesJurisdiccion7}}, {{$profesionalesJurisdiccion8}}, {{$profesionalesJurisdiccion9}}], 
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                    'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                    'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                    'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                    'rgba(54, 162, 235, 0.6)',   // Azul vivo
                    'rgba(153, 102, 255, 0.6)',  // Morado claro
                    'rgba(0, 204, 102, 0.6)',    // Verde menta
                    'rgba(255, 102, 255, 0.6)',  // Fucsia claro
                    'rgba(102, 204, 255, 0.6)'   // Celeste brillante
                  ],
                  borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(0, 204, 102, 1)',
                    'rgba(255, 102, 255, 1)',
                    'rgba(102, 204, 255, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

  <!-- GRAFICA PARA ENSENANZA PASANTES -->

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesPorJurisdiccionEnsenanza').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['J1','J2','J3','J4','J5','J6','J7','J8','J9'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$contadorEnsenanzaJ1}}, {{$contadorEnsenanzaJ2}}, {{$contadorEnsenanzaJ3}}, {{$contadorEnsenanzaJ4}}, {{$contadorEnsenanzaJ5}}, {{$contadorEnsenanzaJ6}}, {{$contadorEnsenanzaJ7}}, {{$contadorEnsenanzaJ8}}, {{$contadorEnsenanzaJ9}}], 
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                    'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                    'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                    'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                    'rgba(54, 162, 235, 0.6)',   // Azul vivo
                    'rgba(153, 102, 255, 0.6)',  // Morado claro
                    'rgba(0, 204, 102, 0.6)',    // Verde menta
                    'rgba(255, 102, 255, 0.6)',  // Fucsia claro
                    'rgba(102, 204, 255, 0.6)'   // Celeste brillante
                  ],
                  borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(0, 204, 102, 1)',
                    'rgba(255, 102, 255, 1)',
                    'rgba(102, 204, 255, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>
<
  <!-- -->

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesNominaDePago').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['REG','FOR','FOR2','FOR3','610','6MR','FED','EVE','HOM','BUR','IB','UNE','DIF PS', 'DIF OC','RAMO 12','PASANTE SP', 'HON', 'ISSREEI', 'UMM'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$nominaRegularizado}}, {{$nominaFormalizadoUno}}, {{$nominaFormalizadoDos}}, {{$nominaFormalizadoTres}}, {{$nominaPasanteServicioSocial}}, {{$nominaMedicoResidente}}, {{$nominaFederal420}}, {{$nominaEventual}}, {{$nominaHomogado}}, {{$nominaBurocrata}}, {{$nominaImssBienestar}}, {{$nominaUnemes}}, {{$nominaDifPs}},  {{$nominaDifOc}}, {{$nominaRamoDoce}}, {{$nominaPasanteSinPago}}, {{$nominaHonorarios}}, {{$nominaIssreei}}, {{$nominaUmmFam}}], 
              backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // REG
                'rgba(255, 159, 64, 0.6)', // FOR
                'rgba(255, 205, 86, 0.6)', // FOR 2
                'rgba(75, 192, 192, 0.6)', // FOR 3
                'rgba(54, 162, 235, 0.6)', // 610
                'rgba(153, 102, 255, 0.6)', // 6MR
                'rgba(255, 102, 255, 0.6)', // FED
                'rgba(0, 204, 102, 0.6)', // EVE
                'rgba(255, 153, 204, 0.6)', // HOM
                'rgba(255, 204, 102, 0.6)', // BUR
                'rgba(102, 204, 255, 0.6)', // IB
                'rgba(204, 153, 255, 0.6)', // UNE
                'rgba(255, 153, 153, 0.6)', // DIF PS
                'rgba(204, 255, 153, 0.6)', // DIF OC
                'rgba(153, 255, 204, 0.6)', // RAMO 12
                'rgba(255, 102, 102, 0.6)', // PASANTE SP
                'rgba(102, 255, 255, 0.6)', // HON
                'rgba(255, 178, 102, 0.6)', // ISSREEI
                'rgba(178, 255, 102, 0.6)'  // UMM
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 102, 255, 1)',
                'rgba(0, 204, 102, 1)',
                'rgba(255, 153, 204, 1)',
                'rgba(255, 204, 102, 1)',
                'rgba(102, 204, 255, 1)',
                'rgba(204, 153, 255, 1)',
                'rgba(255, 153, 153, 1)',
                'rgba(204, 255, 153, 1)',
                'rgba(153, 255, 204, 1)',
                'rgba(255, 102, 102, 1)',
                'rgba(102, 255, 255, 1)',
                'rgba(255, 178, 102, 1)',
                'rgba(178, 255, 102, 1)'
              ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesContratos').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['CONFIANZA','BASE','EVENTUAL','HONORARIOS','BECAS','OTROS'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$contratoConfianza}}, {{$contratoBase}}, {{$contratoEventual}}, {{$contratoHonorarios}}, {{$contratoBecas}}, {{$contratoOtros}}], 
              backgroundColor: [
                'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                'rgba(54, 162, 235, 0.6)',   // Azul vivo
                'rgba(153, 102, 255, 0.6)',  // Morado claro
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
              ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesRamas').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['En Formación','Administrativa','Afin','Enfermeria','Medica','Paramedica'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$ramaPersonalEnFormacion}}, {{$ramaAdministrativa}}, {{$ramaAFin}}, {{$ramaEnfermeria}}, {{$ramaMedica}}, {{$ramaParamedica}}], 
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                    'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                    'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                    'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                    'rgba(54, 162, 235, 0.6)',   // Azul vivo
                    'rgba(153, 102, 255, 0.6)',  // Morado claro
                  ],
                  borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

@stop