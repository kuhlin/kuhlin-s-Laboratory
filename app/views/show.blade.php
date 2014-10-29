<?php
/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 29-oct-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
?>



<h1>Dropdown demo</h1>
{{ Form::open() }}
<select id="carbrands" name="carbrands">
    <option>Select Car Make</option>
    <option value="1">Toyota</option>
    <option value="2">Honda</option>
    <option value="3">Mercedes</option>
</select>
<br>
<select id="carmodels" name="carmodels">
    <option>Please choose car make first</option>
</select>
{{ Form::close();}}

<script>
    jQuery(document).ready(function ($) {
        $('#carbrands').change(function () {
            $.get("{{ url('api/dropdown')}}",
                    {option: $(this).val()},
            function (data) {
                var model = $('#carmodel');
                model.empty();

                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
        });
    });
</script>
