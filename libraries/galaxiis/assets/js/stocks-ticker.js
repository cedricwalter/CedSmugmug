jQuery(document).ready(function ($) {
    console.log("Init");
    // $("#txtTicker").autocomplete({
    //     source: function (request, response) {
    //         console.log("Init function");
    //         // faking the presence of the YAHOO library bc the callback will only work with
    //         // "callback=YAHOO.Finance.SymbolSuggest.ssCallback"
    //         var YAHOO = window.YAHOO = {Finance: {SymbolSuggest: {}}};
    //
    //
    //         // YAHOO.Finance.SymbolSuggest.ssCallback = function (data) {
    //             YAHOO.util.ScriptNodeDataSource.callbacks = function (data) {
    //             var mapped = $.map(data.ResultSet.Result, function (e, i) {
    //                 return {
    //                     label: e.symbol + ' (' + e.name + ')',
    //                     value: e.symbol
    //                 };
    //             });
    //             response(mapped);
    //         };
    //         console.log("URL");
    //         var url = [
    //             "http://d.yimg.com/autoc.finance.yahoo.com/autoc?",
    //             // "http://d.yimg.com/aq/autoc?",
    //             "query=" + request.term,
    //             "&callback=YAHOO.Finance.SymbolSuggest.ssCallback"];
    //             // "&callback=YAHOO.util.ScriptNodeDataSource.callbacks"];
    //
    //         console.log(url.join(""));
    //         $.getScript(url.join(""));
    //     },
    //     minLength: 2
    // });

    $("#txtTicker").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: 'http://d.yimg.com/autoc.finance.yahoo.com/autoc?query=' + request.term + '&region=US&lang=en-US',
                cache: true, //<--new
                dataType: 'jsonp',
                jsonpCallback: 'YAHOO.util.ScriptNodeDataSource.callbacks'
            });

            YAHOO = {
                util: {
                    ScriptNodeDataSource: {
                        callbacks: function (data) {
                            console.log(data);
                        }
                    }
                }
            };
        }
    });
    //
    // $("#txtTicker").autocomplete({
    //     source: function (request, response) {
    //         $.ajax({
    //             url: 'http://d.yimg.com/autoc.finance.yahoo.com/autoc?query='+request.term+'&region=US&lang=en-US',
    //             dataType: "jsonp",
    //             jsonpCallback: 'YAHOO.util.ScriptNodeDataSource.callbacks',
    //             cache: true,
    //             success: function (result) {
    //                 console.log('Successfully called');
    //             },
    //             error: function (exception) {
    //                 console.log('Exeption:' + exception);
    //             }
    //         });
    //
    //         YAHOO = {
    //             util: {
    //                 ScriptNodeDataSource: {
    //                     callbacks: function(data) {
    //                         console.log(data);
    //                     }
    //                 }
    //             }
    //         }
    //
    //         // YAHOO.util.ScriptNodeDataSource.callbacks = function (data) {
    //         //     console.log(data);
    //         //     response($.map(data.ResultSet.Result, function (item) {
    //         //         return {
    //         //             label: item.name,
    //         //             value: item.symbol
    //         //         }
    //         //     }));
    //         // }
    //     },
    //     minLength: 2,
    //     // select: function (event, ui) {
    //     //     $("#txtTicker").val(ui.item.name);
    //     // },
    //     // open: function () {
    //     //     $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
    //     // },
    //     // close: function () {
    //     //     $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
    //     // }
    // })

});