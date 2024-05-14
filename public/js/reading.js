class ReadingQuiz{
    constructor(paragraph,question,answer,question2,answer2,canva){
        this.container = canva
        this.paragraph = paragraph
        this.question = question
        this.question2 = question2
        this.answer = answer
        this.answer2 = answer2
        console.log(answer2)
        this.builder()
        this.click1 = 0
        this.click2 = 0
    }
    builder(){
        this.container.appendChild(this.createParagraph())
        this.container.appendChild(this.createQuestion())
        this.container.appendChild(this.createQuestion2())
    }

    createParagraph(){
        var paragraph = document.createElement('h3')
        paragraph.innerHTML = this.paragraph
        return paragraph
    }
    createQuestion(){
        var div = document.createElement('div')
        div.className = 'row p-4'

        var question = document.createElement("h2")
        var italic = document.createElement("i")
        italic.innerHTML = this.question
        question.appendChild(italic)
        div.appendChild(question);

        var btn1 = document.createElement("h2")
        btn1.className="border text-center col-5 text-secondary"
        btn1.innerHTML = 'true';
        btn1.addEventListener('click',(event)=>{this.check1(event)})
        btn1.addEventListener('mouseover',this.hoverHandle)
        btn1.addEventListener('mouseout',this.outHover)
        div.appendChild(btn1);
        var lineBreak = document.createElement("h2")
        lineBreak.classList.add('col');

        div.appendChild(lineBreak)

        var btn2 = document.createElement("h2")
        btn2.className="border text-center col-5 text-secondary"
        btn2.innerHTML = 'false';
        btn2.addEventListener('click',this.check1)
        btn2.addEventListener('mouseover',this.hoverHandle)
        btn2.addEventListener('mouseout',this.outHover)
        div.appendChild(btn2);
        return div;
    }
    createQuestion2(){
        var div = document.createElement('div')
        div.className = 'row p-4'

        var question = document.createElement("h2")
        var italic = document.createElement("i")
        italic.innerHTML = this.question2
        question.appendChild(italic)
        div.appendChild(question);

        var btn1 = document.createElement("h2")
        btn1.className="border text-center col-5 text-secondary"
        btn1.innerHTML = 'true';
        btn1.addEventListener('click',this.check2)
        btn1.addEventListener('mouseover',this.hoverHandle)
        btn1.addEventListener('mouseout',this.outHover)
        div.appendChild(btn1);
        var lineBreak = document.createElement("h2")
        lineBreak.classList.add('col');

        div.appendChild(lineBreak)

        var btn2 = document.createElement("h2")
        btn2.className="border text-center col-5 text-secondary"
        btn2.innerHTML = 'false';
        btn2.addEventListener('click',(event)=>{this.check2(event)})
        btn2.addEventListener('mouseover',this.hoverHandle)
        btn2.addEventListener('mouseout',this.outHover)
        div.appendChild(btn2);
        return div;
    }
    hoverHandle(event){
        event.target.classList.add("bg-info")
        event.target.classList.add("text-white")
        event.target.style.transform = "scale(1.1)"
    }
    outHover(event){
        event.target.classList.remove("bg-info")
        event.target.classList.remove("text-white")
        event.target.style.transform = "scale(1)"
    }

    check1(event){
        var element =  event.target
    var value = element.innerHTML.toLowerCase().trim();
    if(this.click1 >0){
        // alertBootstrap(alertWarning,'Bạn đã trả câu 1 rồi')
        alert("da chọn rồi")
        return 
    }
    this.click1+=1
    var answer = this.answer.toLowerCase().trim();
    if( value === answer){
        element.classList.add('bg-success')
        element.classList.add('text-light')
       
        score += 100
        scorePlace.innerHTML = `Score ${score}`
        // alertBootstrap(alertSuccess,'Bạn đã trả lời đúng câu 1')
    }
    else{
        element.classList.add('bg-danger')
        element.classList.add('text-light')
        // alertBootstrap(alertFail,'Bạn đã trả lời sai câu 1')
    }
    }

    check2(event){
    var element =  event.target
    var value = element.innerHTML.toLowerCase().trim();
    if(this.click2 >0){
        // alertBootstrap(alertWarning,'Bạn đã trả câu 2 rồi')
        return 
    }
    this.click2+=1
    var answer = this.answer2.toLowerCase().trim();
    if( value === answer){
        element.classList.add('bg-success')
        element.classList.add('text-light')
     
        score += 100
        scorePlace.innerHTML = `Score ${score}`
        // alertBootstrap(alertSuccess,'Bạn đã trả lời đúng câu 2')
    }
    else{
        element.classList.add('bg-danger')
        element.classList.add('text-light')
        // alertBootstrap(alertFail,'Bạn đã trả lời sai câu 2')
    }
    }

}