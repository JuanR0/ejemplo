<x-layout>
<div class="right_col" role="main">
    <h1>Listado de tareas</h1>

    <a href="tareas-pendientes">Enviar tareas</a>

    <form method="POST" action="{{ route('logout')}}">
        @csrf
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    this.closest('form').submit();">
            salir
        </a>
    </form>

    <a href="/tarea/create">Crear Tarea</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Tarea</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Etiqueta(s)</th>
            <th>Acciones</th>
        </tr>
        @foreach($tareas as $tarea) 
            <tr>
                <td>{{$tarea->id}}</td>
                <td>{{$tarea->user->nombre_correo}}</td>
                <td>{{$tarea->tarea}}</td>
                <td>{{$tarea->descripcion}}</td>
                <td>{{$tarea->categoria}}</td>
                <td>
                    @foreach ($tarea->etiquetas as $etiqueta)
                        {{ $etiqueta->etiqueta }} <br>
                    @endforeach
                </td>
                <td>
                    @can('view',$tarea)
                        <a href="/tarea/{{$tarea->id}}">Ver detalle</a> 
                    @endcan
                    <a href="/tarea/{{$tarea->id}}/edit">Editar</a>
                    <form action="/tarea/{{$tarea->id}}"method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar">
                    </form>
                    <br>
                    <form action="/tarea/elimnar-db/{{$tarea->id}}"method="POST">
                        @csrf
                        <input type="submit" value="Eliminar DB">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-layout>