// Shopping cart array
let cart = [];

// Load cart from localStorage
function loadCart() {
    let savedCart = localStorage.getItem('educationalCart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    } else {
        cart = [];
    }
    showCart();
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('educationalCart', JSON.stringify(cart));
    showCart();
}

// Add product to cart
function addToCart(productId, productName, productPrice) {
    let found = false;
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id == productId) {
            cart[i].quantity += 1;
            found = true;
            break;
        }
    }
    if (!found) {
        cart.push({
            id: productId,
            name: productName,
            price: parseFloat(productPrice),
            quantity: 1
        });
    }
    saveCart();
}

// Remove product from cart
function removeItem(productId) {
    let newCart = [];
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id != productId) {
            newCart.push(cart[i]);
        }
    }
    cart = newCart;
    saveCart();
}

// Update product quantity
function updateQuantity(productId, newQty) {
    if (newQty <= 0) {
        removeItem(productId);
        return;
    }
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id == productId) {
            cart[i].quantity = newQty;
            break;
        }
    }
    saveCart();
}

// Display cart in sidebar
function showCart() {
    let cartDiv = document.getElementById('cart-items');
    let totalDiv = document.getElementById('cart-total');
    if (!cartDiv) return;

    if (cart.length === 0) {
        cartDiv.innerHTML = '<p>Shopping cart is empty</p>';
        totalDiv.innerHTML = 'Total: 0 $';
        return;
    }

    let html = '<ul class="cart-list">';
    let total = 0;
    for (let i = 0; i < cart.length; i++) {
        let item = cart[i];
        let itemTotal = item.price * item.quantity;
        total += itemTotal;
        html += `
            <li>
                ${item.name}<br>
                Price: ${item.price.toLocaleString()} USD<br>
                Quantity: <input type="number" min="1" value="${item.quantity}" data-id="${item.id}" class="cart-qty" style="width:60px;">
                <button class="remove-item" data-id="${item.id}">❌ Remove</button>
                <span>${itemTotal.toLocaleString()} USD</span>
            </li>
        `;
    }
    html += '</ul>';
    cartDiv.innerHTML = html;
    totalDiv.innerHTML = `Total: ${total.toLocaleString()} USD`;

    // Attach events to quantity inputs
    let allQtyInputs = document.querySelectorAll('.cart-qty');
    for (let i = 0; i < allQtyInputs.length; i++) {
        allQtyInputs[i].addEventListener('change', function (e) {
            let id = this.getAttribute('data-id');
            let newVal = parseInt(this.value);
            updateQuantity(id, newVal);
        });
    }

    // Attach events to remove buttons
    let allRemoveBtns = document.querySelectorAll('.remove-item');
    for (let i = 0; i < allRemoveBtns.length; i++) {
        allRemoveBtns[i].addEventListener('click', function (e) {
            let id = this.getAttribute('data-id');
            removeItem(id);
        });
    }
}

// Clear checkout form fields
function clearCheckoutForm() {
    const fields = ['customer-name', 'customer-email', 'customer-mobile', 'customer-address'];
    fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
        else console.warn(`Element with id=${id} not found`);
    });
}

// Place order - send to server
function placeOrder() {
    let customerName = document.getElementById('customer-name').value.trim();
    let customerEmail = document.getElementById('customer-email').value.trim();
    let customerMobile = document.getElementById('customer-mobile').value.trim();
    let customerAddress = document.getElementById('customer-address').value.trim();

    let messageDiv = document.getElementById('order-message');

    if (customerName === '' || customerEmail === '' || customerMobile === '' || customerAddress === '') {
        messageDiv.innerHTML = '<span style="color:red">Please fill in all fields</span>';
        return;
    }
    if (cart.length === 0) {
        messageDiv.innerHTML = '<span style="color:red">Shopping cart is empty</span>';
        return;
    }

    let orderData = {
        customer_name: customerName,
        customer_email: customerEmail,
        customer_mobile: customerMobile,
        customer_address: customerAddress,
        cart: cart
    };

    fetch('submit_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(orderData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = '<span style="color:green">Your order has been placed!</span>';
                cart = [];
                saveCart();
                clearCheckoutForm();
            } else {
                messageDiv.innerHTML = '<span style="color:red">Error: ' + data.error + '</span>';
            }
        })
        .catch(error => {
            messageDiv.innerHTML = '<span style="color:red">Server connection error</span>';
        });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    loadCart();

    // Add event listeners to all "Add to Cart" buttons
    let addButtons = document.querySelectorAll('.add-to-cart');
    for (let i = 0; i < addButtons.length; i++) {
        addButtons[i].addEventListener('click', function (e) {
            let id, name, price;

            if (this.hasAttribute('data-id')) {
                id = this.getAttribute('data-id');
                name = this.getAttribute('data-name');
                price = this.getAttribute('data-price');
            } else {
                let card = this.closest('.product-card');
                if (!card) return;
                id = card.getAttribute('data-id');
                name = card.getAttribute('data-name');
                price = card.getAttribute('data-price');
            }
            addToCart(id, name, price);
        });
    }

    // Add event listener to place order button
    let orderBtn = document.getElementById('place-order-btn');
    if (orderBtn) {
        orderBtn.addEventListener('click', placeOrder);
    }
});