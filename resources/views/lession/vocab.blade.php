@extends("layout.layout")
@section('title','Vocab')

@section("content")

<div *ngIf="randInt===0" class="ml-3">
    <h1 class="text-center">{{question.vietnamese}}</h1>
    <div class="d-flex justify-content-around">
        <h2  class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[0].vocab}} <img src="{{quiz[0].image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2  class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[1].vocab}} <img src="{{quiz[1].image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
    <div class="d-flex justify-content-around">
        <h2  class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[2].vocab}} <img src="{{quiz[2].image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2  class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[3].vocab}} <img src="{{quiz[3].image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
</div>

<div *ngIf="randInt===1" class="ml-3">
    <h1 class="text-center">{{question.vocab}}</h1>
    
    <div class="d-flex justify-content-around">
        
        <h2 class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[0].vietnamese}} <img src="{{quiz[0].image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2 class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[1].vietnamese}} <img src="{{quiz[1].image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
    <div class="d-flex justify-content-around">
        <h2 class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[2].vietnamese}} <img src="{{quiz[2].image}}"  style="width: 100px;height: 100px;" ></h2>
        <h2 class="border p-3 rounded col-5 quiz m-3 d-flex justify-content-between"> {{quiz[3].vietnamese}} <img src="{{quiz[3].image}}"  style="width: 100px;height: 100px;" ></h2>
    </div>
</div>

@endsection


@section('scripts')
<script>


</script>

@endsection