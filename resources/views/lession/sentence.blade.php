@extends("layout.layout")
@section('title','Sentence')

@section("content")
<style>
    .moveAnimate{
        transition: all .15s linear;
    }
</style>

<div class='container' >


    <div class='d-flex justify-content-between'>
    <h1  id="scorePlace">Score: {{$score}} <h1>
    <h1 class="text-center" id="scorePlace">Câu thứ: {{$index + 1}} <h1>
    </div>
    
                      

<div id="gameContainer">

</div>
<div class='d-flex justify-content-center pt-3'>
<form action='{{url("/lession/$lessionId/sentence")}}' method="post">{{ csrf_field()}}
 
    <div hidden>
    <h1>Nhớ ẩn input</h1>
        <input value={{$score}} type="number" name='score'  id='scoreForm'>
            <input value='false' name='istrue'  id='trueOrFalse'>
            <input value="{{$index}}" name='index' >
            <input value="{{$lessionId}}" name='lessionid' >
            <input value="{{$sentence->SenID}}" name='sentenceid' >
    </div>
      
        <button type='submit' class='btn btn-primary btn-lg'>Câu tiếp theo</button>
    </form>
</div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/scrambled.js')}}"></script>
<script src="{{asset('js/blankFill.js')}}"></script>
<script>
const random = Math.floor(Math.random() * 2);
const sentence = @json($sentence); 
console.log(sentence)
const completeSentence = sentence.BlankSentence.replace('_',sentence.FillWord)
var score = @json($score);
const scorePlace = document.getElementById("scorePlace")
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