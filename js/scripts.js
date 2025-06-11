/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

        const cartItems = [];
        const cartCount = document.getElementById('cart-count');
        const cartItemsContainer = document.getElementById('cart-items');
        const totalPriceElement = document.getElementById('total-price');

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const productName = button.getAttribute('data-product');
                const productPrice = parseInt(button.getAttribute('data-price'));
                const productImage = button.getAttribute('data-image');

                // Add product to cart
                cartItems.push({ name: productName, price: productPrice, image: productImage });
                updateCart();
            });
        });

        function updateCart() {
            cartItemsContainer.innerHTML = '';
            let totalPrice = 0;

            cartItems.forEach((item, index) => {
                totalPrice += item.price;
                const cartItem = document.createElement('div');
                cartItem.className = 'd-flex justify-content-between align-items-center mb-2';
                cartItem.innerHTML = `
                    <div>
                        <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;" />
                        <span>${item.name} - Rp. ${item.price}</span>
                    </div>
                    <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remove</button>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            cartCount.textContent = cartItems.length;
            totalPriceElement.textContent = `Total: Rp. ${totalPrice}`;
        }

        function removeFromCart(index) {
            cartItems.splice(index, 1);
            updateCart();
        }
 
        