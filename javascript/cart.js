function attachBuyEvents() {
    for (const button of document.querySelectorAll('#menuItems button'))
        button.addEventListener('click', function(e) {
            console.log("bought")
            const article = this.parentElement

            const id = article.getAttribute('data-id')
            const row = document.querySelector(`#cart table tr[data-id="${id}"]`)

            const name = article.querySelector('h4').textContent
            const price = article.querySelector('.price').getAttribute('price')
            const quantity = article.querySelector('.quantity').value

            if (row) updateRow(row, price, quantity)
            else addRow(id, name, price, quantity)

            updateTotal()
        })
}

function checkoutEvent() {
    var price = parseInt(document.querySelector('#cart table tfoot th:last-child').textContent.slice(0, -1))

    document.forms["checkout"]["price"].value = price
    console.log(price)
}


function addRow(id, name, price, quantity) {
    const table = document.querySelector('#cart table')
    const row = document.createElement('tr')
    row.setAttribute('data-id', id)

    const nameCell = document.createElement('td')
    nameCell.textContent = name

    const quantityCell = document.createElement('td')
    quantityCell.textContent = quantity

    const priceCell = document.createElement('td')
    priceCell.textContent = price

    const totalCell = document.createElement('td')
    totalCell.textContent = price * quantity

    const deleteCell = document.createElement('td')
    deleteCell.classList.add('delete')
    deleteCell.innerHTML = '<a href="">X</a>'
    deleteCell.querySelector('a').addEventListener('click', function(e) {
        e.preventDefault()
        e.currentTarget.parentElement.parentElement.remove()
        updateTotal()
    })

    row.appendChild(nameCell)
    row.appendChild(quantityCell)
    row.appendChild(priceCell)
    row.appendChild(totalCell)
    row.appendChild(deleteCell)

    table.appendChild(row)
}

function updateRow(row, price, quantity) {
    const quantityCell = row.querySelector('td:nth-child(2)')
    const totalCell = row.querySelector('td:nth-child(4)')

    quantityCell.textContent = parseInt(quantityCell.textContent, 10) + parseInt(quantity, 10)
    totalCell.textContent = parseInt(quantityCell.textContent, 10) * parseInt(price, 10)
}

function updateTotal() {
    const rows = document.querySelectorAll('#cart table > tr')
    const values = [...rows].map(r => parseInt(r.querySelector('td:nth-child(4)').textContent, 10))
    const total = values.reduce((t, v) => t + v, 0)
    document.querySelector('#cart table tfoot th:last-child').textContent = total + "€"

    const quantities = [...rows].map(r => parseInt(r.querySelector('td:nth-child(2)').textContent, 10))
    const totalItems = quantities.reduce((t, v) => t + v, 0)

    const img = document.createElement('img');
    img.src = '../images/cart.png';
    img.alt = 'cart icon';
    img.width = 30;
    img.height = 30;
    const p = document.createElement('p');
    p.appendChild(img);
    p.appendChild(document.createTextNode("(" + totalItems + ")"))
    document.querySelector('#cart div').innerHTML = '';
    document.querySelector('#cart div').appendChild(p);
}

attachBuyEvents()