// Get all quantity, price, and total price elements
var qtyInputs = document.querySelectorAll('.qty');
var priceElements = document.querySelectorAll('.price');
var totalPriceElements = document.querySelectorAll('.totalPrice');
var overallTotalElement = document.getElementById('overallTotal');

// Initialize and calculate the initial total prices
for (var i = 0; i < qtyInputs.length; i++) {
    calculateTotalPrice(i);
    
}

// Add event listeners to quantity inputs
qtyInputs.forEach(function(qtyInput, index) {
    
    qtyInput.addEventListener('input', function() {
        calculateTotalPrice(index);
        updateOverallTotal();
        
    });
});

// Function to calculate total price for a specific row
function calculateTotalPrice(index) {
    var quantity = parseFloat(qtyInputs[index].value) || 0;
    var price = parseFloat(priceElements[index].textContent) || 0;
    var total = (quantity * price).toFixed(2);
    totalPriceElements[index].textContent = total;
}

// Function to update the overall total
function updateOverallTotal() {
    var overallTotal = 0;
    totalPriceElements.forEach(function(totalPriceElement) {
        overallTotal += parseFloat(totalPriceElement.textContent) || 0;
    });
    overallTotalElement.textContent = overallTotal.toFixed(2);
}
updateOverallTotal();