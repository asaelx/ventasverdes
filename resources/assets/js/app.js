$(function(){

    var $body = $('body');
    var base_url = window.location.origin;

    // Autosize
    var autosizable = $('.autosizable');
    if(autosizable.length){
        autosize(autosizable);
    }

    // WYSIWYG
    var wysiwyg = $('.wysiwyg');
    if(wysiwyg.length){
        wysiwyg.trumbowyg({
            svgPath: base_url + '/css/icons.svg',
            btns: [
                ['formatting'],
                'btnGrp-semantic',
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                'btnGrp-justify',
                'btnGrp-lists',
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ],
            removeformatPasted: true,
            autogrow: true
        });
    }

    // Select2
    var selectable = $('.select2');

    if(selectable.length){

        selectable.select2({
            width: '100%',
            language: 'es',
            selectOnClose: true
        });

        function replace_remove(){
            var tags = $('.select2-selection__choice__remove');
            tags.each(function(){
                var $this = $(this);
                if(!$this.hasClass('btn-clear')){
                    $this.addClass('btn btn-clear').text('');
                }
            });
        }

        selectable.on('select2:select', function(){ replace_remove(); });

        selectable.on('select2:unselect', function(){ replace_remove(); });

    }

    // Modal
    var modal = $('.modal');
    if(modal.length){

        function open_modal(modal_id, action, content){
            var modal = $('#'+modal_id),
                form = modal.find('form');

            form.attr('action', action);

            if(content){
                modal.find('.text').html('<b>'+content+'</b>');
            }
            modal.addClass('active');
        }

        function close_modal(){
            modal.removeClass('active');
        }

        $body.on('click', '.trigger-modal', function(){
            var $this = $(this),
                modal_id = $this.data('modal'),
                action = $this.data('action'),
                content = $this.data('text');
            open_modal(modal_id, action, content);
            return false;
        });

        $body.on('click', '.close-modal, .modal-overlay', function(){
            close_modal();
            return false;
        });
    }

    // Datatables
    var table = $('.datatable');
    if(table.length){

        var spanish = {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "NingÃºn dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ãšltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
            },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        };

        function add_css_classes(){
            var sorting_asc = $('.sorting_asc');
            if(sorting_asc.length && !sorting_asc.find('.typcn-arrow-sorted-up').length)
                sorting_asc.prepend($('<i>', { class: 'typcn typcn-arrow-sorted-up' }));
            if(sorting_asc.length && sorting_asc.find('.typcn-arrow-sorted-down').length)
                sorting_asc.find('.typcn-arrow-sorted-down').remove();

            var sorting_desc = $('.sorting_desc');
            if(sorting_desc.length && !sorting_desc.find('.typcn-arrow-sorted-down').length)
                sorting_desc.prepend($('<i>', { class: 'typcn typcn-arrow-sorted-down' }));
            if(sorting_desc.length && sorting_desc.find('.typcn-arrow-sorted-up').length)
                sorting_desc.find('.typcn-arrow-sorted-up').remove();

            $('.sorting').find('.typcn').remove();
            $('.dataTables_filter').find('[type="search"]').addClass('form-input inline');
            $('.dataTables_length').find('select').addClass('form-select');
            $('.dataTables_paginate').find('.paginate_button').addClass('btn btn-primary');
        }

        var datatable = table.dataTable({
            language: spanish,
            pagingType: 'simple'
        });

        add_css_classes();

        datatable.on('draw.dt', function(){
            add_css_classes();
        });

    }

    // Auth
    var show_seller_fields = $('#show-seller-fields');
    if(show_seller_fields.length){
        var seller_fields = $('.seller-fields');
        show_seller_fields.on('change', function(){
            if($(this).is(':checked')){
                seller_fields.removeClass('hide')
                    .find('.required').prop('required', true);
            }else{
                seller_fields.addClass('hide')
                    .find('.required').prop('required', false);;
            }
        });
    }

    // Menus Links
    var link_type = $('.link-type');
    if(link_type.length){

        function set_links_names(){
            var table = $('.links'),
                links = table.find('.link');

            links.each(function(index, el){
                var $this = $(el),
                    title = $this.find('.title').find('input'),
                    page = $this.find('.page').find('select'),
                    url = $this.find('.url').find('input');

                title.attr('name', 'links['+ index +'][title]');
                page.attr('name', 'links['+ index +'][page]');
                url.attr('name', 'links['+ index +'][url]');
            });
        }

        $body.on('change', '.link-type', function(){
            var $this = $(this),
                value = $this.val(),
                page = $this.closest('.link').find('.page'),
                url = $this.closest('.link').find('.url');
            if(value == 'page'){
                page.removeClass('hide').find('select').prop('disabled', false);
                url.addClass('hide').find('input').prop('disabled', true);
            }
            if(value == 'url'){
                url.removeClass('hide').find('input').prop('disabled', false);
                page.addClass('hide').find('select').prop('disabled', true);
            }
        });

        $body.on('click', '.add-link', function(){
            var $this = $(this),
                table = $this.prev('table'),
                link = table.find('.link').first(),
                cloned = link.clone();

            cloned.find('input:text').val('');
            cloned.find('.page').removeClass('hide').find('select').prop('disabled', false);
            cloned.find('.url').addClass('hide').find('input').prop('disabled', true);
            cloned.find('.options').html($('<button>', {
                class: 'btn btn-danger delete-link',
                text: 'Eliminar'
            }));
            table.find('tbody').append(cloned);

            set_links_names();

            return false;
        });

        $body.on('click', '.delete-link', function(){
            var $this = $(this),
                link = $this.closest('.link');
            link.fadeOut('slow', function() {
                $(this).remove();
            });

            set_links_names();

            return false;
        });
    }

    // Addresses
    var country_select = $('#country-select');
    if(country_select.length){

        var state_select = $('#state-select'),
            city_select = $('#city-select');

        country_select.on('change', function(){
            var $this = $(this),
                value = $this.val(),
                action = base_url + '/addresses/getStates/' + value;
            $.get(action, function(data){
                console.log(data);
            });
        });

        state_select.on('change', function(){
            var $this = $(this),
                value = $this.val(),
                action = base_url + '/addresses/getCities/' + value;
            $.get(action, function(data){
                var cities = [];
                for (var i = 0; i < Object.keys(data).length; i++) {
                    var city = data[Object.keys(data)[i]],
                        option = $('<option>', {
                            value: city,
                            text: city
                        });
                    cities.push(option);
                }
                city_select.html(cities);
            });
        });
    }

    // Add Variations
    var variations_switch = $('#has_variations');
    if(variations_switch.length){
        var variations_panel = $('.variations_panel'),
            price_panel = $('.price_panel'),
            inventory_panel = $('.inventory_panel');

        variations_switch.on('change', function(){

            if(variations_switch.is(':checked')){

                variations_panel.removeClass('hide');
                variations_panel.find('input:text').prop('disabled', false);
                variations_panel.find('input:hidden').prop('disabled', false);
                variations_panel.find('input:checkbox').prop('disabled', false);

                price_panel.addClass('hide');
                price_panel.find('input:text').prop('disabled', true);

                inventory_panel.addClass('hide');
                inventory_panel.find('input:text').prop('disabled', true);

            }else{

                variations_panel.addClass('hide');
                variations_panel.find('input:text').prop('disabled', true);
                variations_panel.find('input:hidden').prop('disabled', true);
                variations_panel.find('input:checkbox').prop('disabled', true);
                //
                price_panel.removeClass('hide');
                price_panel.find('input:text').prop('disabled', false);
                //
                inventory_panel.removeClass('hide');
                inventory_panel.find('input:text').prop('disabled', false);

            }

        });

        var add_variation_button = variations_panel.find('.add-variation'),
            add_option_button = variations_panel.find('.add-option'),
            options = $('.options');

        add_variation_button.click(function(){
            options.removeClass('hide');
            add_option_button.removeClass('hide');
            return false;
        });

        add_option_button.click(function(){
            var cloned = options.find('.option').eq(0).clone()
                                .find('input:text').val('').end()
                                .find('.chip').remove().end()
                                .find('.values-hidden').remove().end();

            cloned.find('td:last-child').append($('<button>', {
                class: 'btn btn-link remove-option',
                html: '<i class="typcn typcn-delete"></i>'
            }));

            options.find('.table').find('tbody').append(cloned);

            options.find('.option').each(function(i, e){
                var $e = $(e),
                    input = $e.find('input[name*="[title]"]'),
                    name = input.attr('name'),
                    count_name = name.replace('[0]', '['+ i +']');
                input.attr('name', count_name);
            });

            return false;
        });

        function generate_variations(){

            var arrayOfArrays = [],
                variations = $('.variations');

            $('.option').each(function(i, e){
                var $e = $(e),
                    values_hidden = $e.find('.values-hidden'),
                    array = [];

                if(values_hidden.length){
                    var name = values_hidden.eq(0).attr('name'),
                        count_name = name.replace('[0]', '['+ i +']');

                    values_hidden.attr('name', count_name);

                    values_hidden.each(function(){
                        array.push($(this).val());
                    });

                    arrayOfArrays.push(array);
                }

            });

            var combinations = [],
                comboKeys = [],
                arrayOfArraysLength = arrayOfArrays.length,
                numOfCombos = arrayOfArraysLength ? 1 : 0;

            for (var i = 0; i < arrayOfArraysLength; i++) {
                numOfCombos = numOfCombos * arrayOfArrays[i].length;
            }

            for (var j = 0; j < numOfCombos; j++) {
                var carry = j,
                    comboKeys = [],
                    combo = [];

                for (var k = 0; k < arrayOfArraysLength; k++) {
                    comboKeys[k] = carry % arrayOfArrays[k].length;
                    carry = Math.floor(carry / arrayOfArrays[k].length);
                }
                for (var k = 0; k < comboKeys.length; k++) {
                    combo.push(arrayOfArrays[k][comboKeys[k]]);
                }
                combinations.push(combo);
            }

            var cloned_variation = variations.find('.variation').eq(0).clone();

            if(variations.hasClass('hide'))
                variations.removeClass('hide').find('.variation').eq(0).remove();

            if(combinations.length == 0){

                variations.addClass('hide');

            }else{

                variations.find('tbody').empty();

                for (var i = 0; i < combinations.length; i++) {

                    var combination_text = '';

                    for (var j = 0; j < combinations[i].length; j++) {
                        combination_text += combinations[i][j] + ' · ';
                    }

                    combination_text = combination_text.replace(/\ \·\ $/, '');

                    var final_cloned = cloned_variation.clone();

                    final_cloned.find('.combination').text(combination_text).end()
                                .find('input:text').val('').end()
                                .find('input[name*="[title]"]').val(combination_text);

                    variations.find('tbody').append(final_cloned);

                }

                variations.find('.variation').each(function(i, e){

                    var $e = $(e),
                        inputs = $e.find('input[name^="variations_list"]'),
                        count = i;

                    inputs.each(function(i, e){

                        var $e = $(e),
                            name = $e.attr('name'),
                            count_name = name.replace('[0]', '['+ count +']');

                        $e.attr('name', count_name);

                    });

                });

            }
        }

        $body.on('click', '.remove-option', function(){

            $(this).closest('.option').remove();

            generate_variations();

            return false;

        });

        $body.on('keyup', '.option-values', function(e){
            if(e.keyCode == 188 || e.keyCode == 13){
                var $this = $(this),
                    cloned = $this.clone(),
                    form_input = $this.closest('.form-autocomplete-input'),
                    value = $this.val().replace(',', ''),
                    hidden = $('<input>', {
                        type: 'hidden',
                        name: 'options[0][values][]',
                        class: 'values-hidden',
                        value: value
                    }),
                    chip = $('<label>', {
                        class: 'chip',
                        html: value + '<button class="btn btn-clear remove-chip"></button>'
                    });

                $this.remove();
                cloned.val('');
                form_input.append(chip).append(cloned);
                cloned.focus();

                form_input.append(hidden);

                generate_variations();

                return false;
            }
        });

        $body.on('click', '.remove-chip', function(){

            var $this = $(this),
                chip = $this.closest('.chip'),
                value = chip.text().trim(),
                hidden = chip.closest('.form-autocomplete-input').find('.values-hidden[value="'+value+'"]');

            chip.remove();
            hidden.remove();

            generate_variations();

            return false;

        });

        // File input preview images
        var file_input_preview = $('.file-input-preview');
        if(file_input_preview.length){

            function imagesPreview(input, placeholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    placeholder.find('.previewed').remove();

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var column = $('<div>', {
                                    class: 'column col-6 col-lg-3 col-md-4 col-sm-12 previewed',
                                    html: $('<img>', {class: 'img-responsive rounded'}).attr('src', event.target.result)
                                });
                            column.appendTo(placeholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            }

            file_input_preview.change(function(){
                var placeholder = $(this).closest('.form-group').find('.preview');
                imagesPreview(this, placeholder);
            });

            $body.on('click', '.preview .typcn-delete', function(){
                var $this = $(this),
                    column = $this.closest('.column');

                column.remove();
            });
        }
    } // End Add Variations
});
