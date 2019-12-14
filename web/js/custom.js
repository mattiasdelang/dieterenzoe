$(window).on("load", function () {
    var parent = $(".extraPersonen");
    var rij =
        '<div class="form-row extraRij">' +
        '<label for="">Extra naam (aantalExtra)*</label>' +
        '<input type="text" name="deelnemer[aantalExtra][naam][]" class="input" autocomplete="new" required>' +
        '<label for="">Verzoeknummers</label>' +
        '<input type="text" name="deelnemer[aantalExtra][verzoeknummer][]" class="input" autocomplete="off">' +
        '<input type="text" name="deelnemer[aantalExtra][verzoeknummer][]" class="input" autocomplete="off">' +
        '<div class="bijsluiter">Welke 2 nummers wil je zeker horen op het feest?</div>' +
        '</div>';

    $("#aantal").on("input", function () {
        var aantalPersonen = $(this).val();
        var element = rij;
        var extra = '';

        parent.find(".form-row:not(.vast)").remove();
        element = element.split('teller').join(aantalPersonen);

        for (var i = 1; i < aantalPersonen; i++) {
            console.log(i);
            extra += element.split('aantalExtra').join(i);
        }
        parent.append(extra);
    });
});