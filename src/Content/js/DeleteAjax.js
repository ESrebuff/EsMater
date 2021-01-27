class DeleteAjax {
    constructor(elementDelete, elementTodelete) {
        this.elementDelete = elementDelete;
        this.elementTodelete = elementTodelete;
        this.deleteElement();
    }

    deleteElement() {
        let elementTodelete = this.elementTodelete;
        let toRemoves = $(this.elementDelete);
        for (let i = 0; i < toRemoves.length; i++) {
            let toRemove = toRemoves[i];
            toRemove.addEventListener('click', function (e) {
                e.preventDefault(); // block the default action
                let url = toRemove.getAttribute('href');
                toRemove.innerHTML = "Chargement...";
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (datas) {
                        let response = datas;
                        $(elementTodelete + response).remove();
                    },
                    error: function (jqXHR) {
                        alert(jqXHR.responseText);
                    }
                });
            })
        }
    }
}