var answerBox = document.getElementById("answer");
var hintBox = document.getElementById("hint");
var hintRect = hintBox.getBoundingClientRect();
var anRect = answerBox.getBoundingClientRect();
var gun = document.getElementById("gun");
var scoreHTML = document.getElementById("score")
var score = 0;
var index = -1;

var DataDuck = ["apple","lemon","tea","water","milk","boba tea","teddy bear","soda","pizza"];
var AllDuck = [];
var duckImg = "https://media.istockphoto.com/vectors/target-duck-doodle-7-vector-id1338754209?k=20&m=1338754209&s=612x612&w=0&h=rgtuU1p1PGQgJKH6BiNQE8Hkse2cFQBng4hKv3ZzbCc=";
var itemImages = ["https://www.prospertrading.com/wp-content/uploads/2019/02/Apple-2.jpg",
    "https://th.bing.com/th/id/R.b6ed0902ffc864d338685cbe9a81d6b4?rik=XResj%2f9s6erUOQ&riu=http%3a%2f%2fwallsdesk.com%2fwp-content%2fuploads%2f2017%2f01%2fLemon-Pictures.jpg&ehk=uqmoQmEjzkmOXfbukSeOQdXpFOSM4cHciqbgL%2fw2TfY%3d&risl=&pid=ImgRaw&r=0",
    "https://images.heb.com/is/image/HEBGrocery/001712962",
    "https://i.pinimg.com/originals/b7/ad/ab/b7adab045c1fd0f71974adcdf68756d1.jpg",
    "https://eat2wellness.com.au/wp-content/uploads/2020/02/milk2.jpg",
    "https://1.bp.blogspot.com/-Kht99YSBYoc/XnqCTaYYW0I/AAAAAAAARHQ/gkiyP8Hu--AagT0oXHS-4KhCqIyS40pOACLcBGAsYHQ/s1600/Boba-Tea-00005.jpg",
    "https://www.seekpng.com/png/detail/138-1382592_bean-mr-bean-with-teddy-bear.png",
    "https://i5.walmartimages.com/asr/5ca8cb67-d1eb-40cd-87f1-207a4fdf05ab_1.1b3cb192f5b34ea74ea8a8d93e9626c0.jpeg",
    "https://th.bing.com/th/id/OIP.hpPFxfkapSwOz8FOcET-CwHaHa?rs=1&pid=ImgDetMain"

]

class DuckModel{
    constructor(word,duckImage = "",itemImage = "",compareRect){
        this.word = word;       
        this.compareRect = compareRect
        this.class = ["d-inline","p-3","border","rounded","position-absolute","bg-warning","duck"]
        this.duckImage = duckImage
        this.itemImage = itemImage
        this.random = Math.floor(Math.random() *3);
        this.element = this.generateDuck();     
        this.rect = this.element.getBoundingClientRect(); 
     
     
        
    }

    generateDuck(){
        var div = document.createElement('div');
        div.className = 'd-inline position-absolute duck'
        div.innerHTML = this.word

        var element = document.createElement("p");
        element.style.backgroundImage = `url(${this.duckImage})`;
        if (this.random === 0){
            //thay div thanh element neu nhu khong can 2 hinh
            div.style.top = `${this.compareRect.top + 5}px`;
            div.style.left = `${this.compareRect.left+5}px`;
        }
        else{
            div.style.right = `${this.compareRect.left  + 5}px`;
            div.style.top = `${this.compareRect.top+5}px`;
        }
        
        
        // element.className = "d-inline  border rounded position-absolute bg-warning duck image";

        element.className = "image";

        // this.class.forEach((x) =>{
        //     element.classList.add(x);
        // })
       //test 
       div.appendChild(element)

       var element2 = element.cloneNode(true);
       element2.style.backgroundImage = `url(${this.itemImage})`;

       div.appendChild(element2)
       document.body.appendChild(div);

       return div;
        // end test

        // document.body.appendChild(element);
        //return element;
        
        
    }

    checkAnswer(input){
        console.log("Input nhận đc: "+ input)
        console.log("So sánh với: "+this.word)
        console.log("Kết quả: " + this.word === input.toLowerCase())
        if(this.word === input.toLowerCase())
        {  
            
            console.log("cộng điểm");
            score++;
            scoreHTML.innerHTML = `Score: ${score}`;
            //this.removeDuck();
            return true;
        }
        return false;
      
        
    }

    moveDuck(){

        if( this.random === 0 ){
           // console.log("trái qua phải")
            this.element.style.transform = `translateX(${this.compareRect.width - this.rect.width -10}px)`;
            return;
        }
        // console.log("phải qua trái")
        this.element.style.transform = `translateX(-${this.compareRect.width - this.rect.width - 20}px)`;

    }

    removeDuck(){
        console.log("xoá vịt")
        this.element.remove();
        
    }
}

function deleteDuck(duck){
    let indexDuck = AllDuck.indexOf(duck)
    console.log(indexDuck);
    if(indexDuck === -1){
        return;
    }
    duck.removeDuck();
    console.log(duck.word)
    AllDuck.splice(indexDuck,1)
}

const timer = ms => new Promise(res => setTimeout(res, ms))

function createDuck(index){
    if (index %2 === 0)
        {
            var duck = new DuckModel(DataDuck[index],duckImg,itemImages[index],anRect); 
        }
        else{
            var duck = new DuckModel(DataDuck[index],duckImg,itemImages[index],hintRect); 
        }
          
        duck.moveDuck();
        setTimeout(()=>{
            
            deleteDuck(duck);
        },6000)
        AllDuck.push(duck);
}

async function addDuckClick(){
    index++;
    if(index>DataDuck.length -1){
        alert("Hết vịt;") ; return;
    }
    for (let i = 0;i< DataDuck.length;i++){
        console.log(i)
        if (AllDuck.length < 3){
            createDuck(i);
            await timer(2000);
        }
        else{
            await timer(2000);
        }

        // createDuck(i);
        // await timer(2000);
    }   
    console.log("het vit")
    
    
}

function moveDuckClick(){
    AllDuck[index].moveDuck();
}

function gunFire(value,DuckList){
    console.log("Fire")
    console.log(DuckList.length)
    for (var i = 0; i<=DuckList.length - 1 ; i++){
        console.log("loop")
        console.log("Giá trị nhập: " +value )
        if(DuckList[i].checkAnswer(value)){
            deleteDuck(DuckList[i]);
            break;
        }
    }
}


gun.addEventListener("submit",(event)=>{
    event.preventDefault();
    var value = event.target.bullet.value
    console.log(value)
    gunFire(value,AllDuck);
    event.target.reset();
    event.target.bullet.setAttribute("disabled","disabled")
    setTimeout(()=>{
        event.target.bullet.removeAttribute("disabled");
        event.target.bullet.focus();
    },1000)
})