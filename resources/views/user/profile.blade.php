@extends("layout.layout")

@section('title','Profile')

@section('content')
<div class="container">
    <div class="main-body">
    
         
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$curUser->UserName}}</h4>
                      <p class="text-secondary mb-1">{{$curUser->FullName}}</p>
                 
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3 p-3">
              <h4 class='text-center'>Bài học bạn nên/ có thể tham gia</h4>
              <hr>
              @if($nextLession != null)
              <div class='d-flex justify-content-center'>
              <div *ngFor="let lession of lessions" class="card m-2" style="width: 18rem;">
              <img style="width: 200px" src="{{$nextLession->Image}}" class="card-img-top rounded mx-auto d-block" alt="{{$nextLession->Title}}">
              <div class="card-body">
                <h5 class="card-title">Lession: {{$nextLession->LessionID}} - {{$nextLession->Title}}</h5>
                <p class="card-text">{{$nextLession->Description}}</p>
                <div class="text-center">
                  <a href="/lession/{{$nextLession->LessionID}}" class="btn btn-primary text">Đến bài học</a>
                </div>
              
                </div>
              </div>
              </div>
            
              @else
              <h5 class='text-center'>Bạn đã hoàn thành hết các bài học có trong hệ thống</h5>
              @endif
              <hr>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Họ và tên</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$curUser->FullName}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$curUser->Email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Số điện thoại</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$curUser->Phone}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Ngày sinh</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$curUser->DateOfBirth}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info "href="/edit">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              <div >
                  <div class="card h-100">
                    <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Tiến độ -</i>- bài học</h6>
                    @if($userLessions->Count() == 0)
                      <h1 class='text-center text-danger'>Bạn chưa tham gia bài học nào</h1>
                      @endif
                      @foreach ( $userLessions as $userLession )
                      
                      <div class='my-4'>
                      <hr>
                      <h5 class='d-inline'>Lession {{ $userLession->LessionID}}:     {{$userLession->Lessions->Title}}</h5>
                      <small class="{{ $userLession->Status == 'pass' ? 'text-success  mx-5' : 'text-danger mx-5' }}">{{$userLession->Status}}</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="{{ $userLession->Status == 'pass' ? 'text-success  progress-bar bg-primary' : 'text-danger progress-bar bg-danger' }}"   role="progressbar"
                         style="width: {{(double)number_format($userLession->HighScore/1000*100,0,'.','')}}%" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      </div>
                      
                    
                      @endforeach
                      
                     
                    </div>
                  </div>
                
              </div>



            </div>
          </div>

        </div>
       
</div>


@endsection