@extends('layout.layout')

@section('content')
<div class='container'>
 <h1>{{$lessionId}}</h1>
 <div *ngIf="response!== undefined">
        <h1 class="text-center">Lession {{response.lessionId}}: {{response.title}} / {{response.vietnamese}}</h1>
        <div class="row">
            <div class="col-6 border border-info p-3">
                <div>
                    <h1>
                        Bảng xếp hạng 
                    </h1>  
                    <div class="mt-4">
                    <main>
                        <div id="header">
                            <h1>Ranking</h1>
                         
                            <button class="share">
                              <strong>Top {{this.topRanks.length}}</strong>
                            </button>
                          </div>
                          <div id="leaderboard">
                            <div class="ribbon"></div>
                            <table>
                              <tr *ngIf="this.topRanks.length === 0">
                                <td>Chưa có ai trên bảng xếp hạng.</td>
                              </tr>
                              <tr *ngFor="let rank of topRanks;index as i">
                                <td class="number">{{i + 1}}</td>
                                <td class="name">{{rank.userName}}</td>
                                <td class="points">
                                  {{rank.score}} <img *ngIf="i === 0 " class="gold-medal" src="https://github.com/malunaridev/Challenges-iCodeThis/blob/master/4-leaderboard/assets/gold-medal.png?raw=true" alt="gold medal"/>
                                </td>
                              </tr>
                            </table>
                            
                          </div>
                    </main>
                    </div>
                </div>
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
                                      <label for="exampleFormControlTextarea1" class="visually-hidden">
                                        Comment</label
                                      >
                                      <textarea
                                        #myTextArea
                                        class="form-control form-control-sm border border-2 rounded-1"
                                        id="exampleFormControlTextarea1"
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
                                  <button (click)="myTextArea.value = ''" class="btn btn-link btn-sm me-2 text-decoration-none">
                                    Hủy
                                  </button>
                                  <button
                                    (click)="sendComment(myTextArea.value)"
                                    type="submit"
                                    class="btn btn-primary btn-sm"
                                  >
                                    Gửi
                                  </button>
                                </footer>
                              </div>
                          </div>
                            
                              <aside class="d-flex justify-content-between align-items-center my-4">
                                <h4 class="h6">{{comments.length}} Comments / Bình luận</h4>
                                </aside>
                               
                                  <article *ngFor="let comment of comments" class="card bg-light mb-4">
                                    <header class="card-header border-0 bg-transparent d-flex align-items-center">
                                      <div>
                                      <img
                             
                                        src="https://via.placeholder.com/40x40"
                                        class="rounded-circle me-2"
                                      /><a class="fw-semibold text-decoration-none">{{comment.userName}}</a>
                                      <span class="ms-3 small text-muted">{{dateFromNow(comment.commentDate)}}</span>
                                      </div>
                                      <div class="dropdown ms-auto">
                                  
                                    </div>
                                    </header>
                                    <div class="card-body py-2 px-3">
                                      {{comment.comment}}
                                    </div>
                                    <footer class="card-footer bg-white border-0 py-1 px-3">
                                      
                                    </footer>
                                  </article>
                        </div>
                  
                </div>
               
            </div>
            <div class="col-6 p-2 border border-danger">
                <div>
                    <img style="max-height:100%; max-width:100%;object-fit: contain;" src="{{response.image}}" alt = "{{response.title}}">
                    <h1 class="pt-4">
                        Mô tả 
                    </h1>
                    <h3>{{response.description}}.</h3>
                </div>
                <div class="border p-5 m-3">
                    <h1>
                        <button class="btn btn-primary" routerLink="/instruction/{{lessionId}}"> Huong dan </button>
                    </h1>
                    <h1>
                       <button class= "btn btn-secondary" (click)="startTest()">Bắt đầu kiểm tra</button>
                    </h1>
                </div>
                <hr>
                <div class="m-4">
                  <h5 class="mt-3 mb-3">Performance score</h5>
                  <div *ngIf="response.userScore !== null" class="p-4 border rounded">
                    <div class="d-flex justify-content-center">
                      <img src="https://cdn3.vectorstock.com/i/1000x1000/95/72/business-avatar-icon-abstract-triangle-vector-4269572.jpg" style="width: 50px;height: 50px;">
                      <h3 class="m-3">{{userName}}</h3>
                    </div>
                    <div [ngClass]="(response.userScore.score === 1500) ? 'perfect-score' : (response.userScore.score >= 1100) ? 'good-score' : (response.userScore.score >= 800) ? 'normal-score': 'bad-score'" class="p-1 px-4 d-flex flex-column align-items-center score rounded-pill">
                      <span class="d-block char"><strong>{{response.userScore.score}}</strong></span>
                      <span class="text-center">--</span>
                      <span class="text-success">1500</span>
                    </div>
                  </div>
                      
              
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection