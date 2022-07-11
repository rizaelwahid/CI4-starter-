 // Menu
 $(document).ready(function() {
    var url = window.location;
    var element = $('ul.nav-primary a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    });
    $(element).parentsUntil('ul.nav-primary', 'li').addClass('active');
});

// Checked all radio
$(function() {
    $('.check_all').click(function() {
        $('.check_boxes').prop('checked', this.checked);
    });
});

// Copy a text
function copyToClipboard(elementId) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(elementId).innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}

// ckeditor
// CKEDITOR.replace('content');

// tagsinput
// $('#tagsinput').tagsinput({
//     tagClass: 'badge-primary'
// });

// tab stay on refresh
$(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});

