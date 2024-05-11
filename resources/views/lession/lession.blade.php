@extends('layout.layout')

@section('content')
<div class='container'>

 <div >
        <h1 class="text-center">Lession {{$lession->lessionID}}: {{$lession->Title}} / {{$lession->Vietnamese}}</h1>
        <div class="row">
            <div class="col-6 border border-info p-3">
                
                <div class="mt-5">
                    <h1>Khu vực bình luận </h1>
                        <div class="p-4">
                          <div  *ngIf="userName!== ''">
                            <h2 *ngIf="!canComment"> Hoàn thành bài tập ở mức trên 1000 điểm mới comment được</h2>
                            <div [style.pointer-events]="!canComment ? 'none' : 'auto'" class="card bg-light">
                                <header class="card-header border-0 bg-transparent">
                                  <img
                                    src="https://via.placeholder.com/40x40"
                                    class="rounded-circle me-2"
                                  /><a class="fw-semibold text-decoration-none">JohnDoe</a>
                                 
                                </header>
                                <div class="card-body py-1">
                                  <form>
                                    <div>
                                      <label for="textArea" class="visually-hidden">
                                        Comment</label
                                      >
                                      <textarea
                                       
                                        class="form-control form-control-sm border border-2 rounded-1"
                                        id="textArea"
                                        style="height: 50px"
                                        placeholder="Add a comment..."
                                        minlength="3"
                                        maxlength="255"
                                        required
                                      ></textarea>
                                    </div>
                                  </form>
                                </div>
                                <footer class="card-footer bg-transparent border-0 text-end">
                                  <button onclick='document.getElementById("textArea").value = "";'class="btn btn-link btn-sm me-2 text-decoration-none">
                                    Hủy
                                  </button>
                                  <button
                                    onclick="sendComment(myTextArea.value)"
                                    type="submit"
                                    class="btn btn-primary btn-sm"
                                  >
                                    Gửi
                                  </button>
                                </footer>
                              </div>
                          </div>
                            
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
                    <img style="max-height:100%; max-width:100%;object-fit: contain;" src="{{$lession->image}}" alt = "{{$lession->title}}">
                    <h1 class="pt-4">
                        Mô tả 
                    </h1>
                    <h3>{{$lession->Description}}.</h3>
                </div>
                <div class="border p-5 m-3">
                    <h1>
                        <a class="btn btn-primary" href="/lession/instruction/{{$lession->LessionID}}"> Huong dan </a>
                    </h1>
                    <h1>
                       <a class= "btn btn-secondary" (click)="startTest()">Bắt đầu kiểm tra</a>
                    </h1>
                </div>
                <hr>
                <div class="m-4">
                  <h5 class="mt-3 mb-3">Performance score</h5>
                 
                      
              
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
console.log("hello word");

</script>

@endsection