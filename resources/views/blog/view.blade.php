@extends('layouts.frontend')

<!-- Hier wordt de pagina van een specifieke blogpost aangemaakt met bijbehorende comments en tags-->
@section('content')
    <div class="col-sm-8 blog-main">
	    <div class="blog-post">
	        <h2 class="blog-post-title">
		      {{$post->title}}
		    </h2>
		    <!-- Tags voor blogposts worden hiermee getoond. Deze zijn niet dynamisch, dus ze zijn al van te voren ingevuld in de database. -->
			@if(count($post->tags))
				<ul>
				@foreach($post->tags as $tag)
					<li>
						<a href="/blog/tags/{{ $tag->name }}">
							{{ $tag->name }}
						</a>
					</li>
				@endforeach
				</ul>
			@endif

		    <p class="blog-post-meta">
		    	Gepost door {{$post->user->name }} op {{ $post->present()->publishedDate}}</p>
		    <hr>
		    <p>
		      {{ $post->excerpt}}
		    </p>
		    <p>
		      {{ $post->body }}
		    </p>
		</div>

		<hr>

		<div class="comments">
			<ul class="list-group">
			<!-- De comments van een post worden weergegeven en kunnen worden bewerkt -->
			@foreach ($post->comments as $comment)
				<li class="list-group-item">
					<strong>{{ $comment->created_at->diffForHumans() }}</strong> door <strong>{{ $comment->user->name }}</strong>: &nbsp;
					<br><br>{{ $comment->body }}
					<!-- De delete en wijzig knoppen worden alleen getoond aan geauthorizeerde gebruikers, hierbij moet worden gecontroleerd of ze zijn ingelogd EN of ze mogen bewerken (admin/editor of de auteur van de post) -->
					@if (Auth::check())
						@if ($comment->userCanEdit(Auth::user()) || (Auth::user()->id == $comment->user_id))
							<div class="comment-header d-flex justify-content-between">
                  			  <div class="user d-flex align-items-center"></div>
		                    </div>
							<br>
							<form method="POST" action="/blog/{{ $post->id }}/comments/{{ $comment->id }}">
								{{ csrf_field() }}
								{{ method_field('PUT') }}

								<div class="form-group">
									<textarea name="body" placeholder="Your comment here." class="form-control">{{ $comment->body }}</textarea>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-sm">Edit</button>
									<a href="/delete/{{ $comment->id }}" class="btn btn-danger btn-sm" type="button">Delete</a>
								</div>
							</form>
	                    @endif
					@endif								
				</li>
			@endforeach
			</ul>
		</div>

		<hr>
		<!-- Een comment kan met deze form worden geplaatst -->
		<div class="card">
			<div class="card-block">
				<form method="POST" action="/blog/{{ $post->id }}/comments">
					{{ csrf_field() }}

					<div class ="form-group">
						<textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>
					</div>

					<div class ="form-group">
						<button type="submit" class="btn btn-primary">Add Comment</button>
					</div>
				</form>

				@include ('layouts.errors')
			</div>
		</div>
	</div>
@endsection
