<div class="row">
	<!-- TITULO -->
	<div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
		<h1>{{ data:title }}</h1>
	</div>
	<br>
</div>

<div class="row">
	<div class="col-sx-12 col-sm-6 col-md-6 col-lg-6">
		<div class="cont-img">
			<img src="{{ data:image }}" alt="{{title}}">
		</div>
	</div>
	<div class="ccol-sx-12 col-sm-6 col-md-6 col-lg-6">
		<div class="cont-video">
			<!-- VIDEO -->
			{{ if data:video }}
				{{ data:video }}
			{{ endif }}
		</div>
	</div>
</div>

<hr>

<div class="row">
	<!-- TEXTO -->
	<div class="col-md-12">{{ data:text }}</div>
</div>