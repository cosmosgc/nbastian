<link rel="stylesheet" href="apps/shop-app/assets/style.css">
<div id="shop-app">
    <div class="shop-container">
        <div id="items-list" class="item-list"></div>
        <div class="cart-container">
            <h2 style="
    margin-top: 0px;
    margin-bottom: 5px;
">Cart</h2>
            <div id="cart-list" class="item-list"></div>
            <div class="cart-total">
                Total: <span id="cart-total-price">$0.00</span>
            </div>
        </div>
    </div>
</div>

<script>
    const itemsList = document.getElementById('items-list');
    const cartList = document.getElementById('cart-list');
    const cartTotalPrice = document.getElementById('cart-total-price');
    const cart = [];

    // Fetch items
    fetch('apps/shop-app/load_items.php')
        .then(response => response.json())
        .then(items => {
            items.forEach(item => {
                const itemCard = createItemCard(item);
                itemsList.appendChild(itemCard);
            });
        })
        .catch(error => {
            console.error('Error loading items:', error);
        });

    // Create an item card
    function createItemCard(item) {
        const itemCard = document.createElement('div');
        itemCard.classList.add('item-card');
        itemCard.innerHTML = `
            <img src="apps/shop-app/${item.image}" alt="${item.name}" class="item-image">
            <div class="item-details">
                <h2 class="item-name">${item.name}</h2>
                <p class="item-description">${item.description}</p>
                <p class="item-price">$${item.price}</p>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        `;

        const addToCartButton = itemCard.querySelector('.add-to-cart');
        addToCartButton.addEventListener('click', () => {
            addItemToCart(item);
            updateCart();
        });

        return itemCard;
    }

    // Add an item to the cart
    function addItemToCart(item) {
        cart.push(item);
    }

    // Update the cart display
    function updateCart() {
        cartList.innerHTML = '';
        let totalPrice = 0;

        cart.forEach(item => {
            const cartItemCard = createCartItemCard(item);
            cartList.appendChild(cartItemCard);
            totalPrice += item.price;
        });

        cartTotalPrice.textContent = `$${totalPrice.toFixed(2)}`;
    }

    // Create a cart item card
    function createCartItemCard(item) {
        const cartItemCard = document.createElement('div');
        cartItemCard.classList.add('item-card');
        cartItemCard.innerHTML = `
            <img src="apps/shop-app/${item.image}" alt="${item.name}" class="item-image">
            <div class="item-details">
                <h2 class="item-name">${item.name}</h2>
                <p class="item-price">$${item.price}</p>
                <button class="remove-from-cart">Remove</button>
            </div>
        `;

        const removeFromCartButton = cartItemCard.querySelector('.remove-from-cart');
        removeFromCartButton.addEventListener('click', () => {
            removeItemFromCart(item);
            updateCart();
        });

        return cartItemCard;
    }

    // Remove an item from the cart
    function removeItemFromCart(item) {
        const index = cart.findIndex(cartItem => cartItem === item);
        if (index !== -1) {
            cart.splice(index, 1);
        }
    }
</script>