$(document).ready(() => {
    console.log("DOM fully loaded and parsed");

    let table = $('#tbody');
    let currentId = 1;

    const addRow = (object) => {
        let newRow = $('<tr>');
        let newId = $('<th>').text(currentId);
        let newName = $('<td>').text(object.name);
        let newScore = $('<td>').text(object.score);
        currentId++;

        newRow.append(newId, newName, newScore);

        table.append(newRow);
    }

    $('#addParticipants').on({
        click: (e) => {
            e.preventDefault();
            let participants = $('#participants').val();

            $.ajax({
                url: '../api/score.php',
                method: 'POST',
                data: {
                    participants: participants
                },

                success: (data) => {
                    let response = JSON.parse(data);

                    for (let i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        addRow(response[i], currentId);
                    }
                },

                error: (err) => {
                    console.log(err);
                }
            })
        }
    });

    let rows = table.find('tr').toArray();

    const tableSort = {
        id: $('#id'),
        name: $('#name'),
        score: $('#score'),
        //rows: table.find('tr').toArray(),

        methods: {
            sortId: () => {
                rows.sort((a, b) => {
                    let idA = parseInt($(a).find('th').text());
                    let idB = parseInt($(b).find('th').text());
                    return idA - idB;
                  });
                  table.empty();
                  table.append(this.rows);
            },

            sortName: () => {
                rows.sort((a, b) => {
                    let nameA = $(a).find('td').text();
                    let nameB = $(b).find('td').text();
                    
                    if (nameA < nameB) return -1;
                    if (nameA > nameB) return 1;
                    return 0;
                });
                table.empty();
                table.append(this.rows);
            },

            sortScore: () => {
                rows.sort((a, b) => {
                    let scoreA = parseInt($(a).find('td').text());
                    let scoreB = parseInt($(b).find('td').text());
                    return scoreA - scoreB;
                });
                table.empty();
                table.append(this.rows);
            }
        }
    }

    tableSort.id.click(tableSort.methods.sortId);
    tableSort.name.click(tableSort.methods.sortName);
    tableSort.score.click(tableSort.methods.sortScore);

})