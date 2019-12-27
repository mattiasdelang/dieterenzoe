$(window).on("load", function () {
    var parent = $(".extraPersonen");
    var rij =
        '<div class="form-row extraRij">' +
        '<label for="">Extra naam (aantalExtra)*</label>' +
        '<input type="text" name="rsvp[personen][aantalExtra][naam]" id="rsvp_personen_aantalExtra_naam" class="input" autocomplete="new" required>' +
        '<label for="">Verzoeknummers</label>' +
        '<input type="text" name="rsvp[personen][aantalExtra][nummers][0][nummer]" class="input" autocomplete="off">' +
        '<input type="text" name="rsvp[personen][aantalExtra][nummers][1][nummer]" class="input" autocomplete="off">' +
        '<div class="bijsluiter">Welke 2 nummers wil je zeker horen op het feest?</div>' +
        '</div>';

    $(".aantalPersonen").on("input", function () {
        var aantalPersonen = $(this).val();
        var element = rij;
        var extra = '';

        parent.find(".form-row:not(.vast)").remove();
        element = element.split('teller').join(aantalPersonen);

        for (var i = 1; i < aantalPersonen; i++) {
            extra += element.split('aantalExtra').join(i);
        }
        parent.append(extra);
    });
});