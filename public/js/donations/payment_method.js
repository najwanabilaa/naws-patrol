document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
    const bankOptions = document.getElementById('bankOptions');
    const ewalletOptions = document.getElementById('ewalletOptions');

    // Hide both options initially
    bankOptions.style.display = 'none';
    ewalletOptions.style.display = 'none';

    // Show/hide payment options based on selected method
    paymentMethodSelect.addEventListener('change', function() {
        const selectedMethod = this.value;
        
        // Hide both options first
        bankOptions.style.display = 'none';
        ewalletOptions.style.display = 'none';
        
        // Clear previous selections
        document.querySelector('select[name="bank_type"]').value = '';
        document.querySelector('select[name="ewallet_type"]').value = '';

        // Show relevant option based on selection
        if (selectedMethod === 'bank_transfer') {
            bankOptions.style.display = 'block';
            document.querySelector('select[name="bank_type"]').required = true;
            document.querySelector('select[name="ewallet_type"]').required = false;
        } else if (selectedMethod === 'ewallet') {
            ewalletOptions.style.display = 'block';
            document.querySelector('select[name="bank_type"]').required = false;
            document.querySelector('select[name="ewallet_type"]').required = true;
        }
    });

    // Trigger change event on load if there's a pre-selected value
    if (paymentMethodSelect.value) {
        paymentMethodSelect.dispatchEvent(new Event('change'));
    }
}); 