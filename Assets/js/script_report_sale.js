function openPopUp(obj) {

    var data = $(obj).serialize();
    var url = BASE_URL + 'Report/sales_pdf?' + data;
    window.open(url, "Report", "width=600,height=600");


    return false;
}


