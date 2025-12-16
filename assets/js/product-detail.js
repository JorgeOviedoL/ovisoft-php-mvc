function selectPricing(element, type) {
    // Remove active classes from all options
    document.querySelectorAll('.pricing-option').forEach(el => {
        el.classList.remove('border-primary', 'bg-primary-subtle');
        el.querySelector('.text-uppercase').classList.remove('text-primary');
        el.querySelector('.text-uppercase').classList.add('text-muted');
    });

    // Add active classes to selected option
    element.classList.add('border-primary', 'bg-primary-subtle');
    element.querySelector('.text-uppercase').classList.remove('text-muted');
    element.querySelector('.text-uppercase').classList.add('text-primary');

    // Update Button Text
    const buyBtn = document.querySelector('.btn-pulse');
    if (buyBtn) {
        if (type === 'saas') {
            buyBtn.textContent = 'Suscribirse Ahora';
        } else {
            buyBtn.textContent = 'Comprar Licencia';
        }
    }
}
