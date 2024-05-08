@extends("layout")

@section("content")
<h1 class="d-flex justify-content-center">Đây là page admin nè</h1>


<div class="container">
  <!-- <div class="d-flex justify-content-between p-5"> -->
    <div class="row p-4">
   

   @foreach ( $data as $lession )
   <div *ngFor="let lession of lessions" class="card col-3 m-2" style="width: 18rem;">
      <img style="height: 200px;" src="{{$lession->Image}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Lession: {{$lession->LessionId}} - {{$lession->Title}}</h5>
        <p class="card-text">{{$lession->Description}}</p>
        <div class="text-center">
          <a href="/outline/{{$lession->LessionId}}" class="btn btn-primary text">Vào bài học</a>
        </div>
     
      </div>
    </div>
   @endforeach 
   
   
    
  </div>

</div>


@endsection