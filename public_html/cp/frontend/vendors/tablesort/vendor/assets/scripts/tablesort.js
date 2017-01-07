'use strict';

var $ = require('jquery');
var _ = require('underscore');

function Sorter(header){
    var inverse = false;
    header.click(function() {
        var table = header.closest('table');
        var thIndex = $(this).index();

        var unsorted = table.find('tbody tr');
        var tbody = table.find('tbody');
        unsorted.detach();
        var sorted = _.sortBy(unsorted, function(e){
            return $(e).find('td:nth-child('+parseInt(thIndex+1)+')').text().toLowerCase();
        })
        if (inverse) {
            sorted = sorted.reverse();
            inverse = false;
        } else {
            inverse = true;
        }
        tbody.append(sorted);
    });
}

$(document).ready(function () {
    var th = $('th.sortable');
    var sorter = new Sorter(th);
});