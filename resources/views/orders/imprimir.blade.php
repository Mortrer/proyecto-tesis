@extends('layout.layoutgeneral')

@section('titulo', 'Orden a imprimir')

@section('cuerpo')
    <div class="container py-4 col-9 overflow-scroll">
        <a href="{{ route('order.index') }}" class="btn btn-outline-primary"><i class="bi bi-x-lg"></i></a>
        @can('order.imprimir')
            <div class="container text-center pb-5">
                {{-- <button class="btn btn-outline-primary" id="generarPDF"><i class="bi bi-printer-fill"></i> Imprimir</button> --}}
                <button class="btn btn-outline-primary" id="generarPDF"><i class="bi bi-printer-fill"></i> Generar PDF</button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>"Esta es la información que se utilizara para generar el documento a imprimir".</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endcan
        <div class="contaner">
            @if (session('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="imprimir" id="imprimir">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"> <!-- Columna izquierda -->
                            <h2>Tecnomundo</h2>
                            <p>7ª. Avenida 9-05 zona 2, Sololá</p>
                            <p>+502 7762 5251</p>
                        </div>
                        <div class="col-md-6"> <!-- Columna derecha -->
                            <img src="/Images/LOGOTIPO-TM.png" alt="Logo" class="img-fluid" id="Logo">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container">
                    <div class="container mt-4">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <h5 class="mb-4">Orden de Trabajo</h5>
                                <p class="" style="font-size: 12px"><strong>Número de Orden:</strong></p>
                                <p class="" style="font-size: 12px" id="orden">{{ $query->norden }}</p>
                                <p class="" style="font-size: 12px"><strong>Fecha de Creación:</strong></p>
                                <p style="font-size: 12px" id="creacion">{{ $query->created_at }}</p>
                                <p class="" style="font-size: 12px"><strong>Fecha Estimada de Entrega:</strong></p>
                                <p style="font-size: 12px" id="entrega">{{ $query->fecha_estimada }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-4">Información del Cliente</h5>
                                <p class="" style="font-size: 12px"><strong>Documento de Identificación:</strong></p>
                                @if ($query->cui == null)
                                    <p style="font-size: 12px" id="cui"> Sin especificar</p>
                                @else
                                    <p style="font-size: 12px" id="cui">{{ $query->cui }}</p>
                                @endif
                                <p class="" style="font-size: 12px"><strong>NIT:</strong></p>
                                @if ($query->nit == null)
                                    <p style="font-size: 12px" id="nit"> Sin especificar</p>
                                @else
                                    <p style="font-size: 12px" id="nit"> {{ $query->nit }}</p>
                                @endif
                                <p class="" style="font-size: 12px"><strong>Nombre y apellido:</strong></p>
                                <p style="font-size: 12px" id="nombre">{{ $query->nombre }} {{ $query->apellidos }}</p>
                                <p class="" style="font-size: 12px"><strong>Número de Celular(Contacto):</strong></p>
                                <p style="font-size: 12px" id="celular">{{ $query->ncelular }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="mb-4">Información del Equipo</h4>
                                <p style="font-size: 12px"><strong>Serial del Equipo:</strong></p>
                                <p style="font-size: 12px" id="serial">{{ $query->serial }}</p>
                                <p style="font-size: 12px"><strong>Marca y Modelo:</strong></p>
                                <p style="font-size: 12px" id="marcaModelo">{{ $query->marca }} / {{ $query->modelo }}</p>
                                <label for="" style="font-size: 12px"><strong>Tipo de dispositivo</strong></label>
                                <p style="font-size: 12px" id="tipo"> {{ $query->tipo }}</p>
                                <p><strong>Detalles Físicos del Equipo:</strong></p>
                                <table class="table table-bordered">
                                    <col width="569" />
                                    <tr>
                                        <td height="45" valign="top">
                                            <!-- Agrega los detalles físicos en esta celda de la tabla -->
                                            <p id="fisico">{{ $query->h_detalles }}</p>
                                        </td>
                                    </tr>
                                </table>
                                <p><strong>Problema:</strong></p>
                                <table class="table table-bordered">
                                    <col width="569" />
                                    <tr>
                                        <td height="45" valign="top">
                                            <!-- Agrega el problema en esta celda de la tabla -->
                                            <p id="problema">{{ $query->comentarios }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <!-- Espacio para agregar la parte del consentimiento del cliente -->
                        <div class="row mt-1">
                            <div class="col-12">
                                <p style="font-size: 12px" id="clausula"><strong>"El cliente reconoce y acepta que la
                                        empresa de servicio
                                        técnico no se hace responsable de la pérdida de datos, programas, software o
                                        cualquier información almacenada en el equipo a menos que se acuerde expresamente en
                                        el contrato de servicio. Es responsabilidad exclusiva del cliente respaldar y
                                        proteger sus datos antes de la entrega del equipo para su reparación."</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <p> <strong> Firma cliente:</strong> ___________________________________</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script>
        // Función para generar y abrir el PDF
        //Variables para los datos de la orden de trabajo
        var numeroOrden = document.getElementById('orden').textContent;
        var fechaCreacion = document.getElementById('creacion').textContent;
        var fechaEstimada = document.getElementById('entrega').textContent;

        //Variables para los datos del cliente
        var nombreCliente = document.getElementById('nombre').textContent;
        var numeroCelular = document.getElementById('celular').textContent;
        var numeroCui = document.getElementById('cui').textContent;
        var numeroNit = document.getElementById('nit').textContent;


        //Variables para los datos del equipo

        var numeroSerial = document.getElementById('serial').textContent;
        var marcaModelo = document.getElementById('marcaModelo').textContent;
        var detFisico = document.getElementById('fisico').textContent;
        var problema = document.getElementById('problema').textContent;
        var tipo = document.getElementById('tipo').textContent;
        const logoImage = document.getElementById('logoImage');
        document.getElementById('generarPDF').addEventListener('click', function() {
            // Define el contenido del PDF


            // <p>7ª. Avenida 9-05 zona 2, Sololá</p>
            //                 <p>+502 7762 5251</p>
            var docDefinition = {
                content: [{
                        table: {
                            widths: ['50%', '50%'], // Define el ancho de las dos columnas
                            body: [
                                [{
                                        image: "data:image/png;base64,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", // URL de la imagen
                                        fit: [100, 100], // Ancho y alto de la imagen
                                        alignment: 'left', // Alineación de la imagen a la derecha
                                        margin: [10, 10], // Margen superior e inferior
                                        border: [0, 0, 0, 0]
                                    },
                                    {
                                        text: "",
                                        border: [0, 0, 0, 0]
                                    },
                                ],
                                [{
                                        text: 'Dirección: ' + '7ª. Avenida 9-05 zona 2, Sololá' + '\n' +
                                            'No. teléfono: ' + '+502 7762 5251',
                                        style: 'texto',
                                        margin: [0, 0, 0, 0],
                                        border: [0, 0, 0, 0]
                                    },
                                    {
                                        text: "",
                                        border: [0, 0, 0, 0]
                                    }
                                ]
                            ],
                        },
                    },
                    {
                        text: 'Orden de Trabajo',
                        margin: [0, 50, 0, 0],
                        style: 'header'
                    }, {
                        text: 'No. Orden: ' + numeroOrden + '\n' + 'Fecha de Creación: ' + fechaCreacion +
                            '\n' + 'Fecha estimada de entrega: ' + fechaEstimada,
                        margin: [0, 0, 0, 30],
                        style: 'texto'
                    },
                    {

                        table: {
                            widths: ['50%', '50%'], // Divide la fila en dos columnas de igual tamaño
                            body: [
                                [{
                                        text: 'Información del Cliente:',
                                        style: 'header'
                                    },
                                    {
                                        text: 'Información del Equipo:',
                                        style: 'header'
                                    },
                                ],
                                [{
                                        text: 'Cui: ' + numeroCui + '\n' + 'NIT: ' + numeroNit + '\n' +
                                            'Nombre: ' + nombreCliente +
                                            '\n' + 'No. Celular: ' + numeroCelular,
                                        style: 'content'
                                    },
                                    {
                                        text: 'Serial: ' + numeroSerial + '\n' + 'Marca y Modelo: ' +
                                            marcaModelo + '\n' + 'Tipo de dispositivo: ' + tipo,
                                        style: 'content'
                                    },
                                ],
                            ],
                        },
                        margin: [0, 0, 0, 30]
                    },
                    {
                        text: 'Observaciones',
                        style: 'header'
                    },
                    {
                        canvas: [{
                            type: 'line',
                            x1: 0,
                            y1: 0,
                            x2: 520, // Cambia estos valores según tus necesidades
                            y2: 0,
                            lineWidth: 2, // Grosor de la línea
                            lineColor: '#000', // Color de la línea (puede ser un código de color o nombre)
                            // margin: [0, 10, 0, 10]
                        }]
                    }, {
                        text: detFisico,
                        margin: [0, 0, 0, 20],
                        style: 'texto'
                    },
                    {
                        text: 'Problema',
                        magin: [0, 0, 0, 0],
                        style: 'header'
                    },
                    {
                        canvas: [{
                            type: 'line',
                            x1: 0,
                            y1: 0,
                            x2: 520, // Cambia estos valores según tus necesidades
                            y2: 0,
                            lineWidth: 2, // Grosor de la línea
                            lineColor: '#000', // Color de la línea (puede ser un código de color o nombre)
                            // margin: [0, 10, 0, 10]
                        }]
                    },
                    {
                        text: problema,
                        margin: [0, 0, 0, 60],
                        style: 'texto'
                    },
                    {
                        text: '"El cliente reconoce y acepta que la empresa de servicio técnico no se hace responsable de la pérdida de datos, programas, software o cualquier información almacenada en el equipo a menos que se acuerde expresamente en el contrato de servicio. Es responsabilidad exclusiva del cliente respaldar y proteger sus datos antes de la entrega del equipo para su reparación."',
                        margin: [0, 0, 0, 70],
                        style: 'texto',
                        alignment: 'justify',
                    },
                    {
                        canvas: [{
                            type: 'line',
                            x1: 150, // Inicio de la línea en el eje X
                            y1: 0,
                            x2: 375, // Fin de la línea en el eje X
                            y2: 0,
                            lineWidth: 2, // Grosor de la línea
                            lineColor: '#000', // Color de la línea (puede ser un código de color o nombre)
                            margin: [70, 10, 70,
                                0
                            ], // Margen superior, derecho, inferior e izquierdo
                        }, ]
                    },
                    {
                        text: 'Firma Cliente: ',
                        style: 'centerFirma',
                    },
                    // Agrega más contenido aquí
                ],
                styles: {
                    // Estilos opcionales para personalizar el texto
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 5, 0, 5]
                    },
                    texto: {
                        fontSize: 12,
                    },
                    headercontent: {
                        fontSize: 12,
                        margin: [0, 0, 0, 10]
                    },
                    centerFirma: {
                        alignment: 'center',
                        fontSize: 12,
                        bold: true,
                    }
                },
            };

            // Crea el PDF
            var pdf = pdfMake.createPdf(docDefinition);

            // Abre el PDF para imprimirlo
            pdf.open();
        });
    </script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
