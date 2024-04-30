<!doctype html>
<html lang="en">

<head>
    <title>Multiselect 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/multi-choice.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-5">
                    <h2 class="heading-section">Multiselect #05</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 d-flex justify-content-center align-items-center">
                    <select class="js-select2" multiple="multiple">
                        <option value="O1" data-badge="">Option1</option>
                        <option value="O2" data-badge="">Option2</option>
                        <option value="O3" data-badge="">Option3</option>
                        <option value="O4" data-badge="">Option4</option>
                        <option value="O5" data-badge="">Option5</option>
                        <option value="O6" data-badge="">Option6</option>
                        <option value="O7" data-badge="">Option7</option>
                        <option value="O8" data-badge="">Option8</option>
                        <option value="O9" data-badge="">Option9</option>
                        <option value="O10" data-badge="">Option10</option>
                        <option value="O11" data-badge="">Option11</option>
                        <option value="O12" data-badge="">Option12</option>
                        <option value="O13" data-badge="">Option13</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script>
        (function($) {

            "use strict";


            $(".js-select2").select2({
                closeOnSelect: false,
                placeholder: "Click to select an option",
                allowHtml: true,
                allowClear: true,
                tags: true // создает новые опции на лету
            });

            $('.icons_select2').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true,
                placeholder: "Click to select an option",
                dropdownParent: $('.select-icon'), //обавили класс
                allowClear: true,
                multiple: false
            });


            function iformat(icon, badge, ) {
                var originalOption = icon.element;
                var originalOptionBadge = $(originalOption).data('badge');

                return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text +
                    '<span class="badge">' + originalOptionBadge + '</span></span>');
            }

        })(jQuery);
    </script>

</body>

</html>
