<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        /* Estilos generales */
        body { 
            font-family: DejaVu Sans, Arial, sans-serif; 
            font-size: 10px; 
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        /* Encabezado con logo */
        .header {
            border-bottom: 3px solid #005850;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .company-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .logo-container {
            text-align: left;
        }
        
        .logo {
            max-width: 150px;
            max-height: 80px;
        }
        
        .company-details {
            text-align: right;
            flex-grow: 1;
            margin-left: 20px;
        }
        
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #005850;
            margin: 0;
        }
        
        .company-slogan {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }
        
        /* Información del reporte */
        .report-info {
            text-align: center;
            margin: 15px 0;
        }
        
        .report-title {
            font-size: 16px;
            font-weight: bold;
            color: #005850;
            margin: 5px 0;
        }
        
        .report-details {
            font-size: 10px;
            color: #666;
            margin: 3px 0;
        }
        
        /* Tabla de datos */
        .table-container {
            margin-top: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 9px;
        }
        
        th {
            background-color: #005850;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        td {
            padding: 6px 5px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e9ecef;
        }
        
        /* Pie de página */
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 8px;
        }
        
        .page-info {
            text-align: right;
            font-size: 8px;
            color: #999;
            margin-top: 5px;
        }
        
        /* Estados y colores */
        .status-active {
            color: #28a745;
            font-weight: bold;
        }
        
        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }
        
        .warning {
            color: #ffc107;
            font-weight: bold;
        }
        
        /* Utilidades */
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-bold {
            font-weight: bold;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Encabezado con Logo -->
    <div class="header">
        <div class="company-info">
            <div class="logo-container">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo Empresa">
                @elseif(file_exists(public_path('images/logo.jpg')))
                    <img src="{{ public_path('images/logo.jpg') }}" class="logo" alt="Logo Empresa">
                @else
                    <div style="border: 1px solid #005850; padding: 10px; text-align: center;">
                        <strong>LOGO EMPRESA</strong><br>
                        <small>Inventario TI</small>
                    </div>
                @endif
            </div>
            <div class="company-details">
                <h1 class="company-name">NOMBRE DE LA EMPRESA</h1>
                <p class="company-slogan">Sistema de Gestión de Inventario TI</p>
                <p class="company-slogan">Tel: (000) 000-0000 | Email: info@empresa.com</p>
            </div>
        </div>
    </div>

    <!-- Información del Reporte -->
    <div class="report-info">
        <h2 class="report-title">{{ $titulo }}</h2>
        <div class="report-details">
            <strong>Generado el:</strong> {{ $fechaGeneracion }} | 
            <strong>Total de registros:</strong> {{ count($data) }} |
            <strong>Página:</strong> <span class="page-number"></span>
        </div>
    </div>

    <!-- Tabla de Datos -->
    @if(count($data) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        @foreach($columnas as $columna)
                            @php
                                // Reemplazar "Sucursal" por "Sucursal/Área"
                                $columnaDisplay = $columna === 'Sucursal' ? 'Sucursal/Área' : $columna;
                            @endphp
                            <th>{{ $columnaDisplay }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $fila)
                        @if($index > 0 && $index % 25 == 0)
                            <!-- Salto de página cada 25 registros -->
                            </tbody>
                            </table>
                            </div>
                            <div class="page-break"></div>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            @foreach($columnas as $columna)
                                                @php
                                                    $columnaDisplay = $columna === 'Sucursal' ? 'Sucursal/Área' : $columna;
                                                @endphp
                                                <th>{{ $columnaDisplay }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                        @endif
                        <tr>
                            @foreach($fila as $valor)
                                @php
                                    // Aplicar estilos según el contenido
                                    $cellClass = '';
                                    if (in_array($valor, ['VENCIDA', 'critico', 'Critico'])) {
                                        $cellClass = 'status-inactive';
                                    } elseif (in_array($valor, ['Óptimo', 'optimo', 'Activo'])) {
                                        $cellClass = 'status-active';
                                    } elseif (is_numeric($valor) && $valor < 0) {
                                        $cellClass = 'warning';
                                    }
                                @endphp
                                <td class="{{ $cellClass }}">{{ $valor }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>No se encontraron datos para generar el reporte</h3>
            <p>No hay registros que coincidan con los criterios de búsqueda.</p>
        </div>
    @endif

    <!-- Pie de Página -->
    <div class="footer">
        <strong>Sistema de Inventario TI - {{ config('app.name', 'Laravel') }}</strong><br>
        <span>Reporte generado automáticamente - Confidencial</span>
    </div>

    <!-- Numeración de páginas -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("DejaVu Sans");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 20;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>