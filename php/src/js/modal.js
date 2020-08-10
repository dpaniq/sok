document.addEventListener('DOMContentLoaded', () => {
    
    const CONTAINER = document.querySelector('.container')
    const MODAL = document.querySelector("#modal")
    const MODAL_CLOSE = document.querySelector("[class=close]")
    const MODAL_ADD = document.querySelector('.modal-content__add')
    const MODAL_UPDATE = document.querySelector('.modal-content__update')
    const MODAL_DELETE = document.querySelector('.modal-content__delete')

    function showModalContent() {
        for (element of arguments) {
            element.style.display = 'block'
        }
    }

    function hideModalContent() {
        for (element of [MODAL_ADD, MODAL_UPDATE, MODAL_DELETE]) {
            element.style.display = 'none'
        }
    }

    function disabledSubmitButton(formDOM) {
        const title = formDOM.querySelector('[name=title]')
        const description = formDOM.querySelector('[name=description]')
        const submitBtn = formDOM.querySelector('[name=submit]')

        function titleAndDescription() {
            title.value.length && description.value.length ? submitBtn.removeAttribute('disabled') : submitBtn.setAttribute('disabled', true)
        }

        title.addEventListener('input', titleAndDescription)
        description.addEventListener('input', titleAndDescription)
    }

    disabledSubmitButton(MODAL_ADD)
    disabledSubmitButton(MODAL_UPDATE)

    
    function disabledDeleteButton() {
        const checkbox = MODAL_DELETE.querySelector('[name=sure]')
        const button = MODAL_DELETE.querySelector('[name=delete]')

        checkbox.addEventListener('change', ev => {
            ev.target.checked ? button.removeAttribute('disabled') : button.setAttribute('disabled', true)
        })
    }

    disabledDeleteButton()

    // Aggregate button actions
    document.addEventListener('click', ev => {
        if (ev.target.tagName === 'BUTTON') {
            hideModalContent()
            if (ev.target.textContent === 'Add'){
                const id = ev.target.parentElement.dataset.id
                MODAL_ADD.querySelector('[name=id]').value = typeof id === 'undefined' ? '' : id
                showModalContent(MODAL, MODAL_ADD)

            } else if (ev.target.textContent === 'Update'){

                const id = ev.target.parentElement.dataset.id
                const parent_id = ev.target.parentElement.dataset.parent
                const parentCard = CONTAINER.querySelector('[data-card=' + parent_id + ']')
                const parentTitle = parentCard.querySelector('button').textContent
                const parentDescription = parentCard.querySelector('.card-body p').textContent

                MODAL_UPDATE.querySelector('[name=id]').value = id
                MODAL_UPDATE.querySelector('[name=title]').value = parentTitle
                MODAL_UPDATE.querySelector('[name=description]').value = parentDescription

                showModalContent(MODAL, MODAL_UPDATE)

            } else if (ev.target.textContent === 'Delete'){
                const id = ev.target.parentElement.dataset.id
                MODAL_DELETE.querySelector('[name=id]').value = id

                showModalContent(MODAL, MODAL_DELETE)
            }
        }
    })

    window.addEventListener('click', ev => {
        if (ev.target == MODAL || ev.target == MODAL_CLOSE) {
            MODAL.style.display = "none"
        }
    })
})
