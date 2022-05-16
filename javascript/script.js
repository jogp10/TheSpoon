const searchRestaurant = document.querySelector('#searchRestaurant input')
if (searchRestaurant) {
    searchRestaurant.addEventListener('input', async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''

        console.log(this.value)
        for (const restaurant of restaurants) {
            console.log('found')
            const img = document.createElement('img')
            const article = document.createElement('article')
            img.src = 'https://picsum.phots/200?' + restaurant.id
            const link = document.createElement('a')
            link.href = 'restaurant.php?id=' + restaurant.id
            link.textContent = restaurant.name
            article.appendChild(img)
            article.appendChild(link)
            section.appendChild(article)
        }
    })
}

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