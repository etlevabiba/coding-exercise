/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var $ = require("jquery");

// Search jobs
$(document).ready(function(){
	$('#search-title').keyup(function(){
		console.log('asdfasdf');
	    var str = $('#searchTitle').val();
	    var listItems = $('#job-results tbody').children('tr');
	    var searchSplit = str.replace(/ /g, "'):containsi('")
	    $.extend($.expr[':'],{
	        'containsi': function (elem, match){
	            return(elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase())>=0;
	        }
	    })
	    $("#job-results tbody tr").not(":containsi('"+ searchSplit +"')").each(function(){
	        $(this).attr('visible', 'false');
	    })
	    $("#job-results tbody tr:containsi('"+ searchSplit +"')").each(function(){
	        $(this).attr('visible', 'true');
	    })
	    var jobCount = $('#job-results tbody tr[visible:"true"]').length;
	    $('.counter').text(jobCount +' item');
	    if(jobCount == 0){
	        $('no-result').show();
	    }else{
	        $('no-result').hide();
	    }
	})
});
