
@if(count($sliders))
<div class="container-fluid" id="sliders">

<div class="row">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">

@if(count($sliders) > 1)
    <ol class="carousel-indicators">
      @for ($i = 0; $i < count($sliders); $i++)
         <li data-target="#myCarousel" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif ></li> 
      @endfor
    </ol>
@endif

    <div class="carousel-inner" role="listbox">

    @foreach($sliders as $key => $slide)

      <div class="item {{ ($key == 0 ? 'active' : '') }}">

        <a href="{{ $slide->imagegable->slug }}" title="{{ $slide->alt }}"><img src="{{ route('imagecache', ['template'=>'full', 'filename'=>$slide->filename]) }}" alt="{{ $slide->alt }}"></a>
      </div>
    @endforeach

    </div>

@if(count($sliders) > 1)
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
@endif

  </div>

</div>

</div>
@endif