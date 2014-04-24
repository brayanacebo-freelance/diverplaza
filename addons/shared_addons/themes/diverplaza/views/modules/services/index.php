<!-- No borrar estos divs  -->
<div id="baseurl" class="hide"></div>
<div id="selCategory" class="hide">{{ selCategory }}</div>
<div id="page_ajax" class="hide">1</div>
<!-- ------------- -->
<div class="container">
    <div class="row mtop40">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="color-text-blue"><strong>servicios {{category}}</strong></h2>
        </div>
    </div>
    <br>
    <div class="row">
        <!--  Texto de introducción administrable -->
        <div class="col-sm-12 col-md12"><p>{{ intro:text }}</p></div>
        <!-- Listado normal de categorias -->
        <div class="col-sm-6 col-md-3 visible-md visible-lg">
            <div class="treemenu">
                {{ menu }}
            </div>
        </div>
        <!-- Select de categorias -->
        <div class="col-sm-6 col-md-3 visible-sm visible-xs">
            <div class="btn-group" style="margin-bottom: 10px;">
              <button type="button" class="btn btn-primary">Primary</button>
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
              <ul class="dropdown-menu">
              	{{ categories }}
              		<li><a href="services/index/{{slug}}">{{title}}</a></li>
              	{{ /categories }}
            </ul>
        </div>
        <div class="push"></div>
    </div>
    <div class="col-sm-6 col-md-9">
        <div class="row" id="upload_items">
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
        		<div class="col-sm-12 col-md12"><p style="text-align:center;margin-top:80px"><strong>No se encontraron resultados...</strong></p></div>
        	{{ endif }}
        </div>
    </div>
    <button type="button" class="btn btn-primary" id="more_items_ajax">+</button>
</div>
</div>
<div class="push"></div>

<!-- Necesario para los styles del Menú -->
<script>
    $(".treemenu").children().attr("class","list-group");
    $(".list-group").children().attr("class","list-group-item");
</script>
