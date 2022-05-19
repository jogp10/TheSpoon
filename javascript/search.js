const searchRestaurant = document.querySelector('#searchRestaurant input')
if (searchRestaurant) {
    searchRestaurant.addEventListener('input', async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''

        const title = document.createElement('h1')
        title.textContent = 'Restaurants'
        section.append(title)

        console.log(this.value)
        for (const restaurant of restaurants) {
            console.log('found')
            const img = document.createElement('img')
            const article = document.createElement('article')
            img.src = 'https://picsum.photos/200?' + restaurant.id
            const link = document.createElement('a')
            link.href = 'restaurant.php?id=' + restaurant.id
            link.textContent = ' ' + restaurant.name
            const phrase = document.createElement('p')
            phrase.textContent = restaurant.description
            article.appendChild(img)
            article.appendChild(link)
            article.appendChild(phrase)
            section.appendChild(article)
        }
    })
}