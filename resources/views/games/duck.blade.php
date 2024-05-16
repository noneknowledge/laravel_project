@extends('layout.layout')

@section('title','Duck game')

@section('content')
<style>
    #text{
    transition: all .5s ease-in-out;
}

.duck{
    transition: all 6s ease-out;
}

.image{
    width: 100px; /* or any custom size */
    height: 100px; 
    background-size: cover;
    
}
</style>
<div  class="h-75 container">
          <div class="d-flex justify-content-between">
            <h1 id = "score">score</h1>
            <button type="button" onclick="addDuckClick()" class="btn btn-primary">Tạo vịt</button>
            <button type="button" onclick="moveDuckClick()" class="btn btn-primary">di chuyển vịt</button>
          </div>
          
            <div style="min-height: 400px;" class="border  rounded border-black p-5">
                <h1 class="d-flex justify-content-center mb-5">Xin chao day la trang di chuyen con vit</h1>
                <div id="answer" class="border rounded border-success my-5 p-5">
                </div>
                <div id="hint" class="border rounded border-primary mb-5 p-5">
                    
                </div>
                <form id="gun" style="text-align:center">
                  <input name="bullet" type="text" required>
                </form>
            </div>

@endsection

@section('scripts')
<script src="{{asset('js/scrambled.js')}}"></script>
@endsection