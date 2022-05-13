const searchRestaurant = document.querySelector('#searchRestaurant')
if (searchRestaurant) {
    searchRestaurant.addEventListener('input', async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''

        for (const restaurant of restaurants) {
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