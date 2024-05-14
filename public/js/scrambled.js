console.log('imported')

class ScrambledCont{
    constructor(question, canva){
        this.question = question.trim()
        this.textClass = ["d-inline","border","p-2","position-absolute","rounded","moveAnimate","h1-clickable","shadow"]
        this.heading = "Hãy sắp xếp các từ sau thành câu hoàn chỉnh."
        this.canva = canva;
        this.answer = []
        this.toRect
        this.fromRect
        this.speech = new SpeechSynthesisUtterance();
        this.voices = []

        this.builder();     
    }   
    createOption(){
       
        var SelectVoice = document.createElement("select")
        
        window.speechSynthesis.onvoiceschanged = () =>{
           
            this.voices = window.speechSynthesis.getVoices()
            this.speech.voice = this.voices[0]
            this.voices.forEach((x,index)=>{
              
                SelectVoice.options[index] = new Option(x.name,index)
            })
        }
        SelectVoice.addEventListener("change",()=>{
            this.speech.voice = this.voices[SelectVoice.value]
        })
        // this.container.appendChild(SelectVoice)
        return SelectVoice
    }

    createOutLine(){
        var container =  document.createElement("div");
        container.classList.add("p-4")

        var headingQuestion = document.createElement("h1")
        headingQuestion.innerHTML = this.heading
        container.appendChild(headingQuestion)

        var hiddenText = document.createElement("h1")
        var display = this.question
        hiddenText.innerHTML = display;
        hiddenText.style.visibility = "hidden"

        var toBar = document.createElement("div")
        toBar.classList.add("border")
        toBar.classList.add("m-3")
        toBar.classList.add("p-5")
        toBar.classList.add("border-success")
        toBar.appendChild(hiddenText.cloneNode(true))
        container.appendChild(toBar)

        var fromBar = document.createElement("div");
        fromBar.classList.add("border")
        fromBar.classList.add("m-3")
        fromBar.classList.add("p-5")
        fromBar.classList.add("border-primary")
        fromBar.appendChild(hiddenText.cloneNode(true))

        container.appendChild(fromBar)   
        this.canva.appendChild(container)
        this.toRect = toBar.getBoundingClientRect();
        this.fromRect = fromBar.getBoundingClientRect();
        
    }
    textClicked(event){
        var elementVal = event.target.innerHTML
        this.speak(elementVal);
        

        if (this.answer.find(a=>a.value === elementVal))
        {
            event.target.style.transform = `translate(0px,0px)`
            this.realignElement(event.target)
       
        }
        else{
            var currentPos = event.target.getBoundingClientRect();
            if (this.answer.length === 0){
                var moveY =- currentPos.top + this.toRect.top +5 
                var moveX = -(currentPos.left - this.toRect.left - 5)
             
                event.target.style.transform = `translate(${moveX}px,${moveY}px)`
            }
            else{
                var previousAnswer = this.answer[this.answer.length-1].el
                var prePos = previousAnswer.getBoundingClientRect();

                var predictRight = currentPos.width + prePos.right
                var moveX 
                var moveY
                if(predictRight > this.toRect.right)
                { 
                  
                    moveY =  -(currentPos.top - prePos.bottom -5 )
                    moveX = -(currentPos.left - this.toRect.left - 5)
                }
                else{
                    moveY =  -(currentPos.top - prePos.top )
                    moveX = -(currentPos.left - prePos.right - 5)
                }
                event.target.style.transform = `translate(${moveX}px,${moveY}px)`
            }
            this.answer.push({el:event.target,value:elementVal})
            
        }
    }
    textAndButton(){
        var previousElement 
        var display = this.question

        var texts = display.split(" ").sort(a=> Math.random() - 0.5)
    
        var container =  document.createElement("div");
        container.classList.add("p-4")
        var index = -1;
        texts.forEach(element => {
            index++
            var quiz = document.createElement("h1");
            this.textClass.forEach( a=>{
                quiz.classList.add(a)
            })
            if(index === 0){
                quiz.style.left = `${this.fromRect.left + 2}px`;
                quiz.style.top = `${this.fromRect.top+ 2}px`;      
            }
            else{
                var elBefore = previousElement.getBoundingClientRect();
                var predictRight = 100 + elBefore.right
               
                if(predictRight > this.fromRect.right)
                { 
                    quiz.style.left = `${this.fromRect.left + 2}px`;
                    quiz.style.top = `${elBefore.bottom + 2 }px`;
                }
                else{
                    quiz.style.left = `${elBefore.right+2}px`;
                    quiz.style.top = `${elBefore.top}px`;
                }         
            } 
            quiz.innerHTML= element
            quiz.addEventListener("click", (event) => this.textClicked(event))
            quiz.addEventListener("mouseover", this.hoverTest)
            quiz.addEventListener("mouseout",this.outTest)

            previousElement = quiz;
           this.canva.appendChild(quiz)     
        });
        
        var button = document.createElement("button")
        button.classList.add("btn")
        button.classList.add("btn-info")
        button.classList.add("mx-auto")
        button.classList.add("d-block")

        button.innerHTML = "check answer"
        button.addEventListener("click", ()=>{
            var finalAnswer = this.answer.map(a=>a.value).join(" ").trim()
            console.log(finalAnswer)
            // stopInterval();
            this.clearListener()
            
            if(this.question === finalAnswer)
                {
                    score += 100             
                    scorePlace.innerHTML = `Score: ${score}`
                    formTrue.value = 'true'
                    formScore.value = score;
                    for (let i = 0; i< this.answer.length;i++){
                        this.answer[i].el.classList.add('bg-success')
                    }
                }
            else{
                for (let i = 0; i< this.answer.length;i++){
                    this.answer[i].el.classList.add('bg-danger')
                }
            }
            
            button.setAttribute("disabled","disabled")
        },{once:true})
        this.canva.appendChild(button)
    }
    builder(){
        this.canva.appendChild(this.createOption());
        this.createOutLine()
        this.textAndButton()
       
    }
    speak(text){
        this.speech.text = text
        window.speechSynthesis.speak(this.speech)
    }
    hoverTest(e){
        e.target.classList.add("bg-info")
  
  
     
    }
    outTest(e){
        e.target.classList.remove("bg-info")
       
    }
    clearListener(){
        var allText = document.getElementsByClassName("h1-clickable")
        for (let i = 0; i<allText.length;i++){
            allText[i].removeEventListener("click", this.textClicked)
            allText[i].removeEventListener("mouseover", this.hoverTest)
            allText[i].removeEventListener("mouseout", this.outTest)
        }
    }

    async realignElement(item){   
        
        if(item === this.answer[this.answer.length-1].el)
        {
         
            this.answer = this.answer.filter(a=>a.value !==item.innerHTML)
            return
        }

        var startIn = this.answer.findIndex(a=>a.el === item)
        this.answer = this.answer.filter(a=>a.value !==item.innerHTML)

        for (startIn;startIn<this.answer.length;startIn++){
        
            if(startIn ===0){
                var prePos = {right: this.toRect.left,top: this.toRect.top}
        
            }
            else{
                var prePos = this.answer[startIn-1].el.getBoundingClientRect();
            }
            var currEl = this.answer[startIn].el
            var currentPos =  currEl.getBoundingClientRect();
          
            var predictRight = currentPos.width + prePos.right                     
            var moveX 
            var moveY        
            if(predictRight > this.toRect.right)
            { 
             
                moveY =  -(parseInt(currEl.style.top, 10)  - prePos.bottom -5 )
                moveX = -(parseInt(currEl.style.left, 10) - this.toRect.left - 5)
            }
            else{
                moveY =  -(parseInt(currEl.style.top, 10) - prePos.top )
                moveX = -(parseInt(currEl.style.left, 10) - prePos.right - 5)
            }

            // currEl.style.transform = `translate(0px,0px)`
    

            currEl.style.transform = `translate(${moveX}px,${moveY}px)`
            await new Promise(r => setTimeout(r, 150));



        }

    }
}