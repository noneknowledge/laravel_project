@extends("layout.layout")
@section('title')
Lession {{$lessionId}} Test
@endsection

@section('content')
<div id='overlay' style='width:100%; height:100%;z-index:1' class='d-none position-absolute bg-secondary'></div>
<div  class="container">
    <h1>Nhớ sửa truy vấn done vocab. đang để cả 3 là tìm vocab</h1>
   
    <div class="p-3">
        <hr>
        <h1 class="text-center"> Lession {{$lessionId}}: Kiểm tra </h1>
        <div class="m-3 d-flex justify-content-between">
            <h3>Vocab: {{$doneVocab}}/{{$totalVocab}}</h3>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" onclick="showModal('vocab')">Làm lại từ đầu <i class="fa-solid fa-repeat"></i></button>
                <div class="vr mx-3"></div>
                <button class="btn btn-success" routerLink="/test/{{$lessionId}}/vocab/keep">Tiếp tục <i class="fa-solid fa-play"></i></button>
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
                <button class="btn btn-success" routerLink="/test/{{$lessionId}}/reading/keep">Tiếp tục <i class="fa-solid fa-play"></i></button>
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
                <button class="btn btn-success" routerLink="/test/{{$lessionId}}/sentence/keep">Tiếp tục <i class="fa-solid fa-play"></i></button>
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
            <button class="btn btn-primary" routerLink="/lession/{{$lessionId}}">Bắt đầu</button>
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
    
}

function closeModal(){
    modal.classList.toggle('d-none')
    overlayDiv.classList.toggle('d-none')
}

// window.onload = function() {
//         document.getElementById("myLink").href = "/" + redoPart;
//     }


</script>

@endsection