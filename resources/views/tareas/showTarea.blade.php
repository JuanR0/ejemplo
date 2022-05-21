<x-layout>
<div class="right_col" role="main">
    <h1>Informacion de tarea</h1>
    <h3>Usuario: {{ $tarea->user->name }}</h3>
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
</x-layout>