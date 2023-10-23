$(document).ready(() => {

    let currentId = 1; // 

    /*

        Я посчитал, что нет необходимости доставать id из предыдущей строки, так как она может быть отсортирована.
        Я сделалпеременную, хранящую последний записаный id и использую именно его при обавлении новых строк

    */

    const modal = document.getElementById('Modal');

    const openModal = (modalWindow) => {
        modalWindow.classList.add('show');
        modalWindow.style.display = 'block';
        document.body.classList.add('modal-open'); 
    }

    const closeModal = (modalWindow) => {
        modalWindow.classList.remove('show');
        modalWindow.style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    const addRow = (object) => {
        let newRow = $('<tr>');
        let newId = $('<th>').text(currentId);
        let newName = $('<td>').text(object.name);
        let newScore = $('<td>').text(object.score);
        currentId++;

        newRow.append(newId, newName, newScore);
        $('#tbody').append(newRow);
    }

    const checkValidName = (name) => { // проверка на правильность введенного имени с помощью регулярных выражений
        const regExpPattern = /^[А-ЯЁ][а-яё]+$/;

        return regExpPattern.test(name);
    }

    $('#addParticipants').on({
        'click keypress': (e) => { // jQuery предоставляет готовый метод для обработки нескольких событий
            e.preventDefault(); // отключаю событие по умолчанию
            let participants = $('#participants').val();
            let participantsCheck = participants.split(', ');

            if (participants.length == 0) {
                $('#ModalBody').text('Вы не ввели участников! Пожалуйста, введите участников и повторите попытку.');
                openModal(modal);
                $('#closeModal').click(() => {
                    closeModal(modal);
                })
                return;
            }

            for (let i = 0; i < participantsCheck.length; i++) {
                if (!checkValidName(participantsCheck[i])) {
                    $('#ModalBody').text('Неверно введены данные! Имена не должны содержать пробелы, знаки препинания или латинские символы.' +
                    ' Каждое имя должно начинаться с заглавной буквы.' +
                    ' После каждой запятой, разделяющей имена, должна быть запятая. Пример: "Владимир, Иван"');
                    openModal(modal);
                    $('#closeModal').click(() => {
                        closeModal(modal);
                    })
                    return;
                }
            }

            $('#participants').val('');

/*

            Изначально хотел использовать axios, но воврея одумался

*/


            $.ajax({
                url: '../api/score.php',
                method: 'POST',
                data: {
                    participants: participants
                },

                success: (data) => {
                    let response = JSON.parse(data);

                    for (let i = 0; i < response.length; i++) {
                        addRow(response[i], currentId);
                    }
                },

                error: (err) => {
                    console.log(err);
                    $('#ModalBody').text('Произошла ошибка во время запроса!');
                    openModal(modal);
                    $('#closeModal').click(() => {
                        closeModal(modal);
                    })
                }
            })
        }
    });
})