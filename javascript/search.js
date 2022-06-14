const searchRestaurant = document.querySelector('#searchRestaurant input')
const searchButton = document.querySelector('#searchRestaurant button')
const ENTER_KEY_CODE = 13;

async function search(search) {
    const response = await fetch('../api/api_restaurants.php?search=' + search)
    const categories = await response.json()

    searchButton.addEventListener('click', function() { drawRestFunction(categories) });
    searchRestaurant.addEventListener('keyup', function(e) {
        if (e.keyCode === ENTER_KEY_CODE) { drawRestFunction(categories) }
    })
}

if (searchRestaurant && searchButton) {
    search('');
    searchRestaurant.addEventListener('input', function() {
        search(this.value)
    })

}


var drawRestFunction = function(categories) {
    const searchCategory = document.querySelector('#select-category')


    const section = document.querySelector('#restaurants')
    section.innerHTML = ''

    const title = document.createElement('h2')
    title.textContent = 'Restaurants'
    section.append(title)

    for (const category of categories) {
        if (searchCategory.value == 'none' || searchCategory.value == category[1][0]) {
            const catName = document.createElement('h3')
            catName.textContent = category[1][0]

            const catDesc = document.createElement('p')
            catDesc.textContent = category[1][1]

            const catDiv = document.createElement('div')
            catDiv.appendChild(catName)
            catDiv.appendChild(catDesc)

            const catSection = document.createElement('section')
            catSection.setAttribute('id', category[1][0])
            catSection.appendChild(catDiv)

            for (const restaurant of category[0]) {
                console.log('found')

                const img = document.createElement('img')
                img.src = 'https://picsum.photos/200?' + restaurant.id
                img.alt = ''

                const link1 = document.createElement('a')
                link1.appendChild(img)
                link1.href = '../pages/restaurant.php?id=' + restaurant.id
                link1.classList.add('restImage')
                link1.setAttribute('id', 'restImage-' + restaurant.id)

                const link2 = document.createElement('a')
                link2.textContent = ' ' + restaurant.name + ' ' + restaurant.rating + ' star'
                link2.href = '../pages/restaurant.php?id=' + restaurant.id
                link2.classList.add('restName')
                link2.setAttribute('id', 'restName-' + restaurant.id)

                const phrase = document.createElement('p')
                phrase.textContent = restaurant.description
                phrase.classList.add('restDesc')
                phrase.setAttribute('id', 'restDesc-' + restaurant.id)

                const button1 = document.createElement('button')
                const button2 = document.createElement('button')
                button1.setAttribute('id', 'descClose-' + restaurant.id)
                button2.setAttribute('id', 'descOpen-' + restaurant.id)
                button1.classList.add('descClose')
                button2.classList.add('descOpen')
                button1.textContent = '-'
                button2.textContent = '+'
                button1.type = 'button'
                button2.type = 'button'
                button1.onclick = function(event) {
                    let id = restaurant.id;
                    let restDesc = "restDesc-" + id;
                    let descOpen = "descOpen-" + id;
                    let descClose = "descClose-" + id;
                    document.getElementById(restDesc).style.display = "none";
                    document.getElementById(descOpen).style.display = "block";
                    document.getElementById(descClose).style.display = "none";
                }
                button2.onclick = function(event) {
                    let id = restaurant.id;
                    let restDesc = "restDesc-" + id;
                    let descOpen = "descOpen-" + id;
                    let descClose = "descClose-" + id;
                    document.getElementById(restDesc).style.display = "block";
                    document.getElementById(descOpen).style.display = "none";
                    document.getElementById(descClose).style.display = "block";
                }

                const div = document.createElement('div')
                div.appendChild(link1)
                div.appendChild(link2)
                div.appendChild(phrase)
                div.append(button1)
                div.append(button2)
                div.classList.add('restImageName')

                const article = document.createElement('article')
                article.appendChild(div)
                catSection.appendChild(article)
            }
            section.append(catSection)
        }
    }
}