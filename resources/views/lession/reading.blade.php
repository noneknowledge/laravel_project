@extends("layout.layout")
@section('title','Reading')

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
  <div class='alert-mess'>
    Bạn trả lời đúng
  </div>
</div>
<div id='alertFail' class="d-none alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div class='alert-mess'>
    Bạn trả lời sai
  </div>
</div>
<div  id='alertWarning' class="d-none alert alert-warning d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div class='alert-mess'>
    Bạn đã trả lời rồi 
  </div>
</div>

<div class="p-4 border border-info">
    <div class='d-flex my-3 justify-content-between'>
    <h1>Reading</h1>
    <h1 id='scorePlace'>Score: {{$score}}</h1>
    </div>
        
        <h3>{{$reading->Paragraph }}</h3>
    </div>
    <hr>
    <div class="row p-4">
    <h2><i>{{$reading->Question}}:</i></h2>
        <h2 onclick="check1(event)" onmouseover="hoverHandle(event)" onmouseout="outHover(event)" class="border text-center col-5 text-secondary">True</h2>
        <h2 class="col"></h2>
        <h2 onclick="check1(event)" onmouseover="hoverHandle(event)" onmouseout="outHover(event)" class="border text-center col-5 text-secondary">False</h2>
    </div>
    <hr>
        <div class="row p-4">
        <h2><i>{{$reading->Question2}}:</i></h2>
            <h2 onclick="check2(event)" onmouseover="hoverHandle(event)" onmouseout="outHover(event)" class="border text-center col-5 text-secondary">True</h2>
            <h2 class="col"></h2>
            <h2 onclick="check2(event)" onmouseover="hoverHandle(event)" onmouseout="outHover(event)" class="border text-center col-5 text-secondary">False</h2>      
    </div>

   
    <div class='d-flex justify-content-center pt-3'>
<form action='{{url("/lession/$lessionId/reading")}}' method="post">{{ csrf_field()}}
 
    <div hidden>
    <h1>Nhớ ẩn input</h1>
        <input value={{$score}} type="number" name='score'  id='scoreForm'>
            <input value='false' name='istrue'  id='trueOrFalse'>
            <input value='false' name='additionalanswer'  id='additionalAnswer'>
            <input value="{{$index}}" name='index' >
            <input value="{{$lessionId}}" name='lessionid' >
            <input value="{{$reading->ReadID}}" name='readid' >
    </div>
        <button type='submit' class='btn btn-primary btn-lg'>Câu tiếp theo</button>
    </form>
    </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
var score = @json($score);
var reading = @json($reading);
var click1 = 0;
var click2 = 0;
const scorePlace = document.getElementById("scorePlace")
const gameCont = document.getElementById("gameContainer")
const formTrue = document.getElementById("trueOrFalse")
const formScore = document.getElementById("scoreForm")
const formAdditional = document.getElementById("additionalAnswer")
const alertSuccess = document.getElementById("alertSuccess")
const alertWarning = document.getElementById("alertWarning")
const alertFail = document.getElementById("alertFail")

console.log(reading)

function alertBootstrap(canva, message){
    canva.classList.remove('d-none')
    canva.getElementsByClassName("alert-mess")[0].innerHTML = message
    setTimeout(() => {
        canva.classList.add('d-none')
    }, 1500);

}






function check1(event){
    
    var element =  event.target
    var value = element.innerHTML.toLowerCase().trim();
    if(click1 >0){
        alertBootstrap(alertWarning,'Bạn đã trả câu 1 rồi')
        return 
    }
    click1+=1
    var answer = reading.Answer.toLowerCase().trim();
    if( value === answer){
        element.classList.add('bg-success')
        element.classList.add('text-light')
        formTrue.value = 'true'
        score += 100
        scorePlace.innerHTML = `Score ${score}`
        alertBootstrap(alertSuccess,'Bạn đã trả lời đúng câu 1')
    }
    else{
        element.classList.add('bg-danger')
        element.classList.add('text-light')
        alertBootstrap(alertFail,'Bạn đã trả lời sai câu 1')
    }
}

function check2(event)
{
    var element =  event.target
    var value = element.innerHTML.toLowerCase().trim();
    if(click2 >0){
        alertBootstrap(alertWarning,'Bạn đã trả câu 2 rồi')
        return 
    }
    click2+=1
    var answer = reading.Answer2.toLowerCase().trim();
    if( value === answer){
        element.classList.add('bg-success')
        element.classList.add('text-light')
        formAdditional.value = 'true'
        score += 100
        scorePlace.innerHTML = `Score ${score}`
        alertBootstrap(alertSuccess,'Bạn đã trả lời đúng câu 2')
    }
    else{
        element.classList.add('bg-danger')
        element.classList.add('text-light')
        alertBootstrap(alertFail,'Bạn đã trả lời sai câu 2')
    }
}

function outHover(event){
    event.target.classList.remove("bg-info")
    event.target.classList.remove("text-white")
    event.target.style.transform = "scale(1)"
  }

function hoverHandle(event){

event.target.classList.add("bg-info")
event.target.classList.add("text-white")
event.target.style.transform = "scale(1.1)"
}

</script>

@endsection