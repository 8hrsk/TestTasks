$('document').ready(() => {

    /*

        Есть множество библиотек, которые можно использовать для соритроваки таблиц.
        Если бы это был мой личный проект, или проект в котором важен факт присутствия сортировки
        и не важна реализация, то, без омнения, я бы использовал именно библиотеки.

    */

    const tableActions = { // создаю объек, содержаий селекторы и методы для сортировки
        sortId: $('#id'),
        sortName: $('#name'),
        sortScore: $('#score'),

        SortId() {
            const table = $('table');
            const rows = Array.from(table.find('tbody > tr'));
          
            rows.sort((rowA, rowB) => {
              const aId = parseInt($(rowA).find('th').text());
              const bId = parseInt($(rowB).find('th').text());
          
              return aId - bId;
            });
          
            table.find('tbody').empty().append(rows);
        },

        SortName() {
            const table = $('table');
            const rows = Array.from(table.find('tbody > tr'));
          
            rows.sort((rowA, rowB) => {
              const aName = $(rowA).find('td').eq(0).text();
              const bName = $(rowB).find('td').eq(0).text();
          
              return aName.localeCompare(bName);
            });
          
            table.find('tbody').empty().append(rows);
        },

        SortScore() {
            const table = $('table');
            const rows = Array.from(table.find('tbody > tr'));
          
            rows.sort((rowA, rowB) => {
              const aScore = parseInt($(rowA).find('td').eq(1).text());
              const bScore = parseInt($(rowB).find('td').eq(1).text());
          
              return aScore - bScore;
            });
          
            table.find('tbody').empty().append(rows);
        }
    }

    tableActions.sortId.click((e) => {
        tableActions.SortId();
    })

    tableActions.sortName.click((e) => {
        tableActions.SortName();
    })

    tableActions.sortScore.click((e) => {
        tableActions.SortScore();
    })

});