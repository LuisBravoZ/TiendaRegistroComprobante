<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Lista de Comprobantes</h1>
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Banco</th>
                <th>Monto</th>
                <th>Fecha de Transferencia</th>
                <th>Tipo de Transacción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comprobantes as $comprobante)
                <tr>
                    <td>{{ $comprobante->numero_comprobante }}</td>
                    <td>{{ $comprobante->banco }}</td>
                    <td>{{ $comprobante->monto }}</td>
                    <td>{{ $comprobante->fecha_transferencia }}</td>
                    <td>{{ $comprobante->tipo_transaccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
