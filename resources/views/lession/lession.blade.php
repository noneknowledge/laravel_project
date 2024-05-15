@extends('layout.layout')
@section('title')
Lession - {{$lession->LessionID}}
@endsection
@section('content')
<div class='container'>

 <div >
        <h1 class="text-center">Lession {{$lession->LessionID}}: {{$lession->Title}} / {{$lession->Vietnamese}}</h1>
        @if($errors->has('msg'))
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
        {{$errors->first('msg')}}
        @if ($errors->has('navigate'))
        <a class="btn btn-info" href="/lession/{{ $errors->first('navigate')}}">Lession: {{ $errors->first('navigate')}} </a>
           
    
        @endif
        </div>
        </div>
        @endif
        <div class="row">
            <div class="col-6 border border-info p-3">
                
                <div class="mt-5">
                    <h1>Khu vực bình luận </h1>
                        <div class="p-4">
                          @if(Auth::check())
                          <div>
                            <h2> Hãy comment văn minh vì có thể phụ huynh bạn sẽ xem được</h2>
                            <div [style.pointer-events]="!canComment ? 'none' : 'auto'" class="card bg-light">
                                <header class="card-header border-0 bg-transparent">
                                  <img
                                    src="https://via.placeholder.com/40x40"
                                    class="rounded-circle me-2"
                                  /><a class="fw-semibold text-decoration-none">{{Auth::user()->UserName}}</a>
                                 
                                </header>
                                <form action="{{url('postComment')}}" method="POST">{{ csrf_field()}}
                                <div class="card-body py-1">
                                    <input name='lessionid' hidden value='{{$lession->LessionID}}'>
                                    <div>
                                      <label for="textArea" class="visually-hidden">
                                        Comment</label
                                      >
                                      <textarea
                                        name='comment'
                                        class="form-control form-control-sm border border-2 rounded-1"
                                        id="textArea"
                                        style="height: 50px"
                                        placeholder="Add a comment..."
                                        minlength="3"
                                        maxlength="255"
                                        required
                                      ></textarea>
                                    </div>
                                 
                                </div>
                                <footer class="card-footer bg-transparent border-0 text-end">
                                  <button type='button' onclick='document.getElementById("textArea").value = "";'class="btn btn-link btn-sm me-2 text-decoration-none">
                                    Hủy
                                  </button>
                                  <button
                                    type="submit"
                                    class="btn btn-primary btn-sm"
                                  >
                                    Gửi
                                  </button>
                                  </form>
                                </footer>
                              </div>
                          </div>
                          @else
                          <h2>Vui lòng đăng nhập nếu muốn bình luận</h2>

                          @endif
                        
                         
                            
                              <aside class="d-flex justify-content-between align-items-center my-4">
                                <h4 class="h6">{{$comments->count()}} Comments / Bình luận</h4>
                                </aside>
                                  @foreach($comments as $comment)
                                  <article  class="card bg-light mb-4">
                                    <header class="card-header border-0 bg-transparent d-flex align-items-center">
                                      <div>
                                      <img
                             
                                        src="https://via.placeholder.com/40x40"
                                        class="rounded-circle me-2"
                                      /><a class="fw-semibold text-decoration-none">{{$comment->UserName}}</a>
                                      <span class="ms-3 small text-muted">{{$comment->CommentDate}}</span>
                                      </div>
                                      <div class="dropdown ms-auto">
                                  
                                    </div>
                                    </header>
                                    <div class="card-body py-2 px-3">
                                      {{$comment->Comment}}
                                    </div>
                                    <footer class="card-footer bg-white border-0 py-1 px-3">
                                      
                                    </footer>
                                  </article>
                                  @endforeach
                        </div>
                  
                </div>
               
            </div>
            <div class="col-6 p-2 border border-danger">
                <div>
                    <img style="max-height:100%; max-width:100%;object-fit: contain;" src="{{$lession->Image}}" alt = "{{$lession->Title}}">
                    <h1 class="pt-4">
                        Mô tả 
                    </h1>
                    <h3>{{$lession->Description}}.</h3>
                </div>
                <div class="border p-5 m-3">
                    <h1>
                        <a class="btn btn-primary" href="/lession/instruction/{{$lession->LessionID}}"> Hướng dẫn </a>
                    </h1>
                    <h1>
                       <a class= "btn btn-secondary" href="/lession/{{$lession->LessionID}}/test">Bắt đầu kiểm tra</a>
                    </h1>
                </div>
                <hr>
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection



