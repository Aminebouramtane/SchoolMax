@if (App::getLocale()=='en')
<script>
    $(document).ready(function () {
        $('select[name="new_grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "/new_classes/" + grade_id,  // Update the URL path or route for the endpoint
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_classe_id"]').empty();
                        $('select[name="new_classe_id"]').append('<option selected disabled>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="new_classe_id"]').on('change', function () {
            var classe_id = $(this).val();
            if (classe_id) {
                $.ajax({
                    url: "/new_sections/" + classe_id,  // Update the URL path or route for the endpoint
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_section_id"]').empty();
                        $('select[name="new_section_id"]').append('<option selected disabled>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@else

<script>
    $(document).ready(function () {
        $('select[name="new_grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "/new_classes_ar/" + grade_id,  // Update the URL path or route for the endpoint
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_classe_id"]').empty();
                        $('select[name="new_classe_id"]').append('<option selected disabled>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="new_classe_id"]').on('change', function () {
            var classe_id = $(this).val();
            if (classe_id) {
                $.ajax({
                    url: "/new_sections_ar/" + classe_id,  // Update the URL path or route for the endpoint
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_section_id"]').empty();
                        $('select[name="new_section_id"]').append('<option selected disabled>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endif
