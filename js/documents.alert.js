var bar = document.getElementById('documents_div');
bar.setAttribute("align", "right");

// JS doesnt get CSS values by default!!!
var foo = bar.getAttribute("width");
console.log(foo); // returns null

alert("Attenzione! Lo Stock ID dev\'essere composto da 2 lettere iniziali seguite da 5 numeri.");
