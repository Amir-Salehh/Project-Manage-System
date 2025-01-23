$(document).ready(function () {
    $("#projectDeadline").persianDatepicker({
        format: 'YYYY/MM/DD',  // فرمت شمسی
        altFormat: 'YYYY-MM-DD',  // فرمت جایگزین (میلادی)
        calendar: {
            persian: {
                locale: 'en',   // نمایش اعداد انگلیسی
            },
        },
    });
});
