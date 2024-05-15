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
            <div class="text-center">
            <button class="text btn btn-primary m-3" onclick="nextClick()">Next question</button>
        </div>
        </div>
        <div class="border rounded p-3 " id="gameContainer">
            <h1 class="text-center">Nhấn vào nút để bắt đầu trả lời các câu hỏi</h1>
        </div>
       
        
    </div>
    
    <form id='myForm' action='{{url("/lession/$lessionId/finaltest")}}' method="post">{{ csrf_field()}}
 
    <div hidden>
    <h1>Nhớ ẩn input</h1>
            <input value='0' type="number" name='score' id='scoreForm'>
            <input value='false' name='istrue'  id='trueOrFalse'>
            <input value="{{$lessionId}}" name='lessionid' >
    </div>
        
    </form>
</div>
        



@endsection


@section('scripts')
<script src="{{asset('js/scrambled.js')}}"></script>
<script src="{{asset('js/quiz.js')}}"></script>
<script src="{{asset('js/reading.js')}}"></script>
<script>

var score = 0;
const gameCont = document.getElementById("gameContainer")
const scorePlace = document.getElementById("score")
const formScore = document.getElementById("scoreForm")
const formTrue = document.getElementById("trueOrFalse")
const myForm = document.getElementById("myForm")


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

questions = vocabs.concat(sentences);
questions.push(reading);
shuffle(questions);

console.log(questions)


function topFunction() {
  window.scroll(0, 0);
}

function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}


function nextClick(){
    gameCont.innerHTML = ""
    topFunction();
    index ++;
    if(index === questions.length)
    {
        myForm.submit()
    }
    else
    {
        setTimeout(() => {
        var question = questions[index];
        console.log(question)
        switch (question.type){
            case "vocab":
                var bait = []
                shuffle(vocabs)
                for (let i = 0; i < vocabs.length;i++){
                    if(vocabs[i] !== question)
                    {
                        console.log("them vao")
                        bait.push(vocabs[i])
                    }
                    if(bait.length === 3)
                    {
                        break;
                    }
                }
                bait.push(question)
                shuffle(bait)
                
                var quiz = new QuizChoice(question,bait,gameCont)

                break;

            case "sentence":
                var completeSentence = question.BlankSentence.replace('_',question.FillWord)
                var quiz = new ScrambledCont(completeSentence,gameCont,false)
                break;

            case "reading":
                var quiz = new ReadingQuiz(question.Paragraph, question.Question, question.Answer, question.Question2,question.Answer2,gameCont)
                break;
            
        }
        

    }, 50);

    }

    
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
