<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Agregar tarea</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($tarea)
        <form action="/tarea/{{$tarea->id}}" method="POST"> {{--Actualizar (update)--}}
            @method('PATCH')
    @else
        <form action="/tarea" method="POST"> {{--Crear--}}
    @endisset
 
        @csrf
        <label for="tarea">Nombre de la tarea</label>
        <input type="text" name = "tarea" value="{{isset($tarea) ? $tarea->tarea:old('tarea')}}">
        @error('tarea')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion" cols="10" rows="10">
            {{isset($tarea)?$tarea->descripcion:old('tarea')}}
        </textarea>
        <br>
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <option value="Escuela"{{isset($tarea) && $tarea->categoria == 'Escuela' ? 'selected' : ''}}>Escuela </option>
            <option value="Trabajo"{{isset($tarea) && $tarea->categoria == 'Trabajo' ? 'selected' : ''}}>Trabajo </option>
            <option value="Otra"{{isset($tarea) && $tarea->categoria == 'Otra' ? 'selected' : ''}}>Otra </option>
        </select>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>