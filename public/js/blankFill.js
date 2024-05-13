class fillInBlank {
    constructor(question,bingo,image){
        this.container = document.createElement("div")
        this.question = question
        this.bingo = bingo.split(" ")
        this.image = image
        console.log(this.image)
        this.builder()
    }

    builder(){
        this.createHeading();
        this.container.appendChild(this.createImage())
        this.container.appendChild(this.createText())
        this.container.appendChild(this.createConfirmBTN())

    }
    createImage(){
        var div = document.createElement('div')
        div.classList.add("d-flex")
        div.classList.add("justify-content-center")

        var img = document.createElement('img')
        img.setAttribute('src',this.image)
        img.setAttribute('alt','fill in word')
        
        img.style.width = `150px`
        img.style.height = `150px`
        img.classList.add("thumbnail")
        div.appendChild(img);
        return div
    }

    createHeading(){
     
        var heading = document.createElement("h1")
        heading.innerHTML = "Điền một ký tự nào đó vào chỗ trống"
        this.container.appendChild(heading)
    }
    createText(){
        
        var text = document.createElement("h2")
        text.classList.add("m-3")
        var questionPart =this.question.replaceAll("__","_").split(" ")
        console.log(questionPart)
        questionPart.forEach((x)=>{
            if(x === "_"){
                text.appendChild(this.createBlank())
                text.innerHTML = text.innerHTML + " "
            }
            else{
                
                text.innerHTML = text.innerHTML + x +" "
            }
        })
        return text

    }
    createConfirmBTN(){
        var button = document.createElement("button")
        button.innerHTML = "confirm"
        button.classList.add("btn")
        button.classList.add("btn-outline-success")
        button.addEventListener("click",()=>{
            var inputHTMLs = this.container.getElementsByClassName("input-value")
            
            
            var inputArray = []
            for(let i = 0; i < inputHTMLs.length;i++){
                console.log(inputHTMLs[i].value)
                inputArray.push(inputHTMLs[i].value)
            } 
            if (inputArray.length===0)
            {
                alert("vui long dien vao cho trong")
            }
            
            var bingoText = this.bingo.join(" ")
            console.log("bingo: " + bingoText)
            if (inputArray.length !== this.bingo.length)
            {
                console.log("code sai rồi")
                return;
            }
            var trueBlank = 0
            for (let i = 0; i< inputArray.length;i++)
            {
                console.log(inputArray[i])
                console.log(this.bingo[i])
                if(inputArray[i].toLowerCase().trim() === this.bingo[i].toLowerCase().trim())
                {
                    inputHTMLs[i].classList.add("bg-success")
                    trueBlank+=1
                }
                else{
                    inputHTMLs[i].classList.add("bg-danger")
                }
            }
            if (trueBlank === this.bingo.length)
            {
                score += 100;
                console.log(typeof(score))
                scorePlace.innerHTML = `Score: ${score}`
                formTrue.value = 'true'
                formScore.value = score;
            }
           
            
            button.setAttribute("disabled","disabled")      
        })
        return button
    }
    createBlank(){
        var input = document.createElement("input")
        input.type = "text"
        input.classList.add("input-value")
        return input
    }
}