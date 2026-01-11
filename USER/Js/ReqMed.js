$(document).ready(function() {
    $('#search').on('input', function() {
        var query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: 'searchBarLogic.php',
                method: 'POST',
                data: {
                    search: query
                },
                success: function(data) {
                    $('#search-results').html(data).show();
                }
            });
        } else {
            $('#search-results').hide();
        }
    });
});
