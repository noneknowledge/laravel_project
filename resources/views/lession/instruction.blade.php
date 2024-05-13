@extends('layout.layout')
@section('title')
Lession {{$lessionId}} instruction
@endsection

@section('content')

<div class="container border rounded" style="height: 80%;">
    <h1 class="text-center">Lession {{$lessionId}}</h1>
    <div class="row m-3 border border-danger" style="height: 100%;">
        <div class="col-3 border border-success d-flex flex-column" style="height: 95%;">
            <h3 onclick="changeTab('vocab')" [ngClass]="(currentTab==='Vocab')?'tabActive':null"  class="text-center test mt-5 p-2 " >Vocab</h3>
            <h3 onclick="changeTab('sentence')" [ngClass]="(currentTab==='Grammar')?'tabActive':null" class="text-center  test mt-5 p-2 " >Sentence</h3>
            <h3 onclick="changeTab('grammar')" [ngClass]="(currentTab==='Grammar')?'tabActive':null" class="text-center  test mt-5 p-2 " >Grammar</h3>
        </div>
        <div class="col-8 p-4 border border-info" style="height: 95%;">
            <div *ngIf="currentTab === 'Vocab'" id='vocabTab' style="height:100%" class="overflow-scroll">
                <h2 class="text-center">Vocab</h2>
                <div class="my-4" *ngIf="response !== undefined">
                    <hr>
                    <div class="my-3 p-3 border rounded bg-info text-white d-flex justify-content-around">
                        <h3>Chọn accent phát âm:</h3>

                     <select  id="voiceSelect" >
                      </select>
                    </div>
                    
                    <div class="row m-3" >
                        <div class="col-2  text-center "><h3>Hình ảnh</h3></div>
                        <div class="col-3 text-center"><h3>Vocab/ Vietnamese</h3></div>
                        <div class="col-3"><h3>Phân loại từ</h3></div>
                        <div class="col-3"><h3>Phát âm</h3></div>
                    </div>
                    @foreach($vocabs as $vocab)
                    <div class="row my-5 mx-4" *ngFor="let vocab of response.vocabularies">
                        <img class="col-2 " style="object-fit: cover;width: 100px;" src="{{$vocab->Image}}" class="img-thumbnail" alt="$vocab->vocab">
                        <div class="col-4 text-center d-flex flex-column">
                            <p>{{$vocab->Vocab}}</p>
                            <p>{{$vocab->Vietnamese}}</p>
                        </div>
                        <div class="col-3">{{$vocab->WordClass}}</div>
                        <div class="col-3 ">
                            <button class="text-center btn btn-primary" onclick='speak("{{$vocab->Vocab}}")'>Speaker</button>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                </div>
               
            </div>  
        
            <div class="d-none" id='sentenceTab'>
                <h2 class="text-center">Sentence</h2>
               
                <div>
                    @foreach($sentences as $sentence)
                    <div class='m-3 p-3'>
                        <h2>{{$loop->index +1}}. {{str_replace('_',$sentence->FillWord,$sentence->BlankSentence)}}</h2>
                        <h3 class='text text-secondary'>{{$sentence->Vietnamese}}</h3>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div> 
            <div class="d-none" id='grammarTab'>
                <h2 class="text-center">Grammar</h2>
               
                <div>
                    @foreach($grammars as $grammar)
                    <hr>
                    <div class='m-3 p-3 '>
                        <h1>{{$loop->index +1}}. {{$grammar->Formula}}</h1>
                        <h2 class='text text-secondary'>{{$grammar->Example}}</h2>
                        <h3>{{$grammar->Note}}</h2>
                      
                    </div>
                  
                    @endforeach
                </div>
            </div> 
        </div>
    </div>
    
   
</div>



@endsection

@section("scripts")
<script>

var currentTab = null
var voices = []
var speech = new SpeechSynthesisUtterance();
const selectTag = document.getElementById("voiceSelect");
const vocabDiv = document.getElementById("vocabTab");
const grammarDiv = document.getElementById("grammarTab");
const sentenceDiv = document.getElementById("sentenceTab");

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

function changeTab(tab){
    
    switch  (tab){
        case "vocab":
            console.log(tab)
            
            if(currentTab === null){
            }
            else{
                vocabDiv.classList.toggle("d-none")
                currentTab.classList.toggle("d-none")
            }
            currentTab = vocabDiv;
            break;
        case "sentence":
            console.log(tab)
        sentenceDiv.classList.toggle("d-none")
        if(currentTab === null){
            vocabDiv.classList.toggle("d-none")
        }
        else{
            currentTab.classList.toggle("d-none")
        }
        currentTab = sentenceDiv;
            break;
        case "grammar":
            console.log(tab)
        grammarDiv.classList.toggle("d-none")
        if(currentTab === null){
            vocabDiv.classList.toggle("d-none")
        }
        else{
            currentTab.classList.toggle("d-none")
        }
        currentTab = grammarDiv;
        break;
        
    }
   

}
</script>


@endsection