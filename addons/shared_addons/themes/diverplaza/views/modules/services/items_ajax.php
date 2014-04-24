{{ if services }}
	{{ services }}
		<div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div style="overflow: hidden;max-height:170px;">
                <img src="{{image}}" data-src="holder.js/300x200" width="100%" alt="" class="img-responsive">
            </div>
            <div class="caption">
                <h4>{{name}}</h4>
                <p>{{introduction}}</p>
                <p><a class="btn btn-primary btn-sm" href="{{url}}" >Ver Mas</a></p>
            </div>
        </div>
    </div>
	{{ /services }}
{{ else }}
	<div class="col-sm-12 col-md12"><p style="text-align:center;margin-top:80px"><strong>No se encontraron más resultados...</strong></p></div>
{{ endif }}