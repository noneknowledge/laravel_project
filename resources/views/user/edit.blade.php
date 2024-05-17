@extends('layout.layout')
@section('title','Edit profile')

@section('content')

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
                                <h4>{{$curUser->UserName}}</h4>
                                <p class="text-secondary mb-1">{{$curUser->FullName}}</p>
								</div>
							</div>
							<hr class="my-4">
							
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
                        <form action='{{url("/editProfile")}}' method='POST'>{{ csrf_field()}}

						<div class="card-body">
                        <div class="row mb-3" hidden> 
								<div class="col-sm-9 text-secondary">
									<input type="text" name='userid' class="form-control" value="{{$curUser->UserID}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Họ và tên</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name='fullname' class="form-control" value="{{$curUser->FullName}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name='email' class="form-control" value="{{$curUser->Email}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Số điện thoại</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name='phone' class="form-control" value="{{$curUser->Phone}}">
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Ngày sinh</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="date" name='dateofbirth' class="form-control" value="{{$curUser->DateOfBirth}}">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Lưu thay đổi">
								</div>
							</div>
						</div>
                        </form>
					</div>
					
				</div>
			</div>
			<div class="row m-1 p-4 border rounded">
			@if($userLessions->Count() == 0)
			<h1 class='text-center text-danger'>Bạn chưa tham gia bài học nào</h1>
			@endif
			@foreach ( $userLessions as $userLession )
			<div class="card col-4 m-2" style="width: 18rem;">
				<img style="height: 200px;" src="{{$userLession->Lessions->Image}}" class="card-img-top" alt="{{$userLession->Lessions->Title}}">
				<div class="card-body">
					<h5 class="card-title">Lession: {{$userLession->Lessions->LessionID}} - {{$userLession->Lessions->Title}}</h5>
					<p class="card-text">{{$userLession->Lessions->Description}}</p>
					<div class="text-center">
						{{$userLession->HighScore}} / 1000
					</div>
				</div>
				</div>
			@endforeach 
   
  </div>

		</div>
	</div>

@endsection