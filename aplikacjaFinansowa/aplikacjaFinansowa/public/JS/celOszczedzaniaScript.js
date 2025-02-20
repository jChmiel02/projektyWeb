document.addEventListener('DOMContentLoaded', function() {
    const editLinks = document.querySelectorAll('.editCel');
    const editCelContainer = document.getElementById('editCelContainer');

    editLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const celId = this.getAttribute('data-id');
            const celToEdit = document.querySelector(`.celItem[data-cel-id="${celId}"]`);

            // Schowaj pozostałe cele
            const cele = document.querySelectorAll('.celItem');
            cele.forEach(function(item) {
                if (item !== celToEdit) {
                    item.style.display = 'none';
                }
            });
            // Wypełnij formularz danymi wybranego celu
            document.getElementById('editNazwa').value = celToEdit.getAttribute('data-nazwa');
            document.getElementById('editKwota').value = celToEdit.getAttribute('data-kwota');
            document.getElementById('editCelId').value = celId;

            // Wyświetl formularz edycji
            editCelContainer.style.display = 'block';
            celeOszczednoscioweForm.style.display = 'none';
        });
    });
});
