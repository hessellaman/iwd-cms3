@extends('layouts.app')
<!-- Dashboard van de backend (het CMS) -->
@section('content')

<div class="blog-header">
      <div class="container">
        <h1 class="blog-title" href="{{ url('/') }}">CMS</h1>
        <p class="lead blog-description">Het Content Management Systeem voor Tech-Zone.</p>
      </div>
    </div>
    <div class="container">

    <div class="container">
      <div class="row">
      	<strong>Welkom in het CMS van Tech-Zone. U kunt hier de volgende handelingen verichten:</strong>
      	<br><br>
      	<ul>
      		<li>Pagina's aanmaken, bewerken en verwijderen.</li>
      		<li>De volgorde van pagina's in de menubalk veranderen of deze in dropdown menu's plaatsen.</li>
      		<li>Blog posts aanmaken, bewerken en verwijderen.</li>
      		<li>Gebruikersrollen aanpassen en gebruikers verwijderen.</li>
  		</ul>
  	</div>

@endsection
