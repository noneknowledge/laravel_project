@extends("layout.layout")
@section('title','Sentence')

@section("content")
<style>
    .moveAnimate{
        transition: all .15s linear;
    }
</style>
<div class=" container">
    <div class="border">
        <div class="d-flex justify-content-between">
            <h1 class="p-3" id="score">Score: 0</h1>
        </div>
        <div class="border rounded p-3 " id="gameContainer">
            <h1 class="text-center">Nhấn vào nút để bắt đầu trả lời các câu hỏi</h1>
        </div>
        <div class="text-center">
            <button class="text btn btn-primary m-3" onclick="nextClick()">Next question</button>
        </div>
        
    </div>
    
</div>
        



@endsection


@section('scripts')
<script src="{{asset('js/scrambled.js')}}"></script>
<script src="{{asset('js/blankFill.js')}}"></script>
<script src="{{asset('js/reading.js')}}"></script>
<script>

var score = 0;
const gameCont = document.getElementById("gameContainer")
const scorePlace = document.getElementById("score")
var index = -1;
var sentences = @json($sentences);
var vocabs = @json($vocabs);
var reading = @json($reading);
vocabs = vocabs.map(vocab => {
    return {...vocab, type: 'vocab'};
});

sentences = sentences.map(sentence => {
    return {...sentence, type: 'sentence'};
});
reading.type = "reading"


console.log(reading);
console.log(vocabs);
console.log(sentences);

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

function nextClick(){
  
    index ++;
    var quiz = new ReadingQuiz(reading.Paragraph, reading.Question, reading.Answer, reading.Question2,reading.Answer2,gameCont)
    
    // if (index === questions.length) index=0
    // gameCont.innerHTML = ""
    // var current = questions[index]
    // switch(current.type){
    //         case "fill":
    //             var quiz = new fillInBlank(current.question, current.bingo)
            
    //             gameCont.appendChild(quiz.container)
    //             break;
    //         case "quiz":
    //             var quiz = new QuizCreate(current.question,current.bait, current.bingo)
    //             gameCont.appendChild(quiz.HTMLelement)
    //             break;
    //         case "scrambled":
    //                var quiz = new ScrambledCont(current.question,current.bait,gameCont)
    //         break;
    //         case "speak":
    //             var quiz = new SpeechQuiz(current.question)
    //             gameCont.appendChild(quiz.container)
    //         break;  
    // }
   



}


</script>

@endsection
