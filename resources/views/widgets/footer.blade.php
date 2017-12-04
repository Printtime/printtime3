
<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button" title="Наверх!" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

<div class="modal fade" id="open-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document"></div>
</div>

<div class="modal fade" id="open-modal-pay" tabindex="-1" role="dialog">
<div class="modal-dialog-pay" role="document"></div>
</div>

    

    <footer class="footer">
      <div class="container">

        {{--
        <div class="row">

        @foreach ($compose_catalog->chunk($compose_catalog->count()/3) as $item)
            <div class="col-md-4">
                @foreach ($item as $catalog)
                    <h3>{!! link_to_route('catalog.show', $catalog->title, $catalog->id) !!}</h3>
                    @foreach ($catalog->products as $product)
                        {!! link_to_route('catalog.product.show', $product->title, [$catalog->id, $product->id]) !!}<br>
                    @endforeach
                @endforeach
            </div>
        @endforeach
        </div>
        --}}

        
      </div>


</footer>

<div class="top-container">
    <div class="container">
            <div class="col-md-12 top-contacts text-center">Украина, г.Кривой Рог, ул. Волгоградская, 12 <i class="icon logo-icon"></i> (067) 812 81 11 <i class="icon logo-icon"></i> (050) 812 81 81 <i class="icon logo-icon"></i> (063) 812 81 81

        </div>
    </div>
</div>
