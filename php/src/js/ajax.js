document.addEventListener('DOMContentLoaded', () => {

    const addForm = document.querySelector('#addForm')
    const updateForm = document.querySelector('#updateForm')
    const deleteForm = document.querySelector('#deleteForm')
    const MODAL = document.querySelector('#modal')

    // Notice: better use Serialize method for get inputs, but it is Vanilla JS :)
    // Notice: it could be DRY
    function ajaxPost(url, data) {
        MODAL.style.display = 'none'

        fetch(url, {
            method: 'POST',
            dataType: "json",
            headers: { 'Content-Type': 'application/json'},
            // mode: { mode: 'no-cors' },
            credentials: 'include',
            body: JSON.stringify(data),
        })
            .then(response => {
                // location.reload()
                console.info('Successfully sent data by Ajax!', response)})
            .catch((error) => {
                console.error('Error:', error)
            })
    }

    addForm.addEventListener('submit', ev => {
        ev.preventDefault()
        const method = 'ADD'
        const id = ev.target.querySelector('[name=id]').value
        const idOrNull = id ? id : null
        const title = ev.target.querySelector('[name=title]').value
        const description = ev.target.querySelector('[name=description]').value
        const csrf_token = ev.target.querySelector('[name=csrf_token]').value
        const data = {csrf_token, method, id: idOrNull, title, description}

        ajaxPost('/controllers/main.php', data)
    })

    updateForm.addEventListener('submit', ev => {
        ev.preventDefault()
        const method = 'UPDATE'
        const id = ev.target.querySelector('[name=id]').value
        const title = ev.target.querySelector('[name=title]').value
        const description = ev.target.querySelector('[name=description]').value
        const csrf_token = ev.target.querySelector('[name=csrf_token]').value
        const data = {csrf_token, method, id, title, description}

        ajaxPost('/controllers/main.php', data)
    })

    deleteForm.addEventListener('submit', ev => {
        ev.preventDefault()
        const method = 'DELETE'
        const id = ev.target.querySelector('[name=id]').value
        const csrf_token = ev.target.querySelector('[name=csrf_token]').value
        const data = {csrf_token, method, id}

        ajaxPost('/controllers/main.php', data)
    })

})