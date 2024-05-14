@extends("layout.layout")
@section('title','Sentence')

@section("content")
<style>
    .moveAnimate{
        transition: all .15s linear;
    }
</style>

<div class='container' >
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<div id='alertSuccess' class="d-none alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div >
    Bạn trả lời đúng
  </div>
</div>
<div id='alertFail' class="d-none alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div >
    Bạn trả lời sai
  </div>
</div>
<div  id='alertWarning' class="d-none alert alert-warning d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    Bạn đã trả lời rồi 
  </div>
</div>

    <div class='d-flex justify-content-between'>
    <h1  id="scorePlace">Score: {{$score}} <h1>
    <h1 class="text-center" id="scorePlace">Câu thứ: {{$index + 1}} <h1>
    </div>
    <select  id="voiceSelect" ></select>
                      
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
            <input value="{{$index}}" name='index' >
            <input value="{{$lessionId}}" name='lessionid' >
            <input value="{{$sentence->SenID}}"" name='sentenceid' >
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