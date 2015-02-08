function highlightTableRows(tableId, hoverClass) {
    var table = document.getElementById(tableId);

    if (table) {
        if (hoverClass) {
            var hoverClassReg = new RegExp("\\b" + hoverClass + "\\b");

            table.onmouseover = table.onmouseout = function (e) {
                if (!e) e = window.event;
                var elem = e.target || e.srcElement;
                while (!elem.tagName || !elem.tagName.match(/td|table/i)) elem = elem.parentNode;

                if (elem.parentNode.tagName == 'TR' && elem.parentNode.parentNode.tagName == 'TBODY') {
                    var row = elem.parentNode;
                    if (!row.getAttribute('clickedRow')) row.className = e.type == "mouseover" ? row.className + " " + hoverClass : row.className.replace(hoverClassReg, " ");
                }
            };
        }
    }
}