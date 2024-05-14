@extends("layout.layout")
@section('title')
Lession {{$lessionId}} Test
@endsection

@section('content')
<div id='overlay' style='width:100%; height:100%;z-index:1' class='d-none position-absolute bg-secondary'></div>
<div  class="container">
        @if($errors->any())
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

        <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
        {{$errors->first()}}
        </div>
        </div>
        @endif
   
    <div class="p-3">
        <hr>
        <h1 class="text-center"> Lession {{$lessionId}}: Kiểm tra </h1>
        <div class="m-3 d-flex justify-content-between">
            <h3>Vocab: {{$doneVocab}}/{{$totalVocab}}</h3>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" onclick="showModal('vocab')">Làm lại từ đầu <i class="fa-solid fa-repeat"></i></button>
                <div class="vr mx-3"></div>
                <a class="btn btn-success" href="/lession/{{$lessionId}}/vocab">Tiếp tục <i class="fa-solid fa-play"></i></a>
            </div>
           
        </div>
        <div class="progress">
        <div class="progress" style="width: 100%">
            
            <div class="progress-bar bg-success" style="width: {{$vocabPercent}}%"
              >{{$vocabPercent}}%
            </div>
            <!-- <div class="progress-bar bg-danger 
                progress-bar-stripped" style="width: 30%">
                30%
            </div> -->
        </div>
        </div>
    </div>

    <div class="p-3">
        <hr>
        <div class="m-3 d-flex justify-content-between">
            <h3>Reading: {{$doneReading}}/{{$totalReading}}</h3>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" onclick="showModal('reading')" >Làm lại từ đầu <i class="fa-solid fa-repeat"></i></button>
                <div class="vr mx-3"></div>
                <a class="btn btn-success" href="/lession/{{$lessionId}}/reading">Tiếp tục <i class="fa-solid fa-play"></i></a>
            </div>
           
        </div>
        <div class="progress">
        <div class="progress" style="width: 100%">
            
            <div class="progress-bar bg-success" style="width: {{$readPercent}}%"
          >{{$readPercent}}%
            </div>
            <!-- <div class="progress-bar bg-danger 
                progress-bar-stripped" style="width: 30%">
                30%
            </div> -->
        </div>
        </div>
    </div>
    <div class="p-3">
        <hr>
        <div class="m-3 d-flex justify-content-between">
            <h3>Sentence: {{$doneSentence}}/{{$totalSentence}}</h3>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" onclick="showModal('sentence')" >Làm lại từ đầu <i class="fa-solid fa-repeat"></i></button>
                <div class="vr mx-3"></div>
                <a class="btn btn-success" href="/lession/{{$lessionId}}/sentence">Tiếp tục <i class="fa-solid fa-play"></i></a>
            </div>
           
        </div>
        <div class="progress">
        <div class="progress" style="width: 100%">
            
            <div class="progress-bar bg-success" style="width: {{$senPercent}}%"
            >{{$senPercent}}%
            </div>
            <!-- <div class="progress-bar bg-danger 
                progress-bar-stripped" style="width: 30%">
                30%
            </div> -->
        </div>
        </div>
    </div>
    <div class="p-3">
        <hr>
        <div class="d-flex justify-content-between">
            <h3>Kiểm tra</h3>
            <a class="btn btn-primary" href="/lession/{{$lessionId}}/final">Bắt đầu</a>
        </div>
      
    </div>
    
</div>


<div  id='modal' class="d-none border rounded fixed-top" style="width: 50%;margin: auto; background-color: white;">
    <h2 class="text-center bg-primary text-white p-2">Modal</h2>
    <hr>
    <div class="m-4 py-4">
        <h3 class="text-center mb-3">Thông báo</h3>
        <h4> Bạn có thực sự muốn làm lại mục <span id='redoPart'>//redoPart//</span> của lession {{$lessionId}}. Chúng tôi sẽ xóa bỏ các tiến trình trước đây. Nhấn xác nhận
            để đồng ý, hoặc hủy nếu muốn làm tiếp tục.
        </h4>
    </div>
    <hr>
    <div class="d-flex my-4 flex-row-reverse">
        <a class="btn btn-success mx-3" id='clearLink' >Xác nhận</a>
        <button class="btn btn-danger mx-2" onclick="closeModal()" >Hủy</button>
    </div>

</div>

@endsection

@section('scripts')
<script>
var redoPart = '';
const lessionId = @json($lessionId) ;

const confirmLink = document.getElementById("clearLink");
const redoSpan = document.getElementById("redoPart");
const modal = document.getElementById("modal");
const overlayDiv = document.getElementById("overlay");


function showModal(type){
    console.log(type);
    console.log("click")
    redoSpan.innerHTML = type
    modal.classList.toggle('d-none')
    overlayDiv.classList.toggle('d-none')
    confirmLink.href = '/lession/' + lessionId +'/reset' + type;
    
}

function closeModal(){
    modal.classList.toggle('d-none')
    overlayDiv.classList.toggle('d-none')
    confirmLink.href = "#"
}

// window.onload = function() {
//         document.getElementById("myLink").href = "/" + redoPart;
//     }


</script>

@endsection