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
var img = "https://media.istockphoto.com/vectors/target-duck-doodle-7-vector-id1338754209?k=20&m=1338754209&s=612x612&w=0&h=rgtuU1p1PGQgJKH6BiNQE8Hkse2cFQBng4hKv3ZzbCc=";
var img2 = "image.png"

class DuckModel{
    constructor(word,image = "",compareRect){
        this.word = word;       
        this.compareRect = compareRect
        this.class = ["d-inline","p-3","border","rounded","position-absolute","bg-warning","duck"]
        this.image = image
        this.random = Math.floor(Math.random() *3);
        this.element = this.generateDuck();     
        this.rect = this.element.getBoundingClientRect(); 
     
     
        
    }

    generateDuck(){
        var element = document.createElement("p");
        var div = document.createElement('div');

        element.style.backgroundImage = `url(${this.image})`;
        if (this.random === 0){
          
            element.style.top = `${this.compareRect.top + 5}px`;
            element.style.left = `${this.compareRect.left+5}px`;
        }
        else{
            element.style.right = `${this.compareRect.left  + 5}px`;
            element.style.top = `${this.compareRect.top+5}px`;
        }
        
        element.className = "d-inline  border rounded position-absolute bg-warning duck image";

        // this.class.forEach((x) =>{
        //     element.classList.add(x);
        // })
        
    //    div.appendChild(element)
    //    div.appendChild(element)
    //    document.body.appendChild(div);

        // document.body.appendChild(element);
        return element;
        
        
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
    AllDuck.splice(indexDuck,1)
}

const timer = ms => new Promise(res => setTimeout(res, ms))

function createDuck(index){
    if (index %2 === 0)
        {
            var duck = new DuckModel(DataDuck[index],img,anRect); 
        }
        else{
            var duck = new DuckModel(DataDuck[index],img,hintRect); 
        }
          
        duck.moveDuck();
        setTimeout(()=>{
            duck.removeDuck();
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
            DuckList[i].removeDuck();
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