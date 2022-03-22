<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Tarea</th>
            <th>Descripcion</th>
            <th>Categoria</th>
        </tr>
            <tr>
                <td>{{$tarea->id}}</td>
                <td>{{$tarea->tarea}}</td>
                <td>{{$tarea->descripcion}}</td>
                <td>{{$tarea->categoria}}</td>
            </tr>
    </table>
</body>
</html>