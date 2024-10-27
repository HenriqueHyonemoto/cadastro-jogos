@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

<video autoplay muted loop id="background-video">
  <source src="/video/VideoBack.mp4" type="video/mp4">
</video>



<div id="search-container "  class="col-md-12">
<div class = "container">
  <div class = "blackbox gy_border">
  <div class ="topfade2"><p>Editando Jogo</p></div>
  
  
  <div class = "col-md-12 row"> 
  <h1> Editando: {{$event->title}}</h1>
  <div class = "col-md-3 row">
  <div class = "container imgedit">
  <div class ="gy_border">
  <div class ="topfade2"><p>Imagem Atual</p></div>
  <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class = "img-preview mx-auto d-block ">
</div>
</div>
  </div>
  
    <div class = "col-md-9 flex-column my-auto" style="align-items-center">
    <div class = "container ">
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data" style="align-items-center">
    @csrf
    <div class="form-group col">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$event->title}}" >
        </div>
        <div class="form-group col">
            <label for="date">Data de lançamento:</label>
            <input type="date" class="form-control "  id="date" name="date"value="{{date('Y-m-d', strtotime($event->date));}}" >
        </div>
        <div class ="form-group col">
        <label for="title">Gênero:</label>
        <input type="text" class="form-control" id="genero" placeholder ="Gênero do Jogo" name="genero" value="{{$event->genero}}">
      </div>
      <div class ="form-group col" >
        <label for="title">Plataforma:</label>
        <select class="form-control" aria-label="Default select example" id="plataforma" name="plataforma" value="{{$event->description}}">
        <option selected value="{{$event->plataforma}}">{{$event->plataforma}}</option>
        <option class="form-control" value="Windows">PC Windows</option>
        <option class="form-control" value="Linux">PC Linux</option>
        <option class="form-control" value="Steam Deck">Steam Deck</option>
        <option class="form-control" value="Nintendo Switch">Nintendo Switch</option>
        <option class="form-control" value="Xbox">Xbox</option>
        <option class="form-control" value="Play Station">Play Station</option>
        <option class="form-control" value="Mobile">Mobile</option>
        </select>
    </div>
</div>
    </div>
</div>
    <div class = "col-md-12 row"> 
    <div class="form-group">
            <label for="title">Descrição</label>
           <textarea name="description" id="description" class="form-control" rows="4" cols="50" maxlength="300">{{$event->description}}</textarea>
    </div>
</div>
<div class = "col-md-12 row"> 
<div class = "col-md-6"> 
    <div class="mb-3">
    <label for="image">Imagem do Jogo:</label>
    <input class="form-control" type="file" id="image" name="image" >
    </div>
</div>
    <div class = "col-md-6" > 
    <label for="preco">Preço:</label>
    <input type="numeric" class="form-control" id="preco" name="preco" value="{{$event->preco}}">
    </div>
    <div class = "col-md-12 d-flex align-items-center justify-content-end"> 
    <input type="submit" class="btn b-primarytn" id ="criar"value="Salvar">
    </form>  
    </div>
</div>

</div>
</div>
 
</div>
  
</div>
</div>


@endsection