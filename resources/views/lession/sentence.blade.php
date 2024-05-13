@extends("layout.layout")
@section('title','Sentence')

@section("content")
<style>
    .moveAnimate{
        transition: all .15s linear;
    }
</style>

<div class='container' >
<div class='text-center' >
<h1 id='score'>Score:</h1>
</div>
<div id="gameContainer">

</div>
<div class='d-flex justify-content-center pt-3'>
<form action='{{url("/lession/$lessionId/sentence")}}' method="post">{{ csrf_field()}}
    <h1>Nhớ ẩn input</h1>
    <div>
        <input value={{$score}} type="number" name='score'  id='scoreForm'>
            <input value='false' name='istrue'  id='trueOrFalse'>
            <input value={{$index}} name='index' >
            <input value={{$lessionId}} name='lessionid' >
    </div>
      
        <button type='submit' class='btn btn-primary'>Câu tiếp theo</button>
    </form>
</div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/scrambled.js')}}"></script>
<script src="{{asset('js/blankFill.js')}}"></script>
<script>
const random = 1;
const sentence = @json($sentence); 
console.log(sentence)
const completeSentence = sentence.BlankSentence.replace('_',sentence.FillWord)
var score = @json($score);
const scorePlace = document.getElementById("score")
const gameCont = document.getElementById("gameContainer")
const formTrue = document.getElementById("trueOrFalse")
const formScore = document.getElementById("scoreForm")

if(random === 1)
{
    var blankSentence = sentence.BlankSentence.replace('_.','_ .')
    blankSentence = blankSentence.replace('._','. _')

    var quiz = new fillInBlank(blankSentence,sentence.FillWord,sentence.Hint)
    gameCont.appendChild(quiz.container)
}
else{
    var quiz = new ScrambledCont(completeSentence,gameCont)
}



</script>

@endsection