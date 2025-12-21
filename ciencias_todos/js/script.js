document.addEventListener('DOMContentLoaded', function() {
    // Confirmação antes de enviar
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (e.submitter && e.submitter.name === 'salvar_conceito') {
                if (!confirm('Deseja salvar este conceito?')) {
                    e.preventDefault();
                }
            }
        });
    });

    // Melhora visual dos selects
    document.querySelectorAll('select').forEach(select => {
        select.addEventListener('focus', function() {
            this.style.borderColor = '#3498db';
            this.style.boxShadow = '0 0 5px rgba(52, 152, 219, 0.5)';
        });
        
        select.addEventListener('blur', function() {
            this.style.borderColor = '#ddd';
            this.style.boxShadow = 'none';
        });
    });
});