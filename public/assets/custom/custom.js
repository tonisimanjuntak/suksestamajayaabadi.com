var $loading = $(".loader").hide();

$(".select2").select2();

$(document)
    .ajaxStart(function () {
        $loading.show();
    })
    .ajaxStop(function () {
        $loading.hide();
    });

$(".tanggal").mask("00-00-0000", {
    placeholder: "dd-mm-yyyy",
});
$(".rupiah").mask("000,000,000,000", {
    reverse: true,
    placeholder: "000,000,000,000",
});
$(".rupiah").addClass("text-right");
$(".stokbarang").mask("000,000", {
    reverse: true,
    placeholder: "000,000",
});
$(".stokbarang").addClass("text-right");

const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const totitik = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const untitik = (i) => {
    return typeof i === "string"
        ? i.replace(/[\$,]/g, "") * 1
        : typeof i === "number"
        ? i
        : 0;
};

function format_decimal(number, decPlaces, decSep, thouSep) {
    (decPlaces = isNaN((decPlaces = Math.abs(decPlaces))) ? 2 : decPlaces),
        (decSep = typeof decSep === "undefined" ? "." : decSep);
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(
        parseInt((number = Math.abs(Number(number) || 0).toFixed(decPlaces)))
    );
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return (
        sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces
            ? decSep +
              Math.abs(number - i)
                  .toFixed(decPlaces)
                  .slice(2)
            : "")
    );
}

function stringToDate(str) {
    var date = str.split("-"),
        d = date[0],
        m = date[1],
        y = date[2],
        temp = [];
    temp.push(y, m, d);
    // return (temp.join("-"));
    return new Date(temp.join("-"));
}

function createTimeStamp(dates) {
    var datesSpliet = dates.split("-");
    var newDate = datesSpliet[1] + "/" + datesSpliet[2] + "/" + datesSpliet[0];
    var tStamp = new Date(newDate).getTime();
    var tStampStr = tStamp.toString();
    return tStampStr.substring(0, 10);
}

function timestampToDate(nTimestamp) {
    var date = new Date(nTimestamp * 1000);
    var hours = date.getHours();
    var minutes = "0" + date.getMinutes();
    var seconds = "0" + date.getSeconds();
    var formattedTime =
        hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
    // console.log(date);
    return date;
}

function setCookie(cname, cvalue, lexpire = 0) {
    var date = new Date();
    // var exdays = date.setDate(date.getDate() + 1); //1day
    var exdays = 1; // 1 hour
    const d = new Date();
    if (lexpire == 1) {
        d.setTime(d.getTime() + 876000 * 60 * 60 * 1000); //expired 100 tahun
    } else {
        d.setTime(d.getTime() + exdays * 60 * 60 * 1000);
    }
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires;
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function formatDate(date) {
    date = new Date(date);
    return [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
    ].join("-");
}

function formatDateTime(date) {
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
        ].join("-") +
        " " +
        [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
        ].join(":")
    );
}

function formatDateTimeIndonesia(date) {
    if (date != "" && date != null) {
        date = new Date(date);
        return (
            [
                padTo2Digits(date.getDate()),
                padTo2Digits(date.getMonth() + 1),
                date.getFullYear(),
            ].join("-") +
            " " +
            [
                padTo2Digits(date.getHours()),
                padTo2Digits(date.getMinutes()),
                // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
            ].join(":")
        );
    } else {
        return "";
    }
}

function padTo2Digits(num) {
    return num.toString().padStart(2, "0");
}

function addSelectOption(selectId, optValue, optText) {
    var select = document.getElementById(selectId);
    var option = document.createElement("option");
    option.value = optValue;
    option.innerHTML = optText;
    select.appendChild(option);
}

function tglHariIni() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + month + "-" + day;
    return today;
}

function tgldmy(date) {
    date = new Date(date);
    return [
        padTo2Digits(date.getDate()),
        padTo2Digits(date.getMonth() + 1),
        date.getFullYear(),
    ].join("-");
}

function tglymd(date) {
    date = new Date(date);
    return [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
    ].join("-");
}
