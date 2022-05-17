function changeAllArticleColors() {
    const articles = document.querySelectorAll("#menuItems article")

    for (let article of articles) {
        article.classList.add("sale")
    }
}

function attachBuyEvents() {
    const buttons = document.querySelectorAll("#menuItems button")
    for (let button of buttons) {
        button.addEventListener('click', function() {
            let parent = this.parentElement
            console.log(parent)
            parent.classList.toggle("sale")
            const id = parent.getAttribute('data-id')
            console.log(id)
            const name = parent.querySelector("h2").textContent
            console.log(name)
            const price = parent.querySelector(".price").textContent
            console.log(price)
            const quantity = parent.querySelector(".quantity").value
            console.log(quantity)


            let tr = document.createElement("TR")
            let td = document.createElement("TD")
            td.appendChild(document.createTextNode(id))
            tr.appendChild(td)
            td = document.createElement("TD")
            td.appendChild(document.createTextNode(name))
            tr.appendChild(td)
            td = document.createElement("TD")
            td.appendChild(document.createTextNode(quantity))
            tr.appendChild(td)
            td = document.createElement("TD")
            td.appendChild(document.createTextNode(price))
            tr.appendChild(td)
            td = document.createElement("TD")
            td.appendChild(document.createTextNode(price * quantity))
            tr.appendChild(td)
            td = document.createElement("TD")
            td.appendChild(document.createTextNode("del"))
            tr.appendChild(td)

            document.querySelector("#cart tfoot").appendChild(tr)
        })
    }
}