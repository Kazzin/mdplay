@extends('layouts.game')

@section('first_pane')

<div  style="background-color: rgba(255,255,255,0.4); border-radius: 2rem;">
<h1 style="color: black;">{{ $question->question }}</h1>
</div>

@endsection

@section('second_pane')

    <div class="row">
        <input id="selected_value" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
    </div>

    <div class="row">
        <br>
    </div>

    <div class="row">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#results">Enviar</button>
    </div>


@endsection

@section('modal')
<div id="results" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('js')
    <script>
    $('#selected_value').slider({
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });

    </script>
@endsection