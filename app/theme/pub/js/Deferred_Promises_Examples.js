/**
 * Created by jrey on 25/01/2017.
 */
// http://joseoncode.com/2011/09/26/a-walkthrough-jquery-deferred-and-promise/

/*
function getCustomer(customerId){
    var d = $.Deferred();
    $.post(
        "/echo/json/",
        {json: JSON.stringify({firstName: "Jose", lastName: "Romaniello", ssn: "123456789"}),
            delay: 4}
    ).done(function(p){
        d.resolve(p);
    }).fail(d.reject);
    return d.promise();
}

function getPersonAddressBySSN(ssn){
    return $.post("/echo/json/", {
        json: JSON.stringify({
            ssn: "123456789",
            address: "Siempre Viva 12345, Springfield" }),
        delay: 2
    }).pipe(function(p){
        return p.address;
    });
}


function load(){
    $.blockUI({message: "Loading..."});
    var loadingCustomer = getCustomer(123)
        .done(function(c){
            $("span#firstName").html(c.firstName);
        });

    var loadingAddress = getPersonAddressBySSN("123456789")
        .done(function(address){
            $("span#address").html(address);
        });

    $.when(loadingCustomer, loadingAddress)
        .done($.unblockUI);
}

load();
*/
