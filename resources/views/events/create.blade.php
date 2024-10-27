@extends('layouts.main')

@section('title', 'Publicar Jogo')

@section('content')

<video autoplay muted loop id="background-video">
  <source src="../video/VideoBack.mp4" type="video/mp4">
</video>

<div id="search-container "  class="col-md-12">
<div class = "container">
  <div class = "blackbox gy_border">
  <div class ="topfade"><p>Enviar Jogo</p></div>
  <div class = "col-md-12 row"> 
  
  <h1> Envie seu Jogo!</h1>
  
    <div class = "col-md-6" >
    <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control edt" id="title" name="title" placeholder="Titulo do Jogo">
        </div>
        <div class="form-group">
            <label for="date">Data de lançamento</label>
            <input type="date" class="form-control edt" id="date" name="date" >
        </div>
    </div>
    <div class = "col-md-6">
    <div class="form-group">
        <label for="title">Gênero</label>
        <input type="text" class="form-control edt"  placeholder ="Gênero do Jogo" name="genero" >
        </div> 
        <label for="title">Plataforma:</label>
        <select class="form-control" aria-label="Default select example" id="plataforma" name="plataforma">
        <option selected></option>
        <option class="form-control" value="Windows">PC Windows</option>
        <option class="form-control" value="Linux">PC Linux</option>
        <option class="form-control" value="Steam Deck">Steam Deck</option>
        <option class="form-control" value="Nintendo Switch">Nintendo Switch</option>
        <option class="form-control" value="Xbox">Xbox</option>
        <option class="form-control" value="Play Station">Play Station</option>
        <option class="form-control" value="Mobile">Mobile</option>
        </select>
        <div class="form-group">
        </div>
        </div>
        
    
    </div>
    <div class = "col-md-12 row"> 
    <div class="form-group">
            <label for="title">Descrição</label>
           <textarea name="description" id="description" class="form-control" placeholder="Descrição do Evento" rows="4" cols="50" maxlength="300"></textarea>
    </div>
</div>
<div class = "col-md-12 row"> 
<div class = "col-md-6"> 
    <div class="mb-3">
    <label for="image">Imagem do Jogo</label>
    <input class="form-control" type="file" id="image" name="image">
    </div>
</div>
    <div class = "col-md-6" > 
    <label for="preco">Preço </label><label for="preco" style="color:rgb(80, 80, 80);"> (Nossa taxa é de 10%)</label>
    <input type="numeric" class="form-control" id="preco" name="preco" >
    </div>
    <div class = "col-md-12 d-flex align-items-center justify-content-end"> 
    <input type="submit" class="btn b-primarytn" id ="criar"value="Publicar">
    </div>
</div>

</div>
</div>
</form>   
</div>
  
</div>
</div>





@endsection