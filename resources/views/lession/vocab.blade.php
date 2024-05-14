@extends("layout.layout")
@section('title','Vocab')

@section("content")
<div class='container'>
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
    <select  id="voiceSelect" >
                      </select>
<div class="ml-3">
    <h1 class="text-center">{{$question->Vietnamese}}</h1>
    <div class="d-flex justify-content-around">
        <h2 onclick="quizClick(event)" class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between">
             {{$vocabs->get(0)->Vocab}} <img src="{{$vocabs->get(0)->Image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2 onclick="quizClick(event)" class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> 
            {{$vocabs->get(1)->Vocab}} <img src="{{$vocabs->get(1)->Image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
    <div class="d-flex justify-content-around">
        <h2 onclick="quizClick(event)" class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> 
            {{$vocabs->get(2)->Vocab}} <img src="{{$vocabs->get(2)->Image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2 onclick="quizClick(event)" class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> 
            {{$vocabs->get(3)->Vocab}} <img src="{{$vocabs->get(3)->Image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
</div>
<div class='d-flex justify-content-center pt-3'>
<form action='{{url("/lession/$lessionId/vocab")}}' method="post">{{ csrf_field()}}
    
    <div hidden>
    <h1>Nhớ ẩn input</h1>
        <input value={{$score}} type="number" name='score'  id='scoreForm'>
            <input value='false' name='istrue'  id='trueOrFalse'>
            <input value="{{$index}}" name='index' >
            <input value="{{$lessionId}}" name='lessionid' >
            <input value="{{$question->VocabID}}" name='vocabid' >
    </div>
      
        <button type='submit' class='btn btn-primary btn-lg'>Câu tiếp theo</button>
    </form>
</div>
</div>

@endsection


@section('scripts')
<script>
var click = 0
var score = @json($score);
var question = @json($question);

const allQ = document.getElementsByClassName("quiz")
const scorePlace = document.getElementById("scorePlace")
const formTrue = document.getElementById("trueOrFalse")
const formScore = document.getElementById("scoreForm")
const alertSuccess = document.getElementById("alertSuccess")
const alertWarning = document.getElementById("alertWarning")
const alertFail = document.getElementById("alertFail")
const selectTag = document.getElementById("voiceSelect");



var voices = []
var speech = new SpeechSynthesisUtterance();

window.speechSynthesis.onvoiceschanged = () =>{
        voices = window.speechSynthesis.getVoices()
        speech.voice = voices[0]
        voices.forEach((x,index)=>{
        selectTag.options[index] = new Option(x.name,index)
        })
    }
selectTag.addEventListener("change",()=>{
    speech.voice = voices[selectTag.value]
})

function speak(text){
    console.log("click")
    speech.text = text
    window.speechSynthesis.speak(speech)
}


console.log(scorePlace);
for (let i =0; i< allQ.length;i++){
    allQ[i].addEventListener("mouseover",this.hoverHandle)
    allQ[i].addEventListener("mouseout",this.notHoverHanlde)
}


function hoverHandle(event){
    event.target.classList.add("bg-info")
    event.target.classList.add("text-white")
    event.target.style.transform = "scale(1.1)"
}


function quizClick(event){
    var value = event.target.textContent.trim()
    
    speak(value);
    if(click > 0){
        alertWarning.classList.remove('d-none')
        alertSuccess.classList.add('d-none')
        alertFail.classList.add('d-none')
        return
    }
    click += 1;
    for (let i =0; i< allQ.length;i++){
    allQ[i].removeEventListener("mouseover",this.hoverHandle)
    allQ[i].removeEventListener("mouseout",this.notHoverHanlde)
    }
    notHoverHanlde(event);
    
    if (value=== question.Vocab){
    
    score += 100;
    scorePlace.innerHTML = `Score: ${score}`
    formTrue.value = 'true'
    formScore.value = score;
    alertWarning.classList.add('d-none')
    alertSuccess.classList.remove('d-none')
    alertFail.classList.add('d-none')
    event.target.classList.add("bg-success")
    event.target.classList.add("bg-gradient")
    } 
    else{
        alertWarning.classList.add('d-none')
        alertSuccess.classList.add('d-none')
        alertFail.classList.remove('d-none')
        event.target.classList.add("bg-danger")
        event.target.classList.add("bg-gradient")
    }
   


}
function notHoverHanlde(event){
    event.target.classList.remove("bg-info")
    event.target.classList.remove("text-white")
    event.target.style.transform = "scale(1)"
}




</script>

@endsection