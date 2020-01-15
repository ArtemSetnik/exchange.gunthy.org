$('.custom-checkbox-button-group').children().each((index, elem) => {
    $(elem).click(function () {
        $(this).toggleClass('active');
    })
})
$('.custom-radio-button-group').children().each((index, elem) => {
    $(elem).click(function () {
        $(this).parent().children().removeClass('active');
        $(this).addClass('active');
    })
})

function float2String(number) {
    if (!_.isNumber(number)) return NaN;
    var str_num = _.toString(number);
    if (str_num.indexOf('e') === -1) return number;
    var nums = str_num.split('e');
    var first_num = nums[0];
    var symbol = nums[1][0];
    var power_num = nums[1].slice(1);

    nums = first_num.split('.');
    var int_num = nums[0];
    var decimal_num = nums[1];

    var result_string;
    if (symbol == '-') {
        var add0len = int_num.length - power_num;
        if (add0len > 0) result_string = int_num.substring(0, add0len) + '.' + int_num.substring(add0len) + (decimal_num || "");
        else result_string = "0." + zeros(-add0len) + int_num + (decimal_num || "");
    } else {
        var add0len = (decimal_num ? decimal_num.length : 0) - power_num;
        if (add0len > 0) result_string = int_num + decimal_num.substring(0, power_num) + '.' + decimal_num.substring(power_num);
        else result_string = int_num + decimal_num + zeros(-add0len);
    }
    console.log(first_num, symbol, power_num, int_num);
    return result_string;
}

function zeros(count) {
    var result = "";
    for (let index = 0; index < count; index++) {
        result += '0'
    }
    return result;
}


function get_api(url, type, data = []) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type,
            dataType: 'json',
            url,
            data,
            success: function(result) {
                resolve(result);
            },
            error: function(a,message,b) {
                console.log(a, message, b);
                reject();
            }
        })
    })
}

var local_timezone_offset = (new Date()).getTimezoneOffset() * 60;

function dateFormat(timestamp) {
    var date = new Date(timestamp*1 + local_timezone_offset );
    var options = {year: 'numeric', month: '2-digit', day: '2-digit',hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: false };
    return date.toLocaleDateString('en-US', options);
}

function renderOrderState(order_state)
{
    switch (order_state) {
        case "19": return "cancelled";
        case "1": return "unfilled";
        case "2": return "particular filled";
        case "9": return "full filled";
        default: return '';
    }
}

function formatOrderSide(side) {
    var className = 'text-success';
    if(_.lowerCase(side) == 'sell') {
        className = 'text-danger';
    }
    return `<span class="${className}">${side}</span>`;
}
