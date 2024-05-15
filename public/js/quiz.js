
class QuizChoice{
    constructor(quiz,bait,canva){
        this.quiz = quiz
        this.bait = bait
        this.canva = canva
        this.builder()
        console.log('quiz choice')
        this.click = 0
   
    }

    builder(){
        console.log("canva write")
        this.createText()
    }


    createText(){
        var div = document.createElement('div')
        div.className = 'ml-3'

        var question = document.createElement('h1')
        question.className = 'text-center'
        question.innerHTML = this.quiz.Vietnamese
        div.appendChild(question)

        var childDiv = document.createElement('div')
        childDiv.className = 'd-flex justify-content-around'
        var choice1 = document.createElement('h2')
        choice1.className = 'border p-3 rounded col-5 quiz m-3 d-flex justify-content-between'
        choice1.innerHTML = this.bait[0].Vocab
        choice1.addEventListener('click', (event)=>this.quizClick(event))
        choice1.addEventListener("mouseover",this.hoverHandle)
        choice1.addEventListener("mouseout",this.notHoverHanlde)
        
        var img1 = document.createElement('img')
        img1.style.width = '100px'
        img1.style.height = '100px'
        img1.src = this.bait[0].Image
        choice1.appendChild(img1)

        childDiv.appendChild(choice1)

        var choice2 = document.createElement('h2')
        choice2.className = 'border p-3 rounded col-5 quiz m-3 d-flex justify-content-between'
        choice2.innerHTML = this.bait[1].Vocab
        choice2.addEventListener('click', (event)=>this.quizClick(event))
        choice2.addEventListener("mouseover",this.hoverHandle)
        choice2.addEventListener("mouseout",this.notHoverHanlde)
        
        var img2 = document.createElement('img')
        img2.style.width = '100px'
        img2.style.height = '100px'
        img2.src = this.bait[1].Image
        choice2.appendChild(img2)
        
        childDiv.appendChild(choice2)

        div.appendChild(childDiv)

        var childDiv2 = document.createElement('div')
        childDiv2.className = 'd-flex justify-content-around'
        var choice3 = document.createElement('h2')
        choice3.className = 'border p-3 rounded col-5 quiz m-3 d-flex justify-content-between'
        choice3.innerHTML = this.bait[2].Vocab
        choice3.addEventListener('click', (event)=>this.quizClick(event))
        choice3.addEventListener("mouseover",this.hoverHandle)
        choice3.addEventListener("mouseout",this.notHoverHanlde)
        
        var img3 = document.createElement('img')
        img3.style.width = '100px'
        img3.style.height = '100px'
        img3.src = this.bait[2].Image
        choice3.appendChild(img3)

        childDiv2.appendChild(choice3)

        var choice4 = document.createElement('h2')
        choice4.className = 'border p-3 rounded col-5 quiz m-3 d-flex justify-content-between'
        choice4.innerHTML = this.bait[3].Vocab
        choice4.addEventListener('click', (event)=>this.quizClick(event))
        choice4.addEventListener("mouseover",this.hoverHandle)
        choice4.addEventListener("mouseout",this.notHoverHanlde)
        
        var img4 = document.createElement('img')
        img4.style.width = '100px'
        img4.style.height = '100px'
        img4.src = this.bait[3].Image
        choice4.appendChild(img4)
        
        childDiv2.appendChild(choice4)

        div.appendChild(childDiv2)

        this.canva.appendChild(div);

    }

    quizClick(event){
    var value = event.target.textContent.trim()
    var allQ = document.getElementsByClassName("quiz")
    if(this.click > 0){
        alert("Đổi sang câu khác")
        return
    }
    this.click += 1;
    for (let i =0; i< allQ.length;i++){
    allQ[i].removeEventListener("mouseover",this.hoverHandle)
    allQ[i].removeEventListener("mouseout",this.notHoverHanlde)
    }
    this.notHoverHanlde(event);
    
    if ( value === this.quiz.Vocab){
    score += 100;
    scorePlace.innerHTML = `Score: ${score}`
    formTrue.value = 'true'
    formScore.value = score;
    event.target.classList.add("bg-success")
    event.target.classList.add("bg-gradient")
    } 
    else{
 
        event.target.classList.add("bg-danger")
        event.target.classList.add("bg-gradient")
        }
    }
    hoverHandle(event){
    event.target.classList.add("bg-info")
    event.target.classList.add("text-white")
    event.target.style.transform = "scale(1.1)"
    }
    notHoverHanlde(event){
    event.target.classList.remove("bg-info")
    event.target.classList.remove("text-white")
    event.target.style.transform = "scale(1)"
    }
}