<?php $cont = 0; ?>
<div class="container">

	<!-- CARROUSEL -->
	<div id="carousel-example-generic" class="carousel slide " data-ride="carousel" style="max-width: 1080px;">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
			$targets_count = count($banner);
			for($i = 0; $i < $targets_count; $i++):?>
			<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php echo ($i == 0 ? 'class="active"' : '');?>></li>
		<?php endfor;?>
	</ol>

	<!-- Wrapper for slides -->

	<div class="carousel-inner">
		<?php
		$primero = false;
		foreach ($banner as $item):
			?>
		<div class="item <?php echo (!$primero ? 'active' : '') ?>">
			<a href="<?php echo $item->link ?>"><img src="<?php echo site_url($item->image); ?>" alt="<?php echo $item->title; ?>" ></a>
			<div class="carousel-caption">
				<h3><?php echo $item->title; ?></h3>
				<p class="hidden-xs"><?php echo $item->text; ?></p>
			</div>
		</div>
		<?php $primero = true; endforeach; ?>
	</div>


	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>

<div class="push"></div>
<hr>
<h4>Noticias Destacadas</h4>
<!-- Noticias Destacadas -->
<div class="row">
	<?php foreach ($outstanding_news as $new): ?>
		<div class="col-sm-6 col-md-6">
			<div class="thumbnail">
				<div style="overflow: hidden;max-height:250px;">
					<img src="<?php echo site_url($new->image); ?>" alt="<?php echo $new->title ?>" data-src="holder.js/300x200" class="img-responsive" style="min-width: 100%;">
				</div>
				<div class="caption">
					<h2><?php echo substr($new->title,0,60) ?></h2>
					<p><?php echo substr($new->text, 0, 280) ?></p>
					<p><a href="<?php echo $new->link ?>" class="btn btn-primary ">Ver Mas</a></p>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>

<div class="push"></div>
<hr>
<h4>Servicios Destacados</h4>
<!-- Servicios Destacados -->
<div class="row">
	<?php foreach ($outstanding_services as $service): ?>
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<div style="overflow: hidden;max-height:170px;">
					<img src="<?php echo site_url($service->image); ?>" alt="<?php echo $service->title ?>" data-src="holder.js/300x200" class="img-responsive" style="min-width: 100%;">
				</div>
				<div class="caption">
					<h4><?php echo substr($service->title, 0,45) ?></h4>
					<p><?php echo substr($service->text, 0, 133) ?></p>
					<p><a class="btn btn-primary btn-sm" href="<?php echo $service->link ?>" >Ver Mas</a></p>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>

<div class="push"></div>
