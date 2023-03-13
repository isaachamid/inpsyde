(function ($) {
    window.addEventListener('load', function () {
        try {
            const url = $('.plugin-container .table-wrapper').data('href');
            getDataAndCreateTable(
                url,
                url,
                '.table-wrapper',
                '.table-details',
                ["id", "name", "username"]
            )
                .then()
                .catch(console.log);
        } catch (e) {
            console.log(e);
        }
    });
})($ = jQuery);

/**
 *
 * @param url
 * @param detailUrl
 * @param mainTableElementContainer
 * @param detailsTableElementContainer
 * @param tableColumns
 * @returns {Promise<void>}
 */
async function getDataAndCreateTable(url, detailUrl, mainTableElementContainer, detailsTableElementContainer = mainTableElementContainer, tableColumns) {
    try {
        const result = await getData(url);
        const table = createTable(result, detailUrl, tableColumns, detailsTableElementContainer);
        $(mainTableElementContainer).append(table);
        $('.table-data > a').on('click', function (e) {
            e.preventDefault();
            const $link = $(this),
                $row = $link.closest('tr');

            if ($row.hasClass('disabled')) {
                return -1;
            }

            $row.prop('disabled', true).addClass('disabled');
            createDetailTable(`${detailUrl}/${$link.data('id')}`, detailsTableElementContainer)
                .then(() => {
                    $row.prop('disabled', false).removeClass('disabled');
                });
        });
    } catch (e) {
        throw e;
    }
}

/**
 * Send an HTTP request to a REST API endpoint.
 * @param url
 */
function getData(url) {
    return new Promise((resolve, reject) => {
        $.ajax({
            "url": url,
            "method": "GET",
            "cache": true,
            "success": function (result) {
                resolve(result);
            },
            "error": function (error) {
                console.log(error)
                resolve([{"error": error.statusText, "error_status": error.status}]);
            }
        });
    });
}

/**
 *
 * @param data
 * @param detailUrl
 * @param tableColumns
 * @param detailsTableElementContainer
 * @returns {string}
 */
function createTable(data, detailUrl, tableColumns, detailsTableElementContainer) {
    try {
        let table = "<table class='table'>";
        tableColumns = ["error", "error_status", ...tableColumns];

        if (data.length > 0) {
            // Create table header
            table += "<thead class='table-header'><tr>";
            for (const property in data[0]) {
                if (tableColumns.includes(property.toLowerCase()))
                    table += `<th>${property}</th>`;
            }

            table += "</tr></thead><tbody>";

            // Create table body
            table += data.map(obj => {
                let row = `<tr class="table-row">`;
                for (const property in obj) {
                    row += tableColumns.includes(property.toLowerCase())
                        ? `<td class="table-data"><a class="header__item" href='#' data-id="${obj.id}">${obj[property]}</a></td>`
                        : ``;
                }
                return row += "</tr>";
            }).join('');
            table += "</tbody>";
        }

        return table += "</table>";
    } catch (e) {
        throw e;
    }
}

/**
 *
 * @param detailUrl
 * @param detailsTableElementContainer
 * @returns {Promise<void>}
 */
async function createDetailTable(detailUrl, detailsTableElementContainer) {
    return new Promise(async (resolve, reject) => {
        try {
            const details = await getData(detailUrl);
            const detailsTableClass = 'myPlugin-inpsyde-details-table';
            let table = `<table class='table ${detailsTableClass}'>`;

            if (details) {
                let res = iterateMultiLevelObjects(details);
                table += `<thead class="table-header"><tr>${res.thead}</tr></thead><tbody><tr class="table-row">${res.tbody}</tr></tbody>`;
            }

            table += "</table>";
            if ($(`.${detailsTableClass}`).length > 0)
                $(detailsTableElementContainer).find(`.${detailsTableClass}`).html(table);
            else $(detailsTableElementContainer).append(table);
            resolve();
        } catch (e) {
            reject(e);
        }
    })
}

/**
 *
 * @param obj
 * @param preName
 * @returns {{tbody: string, thead: string}}
 */
function iterateMultiLevelObjects(obj, preName = '') {
    try {
        let thead = '';
        let tbody = '';
        for (const prop in obj) {
            if (typeof obj[prop] !== 'object') {
                thead += preName ? `<th>${preName}, ${prop}</th>` : `<th>${prop}</th>`;
                tbody += `<td>${obj[prop]}</td>`;
            } else {
                let result = iterateMultiLevelObjects(obj[prop], prop);
                tbody += result.tbody;
                thead += result.thead;
            }
        }

        return {tbody, thead};
    } catch (e) {
        throw e;
    }
}