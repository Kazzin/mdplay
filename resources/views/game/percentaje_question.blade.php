@extends('layouts.game')

@section('first_pane')

    <div id="question_pane" class="question-container">
        <h1 class="question-text">@{{ actual_question.question }}</h1>
    </div>

@endsection

@section('second_pane')

    <div id="answer_pane">

        {{--! <div class="row">
            <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block">80%</button>
            </div>
            <div class="col-xs-4">
            <button type="button" class="btn btn-primary btn-block">90%</button>
            </div>
            <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block">100%</button>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
        </div> --}}

        <div v-if="actual_question.type == 'percentage'" class="row text-center">
            <input type="range" v-model="actual_answer" class="slider">
            <strong v-text="actual_answer + '%'"></strong>
            <hr>
            <button type="button" class="btn btn-success" @click="send_answer(actual_answer)">Enviar</button>
        </div>

        <div v-if="actual_question.type == 'yes/no'" class="row text-center">
            <div class="col-xs-offset-0 col-xs-6 col-md-offset-2 col-md-4">
                <button class="btn btn-success btn-block" value="si" @click="send_answer('Si')">Sí</button>
            </div>
            <div class="col-xs-6 col-md-4">
               <button class="btn btn-danger btn-block" @click="send_answer('No')">No</button>
            </div>
        </div>

        <div v-if="actual_question.type == 'true/false'" class="row text-center">
            <div class="col-xs-offset-0 col-xs-6 col-md-offset-2 col-md-4">
                <button class="btn btn-success btn-block" value="si" @click="send_answer(true)">Verdadero</button>
            </div>
            <div class="col-xs-6 col-md-4">
               <button class="btn btn-danger btn-block" @click="send_answer('false')">Falso</button>
            </div>
        </div>

    </div>
    

@endsection

@section('modal')
<input id="show_modal" type="hidden" class="btn btn-info btn-lg" data-toggle="modal" data-target="#results">

<!-- Modal -->
<div id="results" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Resultados</h4>
      </div>
      <div class="modal-body">

      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <template v-for="(question, key) in questions">
                <li v-if="key == 0" class="active" :data-slide-to="key"></li>
                 <li v-else :data-slide-to="key"></li>
            </template>
        </ol>
  
        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            <template v-for="(question, key) in questions">

                <div v-if="key == 0" class="item active col-xs-offset-2 col-xs-8" >
                    <div class="row">
                        <h3>@{{ question.question }}</h3>
                        <label>Respuesta seleccionada:</label> @{{ question.user_answer }}
                        <br>
                        <label>Respuesta correcta:</label> @{{ question.answer }}
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-2 col-xs-8 col-md-offset-3 col-md-6">
                            <img src="https://media.discordapp.net/attachments/345040635159642114/384087478547644433/unknown.png" class="img-responsive">
                        </div>
                    </div>
                    <div class="row">
                        <label>Más información en:</label>
                        <ul>
                            <li><a href="">Link de prueba 1</a></li>
                            <li><a href="">Link de prueba 2</a></li>
                        </ul>
                    </div>
                    <div class="row text-right">
                        <strong>El 10% de los usuarios respondió como vos</strong>
                    </div>
                </div>

                <div v-else class="item col-xs-offset-2 col-xs-8">
                    <div class="row">
                        <h3>@{{ question.question }}</h3>
                        <label>Respuesta seleccionada:</label> @{{ question.user_answer }}
                        <br>
                        <label>Respuesta correcta:</label> @{{ question.answer }}
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-2 col-xs-8 col-md-offset-3 col-md-6">
                            <img src="https://media.discordapp.net/attachments/345040635159642114/384087478547644433/unknown.png" class="img-responsive">
                        </div>
                    </div>
                    <div class="row">
                        <label>Más información en:</label>
                        <ul>
                            <li><a href="">Link de prueba 1</a></li>
                            <li><a href="">Link de prueba 2</a></li>
                        </ul>
                    </div>
                    <div class="row text-right">
                        <strong>El 10% de los usuarios respondió como vos</strong>
                    </div>
                </div>
            </template>
            
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="color:black; background:white !important">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next" style="color:black; background:white !important">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


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

    const game = new Vue({
        el: "#game-container",
        data: {
            questions: [],
            next_question_index: 0,
            actual_question: null,
            actual_answer: 0,
        },
        mounted() {
            $('#selected_value').slider({
                formatter: function(value) {
                    return 'Current value: ' + value;
                }   
            });
            var self = this;
            $.ajax({
                url: "{{ route('questions.next') }}",
                type: "GET",
                success: function(questions) {
                    console.log(questions)
                    self.questions = questions;
                    self.actual_question = self.questions[self.next_question_index];
                    self.next_question_index++;
                    console.log(self.actual_question)
                }
            });
        },
        methods: {
            send_answer: function(answer) {


                if(this.next_question_index < this.questions.length) {
                    $("#question_pane").slideUp(100);
                    $("#answer_pane").slideUp(100);
                    this.actual_answer = 0;
                    this.actual_question.user_answer = answer;
                    this.actual_question = this.questions[this.next_question_index];
                    this.next_question_index++;
                    $("#question_pane").slideDown(100);
                    $("#answer_pane").slideDown(100);
                }
                else {
                    this.actual_question.user_answer = answer;
                    $('#show_modal').click();
                }
            }
        }
    });
    </script>
    
@endsection