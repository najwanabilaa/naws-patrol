document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
    const bankOptions = document.getElementById('bankOptions');
    const ewalletOptions = document.getElementById('ewalletOptions');

    bankOptions.style.display = 'none';
    ewalletOptions.style.display = 'none';

    paymentMethodSelect.addEventListener('change', function() {
        const selectedMethod = this.value;

        bankOptions.style.display = 'none';
        ewalletOptions.style.display = 'none';

        document.querySelector('select[name="bank_type"]').value = '';
        document.querySelector('select[name="ewallet_type"]').value = '';

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

    if (paymentMethodSelect.value) {
        paymentMethodSelect.dispatchEvent(new Event('change'));
    }
}); 