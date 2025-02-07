$(document).ready(function() {
    let currentFormulations = [];
    
    $('#medicationSearch').on('input', function() {
        const query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: { query: query },
                success: function(response) {
                    $('#searchResults').html(response);
                }
            });
        }
    });

    $('#searchResults').on('click', '.list-group-item', function() {
        const brandId = $(this).data('brandid');
        $('#medicationSearch').val($(this).text());
        $('#searchResults').empty();
        
        $.ajax({
            url: 'get_formulations.php',
            method: 'POST',
            data: { brand_id: brandId },
            success: function(response) {
                currentFormulations = JSON.parse(response);
                populateForms(currentFormulations);
            }
        });
    });

    function populateForms(formulations) {
        const forms = [...new Set(formulations.map(f => f.form))];
        $('#formSelect').empty().append('<option value="">Select form</option>');
        forms.forEach(form => {
            $('#formSelect').append(`<option value="${form}">${form}</option>`);
        });
        $('#formSelect').prop('disabled', false);
    }

    $('#formSelect').change(function() {
        const form = $(this).val();
        const strengths = currentFormulations.filter(f => f.form === form);
        $('#strengthSelect').empty().append('<option value="">Select strength</option>');
        strengths.forEach(strength => {
            $('#strengthSelect').append(`<option value="${strength.id}" data-mg="${strength.strength_mg}" data-ml="${strength.strength_ml}">${strength.strength}</option>`);
        });
        $('#strengthSelect').prop('disabled', false);
    });

    $('#strengthSelect, #weight').on('change input', calculateDose);

    function calculateDose() {
        const formulationId = $('#strengthSelect').val();
        const weight = parseFloat($('#weight').val());
        const formulation = currentFormulations.find(f => f.id == formulationId);
        
        if (!formulation || !weight) return;

        const doseMg = weight * formulation.dosage_per_kg;
        let result = `<h5>Recommended Dose:</h5><p>${doseMg.toFixed(1)} mg</p>`;

        switch(formulation.form) {
            case 'syrup':
                const mgPerMl = formulation.strength_mg / formulation.strength_ml;
                const ml = doseMg / mgPerMl;
                const tsp = ml / 5;
                result += `<p>${ml.toFixed(1)} ml (${tsp.toFixed(1)} teaspoon${tsp !== 1 ? 's' : ''})</p>`;
                break;
            case 'drops':
                const dropsMl = doseMg / (formulation.strength_mg / formulation.strength_ml);
                const drops = dropsMl * formulation.drops_per_ml;
                result += `<p>${drops.toFixed(0)} drops</p>`;
                break;
            case 'tablet':
                const tablets = doseMg / formulation.strength_mg;
                result += `<p>${tablets.toFixed(1)} tablet${tablets !== 1 ? 's' : ''}</p>`;
                break;
        }

        $('#calculationResult').html(result);
    }
});
