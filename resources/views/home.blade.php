@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


@section('content_header')
    <h1><strong>Sistema Integral de Información de Talento Humano</strong></h1>
@stop

@section('content')

@if(auth()->check() && auth()->user()->role === 'vinculacion')
    <script>
        window.location.href = "{{ url('admin/vinculacion-y-enlace/index') }}";
    </script>
@endif

<style>
  .card-patrimonial-siith {
    background: #1a2238 !important; /* Azul oscuro corporativo de la imagen */
    border-radius: 8px !important;
    position: relative;
    overflow: hidden;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  .card-patrimonial-siith .inner-content {
    padding: 18px 24px 14px 24px;
    position: relative;
    z-index: 2;
  }
  .card-patrimonial-siith .badge-icon {
    color: #e67e22; /* Color naranja de acento */
    font-size: 1.3rem;
    margin-right: 10px;
  }
  .card-patrimonial-siith .title-patrimonial {
    font-size: 1.15rem;
    font-weight: 800;
    letter-spacing: 0.8px;
    color: #ffffff;
    text-transform: uppercase;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
  }
  .card-patrimonial-siith .desc-patrimonial {
    font-size: 0.82rem;
    color: #94a3b8;
    margin-bottom: 0;
    padding-left: 28px;
  }
  /* Ícono semitransparente de fondo a la derecha */
  .card-patrimonial-siith .watermark-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.05);
    z-index: 1;
    pointer-events: none;
  }
  /* Footer / Enlace de acción */
  .card-patrimonial-siith .footer-link {
    display: block;
    background: rgba(0, 0, 0, 0.2);
    color: #cbd5e1 !important;
    text-align: center;
    padding: 8px 0;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    position: relative;
    z-index: 2;
  }
  .card-patrimonial-siith .footer-link:hover {
    background: rgba(0, 0, 0, 0.35);
    color: #ffffff !important;
  }
</style>

<div class="row mb-4">
  <div class="col-md-12">
    <div class="card-patrimonial-siith">
      <!-- Ícono de agua en fondo -->
      <div class="watermark-icon">
        <i class="fas fa-file-signature"></i>
      </div>

      <!-- Contenido Principal -->
      <div class="inner-content">
        <div class="title-patrimonial">
          <i class="fas fa-shield-alt badge-icon"></i> DECLARACIÓN PATRIMONIAL
        </div>
        <p class="desc-patrimonial">
          Módulo oficial de registro, consulta y seguimiento de obligaciones patrimoniales.
        </p>
      </div>

      <!-- Enlace inferior -->
      <a href="{{ route('declaracionPatrimonial') }}" class="footer-link">
        Ingresar al módulo de declaración <i class="fas fa-arrow-right ml-1"></i>
      </a>
    </div>
  </div>
</div>


@auth

@if(auth()->user()->role === 'directivo')

<div class="callout callout-info">
    <h5><i class="fas fa-tools"></i> Dashboard en mantenimiento</h5>
    <p>
        Estamos realizando mejoras para optimizar la experiencia de usuario,
        el rendimiento y la funcionalidad del sistema. Agradecemos su comprensión.
    </p>
</div>


@endif

@if(auth()->user()->role === 'root' || auth()->user()->role === 'admin')


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



{{-- --------------------------------------------------------------------------------------------------------------------------------- --}}

<div class="row mt-2">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>JURISDICCIÓN</strong></h3>
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
                <tr>
                  <td><span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 255, 255, 0.6); margin-right:6px; border-radius:3px;"></span></td>
                  <td style="font-weight: bold;">Total</td>
                  <td>{{$profesionalesJurisdiccion1 + $profesionalesJurisdiccion2 + $profesionalesJurisdiccion3 + $profesionalesJurisdiccion4 + $profesionalesJurisdiccion5 + $profesionalesJurisdiccion6 + $profesionalesJurisdiccion7 + $profesionalesJurisdiccion8 +  $profesionalesJurisdiccion9}}</td>
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
        <h3 class="card-title"><strong>NÓMINAS DE PAGO</strong> </h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6"><canvas id="profesionalesNominaDePago" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas></div>
          <div class="col-md-6">

            <table class="table table-sm small">
        <tbody>

          <!-- 1 -->
          <tr>
              <!-- ASIMI -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(0, 153, 153, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">ASIMI</span>
              </td>
              <td>{{ $nominaAsimilados }}</td>

              <!-- BUR -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 204, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">BUR</span>
              </td>
              <td>{{ $nominaBurocrata }}</td>

              <!-- DIF OC -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(204, 255, 153, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">DIF OC</span>
              </td>
              <td>{{ $nominaDifOc }}</td>
          </tr>

          <!-- 2 -->
          <tr>
              <!-- DIF PS -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 153, 153, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">DIF PS</span>
              </td>
              <td>{{ $nominaDifPs }}</td>

              <!-- EVE -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(0, 204, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">EVE</span>
              </td>
              <td>{{ $nominaEventual }}</td>

              <!-- FAM -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(178, 255, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">FAM</span>
              </td>
              <td>{{ $nominaUmmFam }}</td>
          </tr>

          <!-- 3 -->
          <tr>
              <!-- FED -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">FED</span>
              </td>
              <td>{{ $nominaFederal420 }}</td>

              <!-- FOR -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">FOR</span>
              </td>
              <td>{{ $nominaFormalizadoUno }}</td>

              <!-- FOR 2 -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">FOR 2</span>
              </td>
              <td>{{ $nominaFormalizadoDos }}</td>
          </tr>

          <!-- 4 -->
          <tr>
              <!-- FOR 3 -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">FOR 3</span>
              </td>
              <td>{{ $nominaFormalizadoTres }}</td>

              <!-- 610 -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">610</span>
              </td>
              <td>{{ $nominaPasanteServicioSocial }}</td>

              <!-- HOM -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 153, 204, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">HOM</span>
              </td>
              <td>{{ $nominaHomogado }}</td>
          </tr>

          <!-- 5 -->
          <tr>
              <!-- HON -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 255, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">HON</span>
              </td>
              <td>{{ $nominaHonorarios }}</td>

              <!-- IB -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 204, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">IB</span>
              </td>
              <td>{{ $nominaImssBienestar }}</td>

              <!-- ISSREEI -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 178, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">ISSREEI</span>
              </td>
              <td>{{ $nominaIssreei }}</td>
          </tr>

          <!-- 6 -->
          <tr>
              <!-- PASANTE SP -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 102, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">PASANTE SP</span>
              </td>
              <td>{{ $nominaPasanteSinPago }}</td>

              <!-- RAMO 12 -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 255, 204, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">RAMO 12</span>
              </td>
              <td>{{ $nominaRamoDoce }}</td>

              <!-- REG -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">REG</span>
              </td>
              <td>{{ $nominaRegularizado }}</td>
          </tr>

          <!-- 7 -->
          <tr>
              <!-- SNSP -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(0, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">SNSP</span>
              </td>
              <td>{{ $nominaSNSP }}</td>

              <!-- TAMIZ -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 87, 51, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">TAMIZ</span>
              </td>
              <td>{{ $nominaTamiz }}</td>

              <!-- U013 -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(102, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">U013</span>
              </td>
              <td>{{ $nominau013 }}</td>
          </tr>

          

          <!-- 9 -->
          <tr>
              <!-- UNE -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(204, 153, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">UNE</span>
              </td>
              <td>{{ $nominaUnemes }}</td>

              <!-- UMM -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(178, 255, 102, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">UMM</span>
              </td>
              <td>{{ $nominaUmmFam }}</td>

              <!-- 6MR -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">6MR</span>
              </td>
              <td>{{ $nominaMedicoResidente }}</td>

              <!-- TOTAL -->
              
          </tr>

          <!-- 8 -->
          <tr>
              <!-- UNE -->
              <td>
                  
              </td>
              <td></td>

              <!-- UMM -->
              <td>
                  
              </td>
              <td></td>

              <!-- TOTAL -->
              <td>
                  <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 255, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                  <span style="font-weight: bold;">TOTAL</span>
              </td>
              <td>{{ $nominaRegularizado + $nominaFormalizadoUno + $nominaFormalizadoDos + $nominaFormalizadoTres + $nominaPasanteServicioSocial + $nominaMedicoResidente + $nominaFederal420 + $nominaEventual + $nominaHomogado + $nominaBurocrata + $nominaImssBienestar + $nominaUnemes + $nominaDifPs + $nominaDifOc + $nominaRamoDoce + $nominaPasanteSinPago + $nominaHonorarios + $nominaIssreei + $nominaUmmFam + $nominau013 + $nominaAsimilados + $nominaSNSP + $nominaTamiz}}</td>
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
        <h3 class="card-title"><strong>CONTRATO</strong></h3>
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
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(153, 102, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Asimilados</span>
                    </td>
                    <td>{{$contratoAsimilados}}</td>
                </tr>

                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 159, 64, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Base</span>
                    </td>
                    <td>{{$contratoBase}}</td>
                </tr>

                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(54, 162, 235, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Becas</span>
                    </td>
                    <td>{{$contratoBecas}}</td>
                </tr>

                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 99, 132, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Confianza</span>
                    </td>
                    <td>{{$contratoConfianza}}</td>
                </tr>

                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 205, 86, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Eventual</span>
                    </td>
                    <td>{{$contratoEventual}}</td>
                </tr>

                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(75, 192, 192, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Honorarios</span>
                    </td>
                    <td>{{$contratoHonorarios}}</td>
                </tr>

                <!-- TOTAL -->
                <tr>
                    <td>
                        <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255, 255, 255, 0.6); border-radius:3px; margin-right:6px;"></span>
                        <span style="font-weight: bold;">Total</span>
                    </td>
                    <td>
                        {{ $contratoConfianza + $contratoBase + $contratoEventual + $contratoHonorarios + $contratoBecas + $contratoAsimilados }}
                    </td>
                </tr>

            </tbody>
        </table>


          </div>
        </div>
        
      </div>
    </div>
  </div>

  @if(auth()->user()->role === 'admin')

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>RAMAS</strong></h3>
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
                <tr>
                  <td>
                    <span style="display:inline-block; width:12px; height:12px; background-color: rgba(255,255,255, 0.6); border-radius:3px; margin-right:6px;"></span>
                    <span style="font-weight: bold;">Total</span>
                  </td>
                  <td>{{$ramaPersonalEnFormacion + $ramaAdministrativa + $ramaAFin + $ramaEnfermeria + $ramaMedica + $ramaParamedica}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endif
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
  <div class="col-md-12">
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
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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

@if(auth()->user()->role === 'sistematizaciones')

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

<!-- ---------------------------------------------------------- -->

<!-- ---------------------------------------------------------- -->
@if(auth()->user()->role === 'samuCrum')

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalSamu}}</h3>

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
            <h3>{{$totalSamuBajaTemporal}}</h3>

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
          <h3>{{$totalSamuHombres}}</h3>

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
        <h3>{{$totalSamuMujeres}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoSamu->isEmpty())
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
                      @foreach($profesionalesHonomasticoSamu as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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
@if(auth()->user()->role === 'criCree')

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalCriCree}}</h3>

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
            <h3>{{$totalCriCreeTemporal}}</h3>

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
          <h3>{{$totalCriCreeHombres}}</h3>

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
        <h3>{{$totalCriCreeMujeres}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoCriCree->isEmpty())
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
                      @foreach($profesionalesHonomasticoCriCree as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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
@if(auth()->user()->role === 'ofJurisdiccional')

<h3><strong>Oficina Jurisdiccional</strong></h3>

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalOfJurisidiccional}}</h3>

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
            <h3>{{$totalOfJurisidiccionalBajaTemporal}}</h3>

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
          <h3>{{$totalOfJurisidiccionalHombres}}</h3>

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
        <h3>{{$totalOfJurisidiccionalMujeres}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoOfJurisdiccional->isEmpty())
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
                      @foreach($profesionalesHonomasticoOfJurisdiccional as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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

<!-- ---------------------------------------------------------- -->

<h3><strong>C. S. U. y C. S. R.</strong></h3>

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalOfJurisidiccionalCSUYR}}</h3>

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
            <h3>{{$totalOfJurisidiccionalBajaTemporalCSUYR}}</h3>

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
          <h3>{{$totalOfJurisidiccionalHombresCSUYR}}</h3>

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
        <h3>{{$totalOfJurisidiccionalMujeresCSUYR}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoOfJurisdiccionalCSUYR->isEmpty())
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
                      @foreach($profesionalesHonomasticoOfJurisdiccionalCSUYR as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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


<h3><strong>Hospitales</strong></h3>

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalOfJurisidiccionalHospital}}</h3>

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
            <h3>{{$totalOfJurisidiccionalBajaTemporalHospital}}</h3>

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
          <h3>{{$totalOfJurisidiccionalHombresHospital}}</h3>

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
        <h3>{{$totalOfJurisidiccionalMujeresHospital}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoOfJurisdiccionalHospital->isEmpty())
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
                      @foreach($profesionalesHonomasticoOfJurisdiccionalCSUYR as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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
@if(auth()->user()->role === 'cecosama')

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalCecosama}}</h3>

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
            <h3>{{$totalCecosamaTemporal}}</h3>

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
          <h3>{{$totalCecosamaHombres}}</h3>

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
        <h3>{{$totalCecosamaMujeres}}</h3>

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
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoCecosama->isEmpty())
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
                      @foreach($profesionalesHonomasticoCriCree as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
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

@if(auth()->user()->role === 'ofCentral')
{{-- 
<h3><strong>Jefatura Estatal</strong></h3>

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
  <div class="col-md-12">
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
                              <td>{{ $profesional->ocupacionOficinaCentral->area_uno ?? '' }} - {{ $profesional->ocupacionOficinaCentral->subarea_uno ?? '' }} - {{ $profesional->ocupacionOficinaCentral->programa_uno ?? '' }} - {{ $profesional->ocupacionOficinaCentral->componente_uno ?? '' }} - {{ $profesional->ocupacionOficinaCentral->ocupacion_uno ?? '' }}</td>
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

<h3><strong>SAMU CRUM</strong></h3>

<div class="row mt-3">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalSamuOficinaCentral}}</h3>

              <p>Trabajadores Activos SAMU</p>
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
            <h3>{{$totalSamuBajaTemporalOficinaCentral}}</h3>

            <p>Baja Temporal SAMU</p>
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
          <h3>{{$totalSamuHombresOficinaCentral}}</h3>

          <p>Hombres SAMU</p>
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
        <h3>{{$totalSamuMujeresOficinaCentral}}</h3>

        <p>Mujeres SAMU</p>
      </div>
      <div class="icon">
        <i class="ion-female"></i>
      </div>
    </div>
</div>
</div>



<!-- ---------------------------------------------------- -->

<div class="row mt-3">
  <div class="col-md-12">
      <div class="card">
      <div class="card-header bg-info text-white">
          <h3 class="card-title">Cumpleaños del día</h3>
      </div>
      <div class="card-body">
          @if($profesionalesHonomasticoSamu->isEmpty())
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
                      @foreach($profesionalesHonomasticoSamu as $index => $profesional)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                              <td>{{ $profesional->puesto->area_trabajo ?? 'Sin puesto' }}</td>
                              <td>{{ $profesional->email ?? 'No registrado' }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @endif
      </div>
  </div>

  </div>
</div> --}}

<!-- Estilos auxiliares para toques de diseño modernos -->
<style>
  .section-title {
    font-weight: 700;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .bg-female {
    background-color: #e83e8c !important;
    color: #fff !important;
  }
  .card-birthday {
    border-top: 4px solid #17a2b8;
    border-radius: 8px;
  }
  .table th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    border-top: none;
  }
  .empty-state {
    padding: 30px 15px;
    text-align: center;
    color: #6c757d;
  }
</style>

<!-- ========================================== -->
<!-- SECCIÓN 1: JEFATURA ESTATAL -->
<!-- ========================================== -->
<h3 class="section-title mt-2">
  <i class="fas fa-building text-primary"></i> Jefatura Estatal
</h3>

<div class="row">
  <!-- Activos -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success elevation-2">
      <div class="inner">
        <h3>{{ $profesionalesActivosUnidad }}</h3>
        <p>Trabajadores Activos</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-check"></i>
      </div>
    </div>
  </div>

  <!-- Baja Temporal -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning elevation-2 text-white">
      <div class="inner">
        <h3 class="text-white">{{ $profesionalesBajaTemporalUnidad }}</h3>
        <p class="text-white">Baja Temporal</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-clock"></i>
      </div>
    </div>
  </div>

  <!-- Hombres -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary elevation-2">
      <div class="inner">
        <h3>{{ $profesionalesActivosMasculinoUnidad }}</h3>
        <p>Hombres</p>
      </div>
      <div class="icon">
        <i class="fas fa-mars"></i>
      </div>
    </div>
  </div>

  <!-- Mujeres -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-female elevation-2">
      <div class="inner">
        <h3>{{ $profesionalesActivosFemeninoUnidad }}</h3>
        <p>Mujeres</p>
      </div>
      <div class="icon">
        <i class="fas fa-venus"></i>
      </div>
    </div>
  </div>
</div>

<!-- Tabla Cumpleaños Jefatura -->
<div class="row mt-2 mb-5">
  <div class="col-md-12">
    <div class="card card-birthday shadow-sm">
      <div class="card-header bg-white d-flex align-items-center justify-content-between">
        <h3 class="card-title font-weight-bold text-dark m-0">
          <i class="fas fa-birthday-cake text-danger mr-2"></i> Cumpleaños del día
        </h3>
        <span class="badge badge-info badge-pill">{{ $profesionalesHonomastico->count() }} Cumpleañero(s)</span>
      </div>
      <div class="card-body p-0">
        @if($profesionalesHonomastico->isEmpty())
          <div class="empty-state">
            <i class="fas fa-calendar-day fa-3x text-muted mb-2"></i>
            <p class="m-0 font-weight-light">No hay profesionales que cumplan años hoy en Jefatura Estatal.</p>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover table-striped m-0 align-middle">
              <thead>
                <tr>
                  <th style="width: 50px;" class="text-center">#</th>
                  <th>Nombre completo</th>
                  <th>Puesto / Área</th>
                  <th>Correo Electrónico</th>
                </tr>
              </thead>
              <tbody>
                @foreach($profesionalesHonomastico as $index => $profesional)
                  <tr>
                    <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                    <td>
                      <i class="fas fa-user-circle text-secondary mr-2"></i>
                      <strong>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</strong>
                    </td>
                    <td>
                      <small class="text-muted d-block">
                        {{ $profesional->ocupacionOficinaCentral->area_uno ?? '' }}
                        {{ isset($profesional->ocupacionOficinaCentral->subarea_uno) ? ' • ' . $profesional->ocupacionOficinaCentral->subarea_uno : '' }}
                        {{ isset($profesional->ocupacionOficinaCentral->programa_uno) ? ' • ' . $profesional->ocupacionOficinaCentral->programa_uno : '' }}
                        {{ isset($profesional->ocupacionOficinaCentral->componente_uno) ? ' • ' . $profesional->ocupacionOficinaCentral->componente_uno : '' }}
                        {{ isset($profesional->ocupacionOficinaCentral->ocupacion_uno) ? ' • ' . $profesional->ocupacionOficinaCentral->ocupacion_uno : '' }}
                      </small>
                    </td>
                    <td>
                      @if($profesional->email)
                        <a href="mailto:{{ $profesional->email }}" class="text-primary">
                          <i class="far fa-envelope mr-1"></i> {{ $profesional->email }}
                        </a>
                      @else
                        <span class="text-muted font-italic"><i class="far fa-envelope-open mr-1"></i> No registrado</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- ========================================== -->
<!-- SECCIÓN 2: SAMU CRUM -->
<!-- ========================================== -->
<h3 class="section-title">
  <i class="fas fa-ambulance text-danger"></i> SAMU CRUM
</h3>

<div class="row">
  <!-- Activos SAMU -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success elevation-2">
      <div class="inner">
        <h3>{{ $totalSamuOficinaCentral }}</h3>
        <p>Trabajadores Activos SAMU</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-shield"></i>
      </div>
    </div>
  </div>

  <!-- Baja Temporal SAMU -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning elevation-2 text-white">
      <div class="inner">
        <h3 class="text-white">{{ $totalSamuBajaTemporalOficinaCentral }}</h3>
        <p class="text-white">Baja Temporal SAMU</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-minus"></i>
      </div>
    </div>
  </div>

  <!-- Hombres SAMU -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary elevation-2">
      <div class="inner">
        <h3>{{ $totalSamuHombresOficinaCentral }}</h3>
        <p>Hombres SAMU</p>
      </div>
      <div class="icon">
        <i class="fas fa-mars"></i>
      </div>
    </div>
  </div>

  <!-- Mujeres SAMU -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-female elevation-2">
      <div class="inner">
        <h3>{{ $totalSamuMujeresOficinaCentral }}</h3>
        <p>Mujeres SAMU</p>
      </div>
      <div class="icon">
        <i class="fas fa-venus"></i>
      </div>
    </div>
  </div>
</div>

<!-- Tabla Cumpleaños SAMU -->
<div class="row mt-2 mb-4">
  <div class="col-md-12">
    <div class="card card-birthday shadow-sm">
      <div class="card-header bg-white d-flex align-items-center justify-content-between">
        <h3 class="card-title font-weight-bold text-dark m-0">
          <i class="fas fa-birthday-cake text-danger mr-2"></i> Cumpleaños del día (SAMU)
        </h3>
        <span class="badge badge-info badge-pill">{{ $profesionalesHonomasticoSamu->count() }} Cumpleañero(s)</span>
      </div>
      <div class="card-body p-0">
        @if($profesionalesHonomasticoSamu->isEmpty())
          <div class="empty-state">
            <i class="fas fa-calendar-day fa-3x text-muted mb-2"></i>
            <p class="m-0 font-weight-light">No hay profesionales que cumplan años hoy en SAMU CRUM.</p>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover table-striped m-0 align-middle">
              <thead>
                <tr>
                  <th style="width: 50px;" class="text-center">#</th>
                  <th>Nombre completo</th>
                  <th>Puesto / Área</th>
                  <th>Correo Electrónico</th>
                </tr>
              </thead>
              <tbody>
                @foreach($profesionalesHonomasticoSamu as $index => $profesional)
                  <tr>
                    <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                    <td>
                      <i class="fas fa-user-circle text-secondary mr-2"></i>
                      <strong>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</strong>
                    </td>
                    <td>
                      <span class="badge badge-light border">
                        {{ $profesional->puesto->area_trabajo ?? 'Sin puesto asignado' }}
                      </span>
                    </td>
                    <td>
                      @if($profesional->email)
                        <a href="mailto:{{ $profesional->email }}" class="text-primary">
                          <i class="far fa-envelope mr-1"></i> {{ $profesional->email }}
                        </a>
                      @else
                        <span class="text-muted font-italic"><i class="far fa-envelope-open mr-1"></i> No registrado</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@endif

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
              labels: ['REG','FOR','FOR2','FOR3','610','6MR','FED','EVE','HOM','BUR','IB','UNE','DIF PS', 'DIF OC','RAMO 12','PASANTE SP', 'HON', 'ISSREEI', 'FAM', 'U013','ASIM','SNSP'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$nominaRegularizado}}, {{$nominaFormalizadoUno}}, {{$nominaFormalizadoDos}}, {{$nominaFormalizadoTres}}, {{$nominaPasanteServicioSocial}}, {{$nominaMedicoResidente}}, {{$nominaFederal420}}, {{$nominaEventual}}, {{$nominaHomogado}}, {{$nominaBurocrata}}, {{$nominaImssBienestar}}, {{$nominaUnemes}}, {{$nominaDifPs}},  {{$nominaDifOc}}, {{$nominaRamoDoce}}, {{$nominaPasanteSinPago}}, {{$nominaHonorarios}}, {{$nominaIssreei}}, {{$nominaUmmFam}}, {{$nominau013}}, {{$nominaAsimilados}}, {{$nominaSNSP}}], 
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
                'rgba(178, 255, 102, 0.6)', // UMM
                'rgba(102, 102, 255, 0.6)', // U013
                'rgba(0, 153, 153, 0.6)', // ASIMILADOS
                'rgba(0, 102, 255, 0.6)', // SNSP
                'rgba(255, 87, 51, 0.6)', // TAMIZ

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
                'rgba(178, 255, 102, 1)',
                'rgba(102, 102, 255, 1)',
                'rgba(0, 153, 153, 1)',
                'rgba(0, 102, 255, 1)',
                'rgba(255, 87, 51, 1)'
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
              labels: ['CONFIANZA','BASE','EVENTUAL','HONORARIOS','BECAS','ASIMILADOS'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$contratoConfianza}}, {{$contratoBase}}, {{$contratoEventual}}, {{$contratoHonorarios}}, {{$contratoBecas}}, {{$contratoAsimilados}}], 
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