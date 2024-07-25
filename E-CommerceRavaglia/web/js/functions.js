function showBook(year, price, quantity, author, editor, nPages) {
    var box = document.getElementById("DetailsBox");

    var str = "<b>Year:</b> " + year + "<br><b>price:</b> " + price + "$<br><b>Quantity:</b> " + quantity +
        "<br><b>Author:</b> " + author + "<br><b>Editor:</b> " + editor + "<br><b>Pages:</b> " + nPages;

    box.innerHTML = str;
    box.style.textAlign = "left";
    box.style.paddingLeft = "20px";
    box.style.paddingBottom = "20px";
}

function showCd(year, price, quantity, author, executor, duration) {
    var box = document.getElementById("DetailsBox");

    var str = "<b>Year:</b> " + year + "<br><b>price:</b> " + price + "$<br><b>Quantity:</b> " + quantity +
        "<br><b>Author:</b> " + author + "<br><b>Executor:</b> " + executor + "<br><b>Duration:</b> " + duration + " minutes";

    box.innerHTML = str;
    box.style.textAlign = "left";
    box.style.paddingLeft = "20px";
    box.style.paddingBottom = "20px";

}

function showDvd(year, price, quantity, director, productor, duration) {
    var box = document.getElementById("DetailsBox");

    var str = "<b>Year:</b> " + year + "<br><b>price:</b> " + price + "$<br><b>Quantity:</b> " + quantity +
        "<br><b>Director:</b> " + director + "<br><b>Productor:</b> " + productor + "<br><b>Duration:</b> " + duration + " minutes";

    box.innerHTML = str;
    box.style.textAlign = "left";
    box.style.paddingLeft = "20px";
    box.style.paddingBottom = "20px";
}

function goToCart() {
    window.location.href = "?action=cart";
}

function goToMarketPlace() {
    window.location.href = "?action=marketplace";
}