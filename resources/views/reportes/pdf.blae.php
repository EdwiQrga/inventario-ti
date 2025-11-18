<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #005850; padding-bottom: 15px; }
        .logo { width: 100px; height: auto; margin-bottom: 10px; }
        h1 { color: #005850; font-size: 18px; margin: 0; }
        .fecha { color: #666; font-size: 11px; margin: 5px 0 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #005850; padding: 6px 8px; text-align: left; }
        th { background-color: #005850; color: white; font-weight: bold; }
        .estado-activo { color: #10b981; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/pmn.png') }}" class="logo" alt="PMN">
        <h1>{{ $titulo }}</h1>
        <p class="fecha">Generado: {{ now()->format('d/m/Y H:i') }} - México</p>
    </div>

    <table>
        <thead>
            <tr>
                @foreach($data->first() ? $data->first()->keys() : [] as $header)
                    <th>{{ ucwords(str_replace('_', ' ', $header)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($row as $key => $cell)
                        <td>
                            @if($key == 'estado')
                                <span class="estado-activo">{{ $cell }}</span>
                            @else
                                {{ $cell }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>