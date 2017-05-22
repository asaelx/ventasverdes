$(function(){

    var $body = $('body'),
        $window = $(window),
        base_url = window.location.origin;

    // Glide
    var slider = $('.glide');
    if(slider.length){

        var thumbnails = $('.thumbnails').find('.item');

        thumbnails.eq(0).addClass('active');

        slider.glide({
            type: 'carousel',
            autoplay: false,
            afterTransition: activeThumbnail
        });

        var glide_api = slider.data('glide_api');

        thumbnails.click(function(){
            var $this = $(this),
                index = $this.index('.thumbnails .item') + 1;
            glide_api.go('='+index);
        });

        function activeThumbnail(){
            if(thumbnails.length){
                thumbnails.each(function(){
                    $(this).removeClass('active');
                    thumbnails.eq(glide_api.current() - 1).addClass('active');
                });
            }
        }

    }

    // Slider Range
    var price_range = $('#price-range');
    if(price_range.length){
        var min = price_range.data('min'),
            max = price_range.data('max'),
            inputFrom = $('#price-from'),
            inputTo = $('#price-to'),
            instance,
            from = price_range.data('from'),
            to = price_range.data('to');

        function updateInputs (data) {
        	from = data.from;
            to = data.to;

            inputFrom.prop("value", from).trigger('change');
            inputTo.prop("value", to).trigger('change');
        }

        price_range.ionRangeSlider({
            type: 'double',
            prefix: '$',
            min: min,
            max: max,
            from: from,
            to: to,
            onStart: updateInputs,
            onChange: updateInputs
        });

        instance = price_range.data('ionRangeSlider');

        inputFrom.on("input", function () {
            var val = $(this).prop("value");

            // validate
            if (val < min) {
                val = min;
            } else if (val > to) {
                val = to;
            }

            instance.update({
                from: val
            });
        });

        inputTo.on("input", function () {
            var val = $(this).prop("value");

            // validate
            if (val < from) {
                val = from;
            } else if (val > max) {
                val = max;
            }

            instance.update({
                to: val
            });
        });
    }

    // Search
    var filters_form = $('.filters-form');
    if(filters_form.length){
        var search_top = $('.search-form'),
            input_top = search_top.find('[name="search"]'),
            search_hidden = filters_form.find('[name="search"]');

        input_top.on('keyup search', function(){
            var query = $(this).val();
            search_hidden.val(query);
        });

        filters_form.find('input[name="category"]').on('change', function(){
            var $this = $(this);
            if($this.is(':checked')){
                search_top.find('[name="category"]').val($this.val());
            }
        });

        filters_form.find('input[name="price_from"]').on('change', function(){
            search_top.find('[name="price_from"]').val($(this).val());
        });

        filters_form.find('input[name="price_to"]').on('change', function(){
            search_top.find('[name="price_to"]').val($(this).val());
        });

        filters_form.find('input[name="sorting"]').on('change', function(){
            var $this = $(this);
            if($this.is(':checked')){
                search_top.find('[name="sorting"]').val($this.val());
            }
        });

        search_top.find('select[name="category"]').on('change', function(){
            var value = $(this).val();
            filters_form.find('input[name="category"]').each(function(){
                var $this = $(this);
                if($this.val() == value){
                    $this.prop('checked', true);
                }
            });
        });

        var results_section = $('#results'),
            mode = results_section.find('.display').find('.mode'),
            products_list = results_section.find('.products');

        mode.click(function(){
            products_list.removeClass('list');
            products_list.removeClass('grid');
            products_list.addClass($(this).data('type'));
        });

        var toggle_sidebar = $('.toggle-sidebar'),
            sidebar = filters_form.closest('.col-3');

        $.fn.extend({
            toggleText: function (a, b){
                var that = this;
                    if (that.text() != a && that.text() != b){
                        that.text(a);
                    }
                    else
                    if (that.text() == a){
                        that.text(b);
                    }
                    else
                    if (that.text() == b){
                        that.text(a);
                    }
                return this;
            }
        });

        toggle_sidebar.click(function(){
            var $this = $(this);
            sidebar.toggleClass('show', 'hide');
            $this.toggleText('Mostrar filtros', 'Ocultar filtros');
            return false;
        });
    }

    // Dropdown
    var dropdown = $('.dropdown');
    if(dropdown){
        $window.click(function() {
            dropdown.find('.submenu').removeClass('open');
        });
        dropdown.click(function(e) {
            if ($(e.target).hasClass('link'))
                return true;
            $(this).find('.submenu').toggleClass('open');
            return false;
        });
    }

    // Modal
    var modal = $('.modal');
    if(modal.length){
        var layer = $('.layer'),
            trigger = $('.trigger-modal');

        function open_modal(id){
            var modal = $('#'+id);
            layer.fadeIn();
            modal.fadeIn();
        }

        function close_modal(){
            layer.fadeOut();
            modal.fadeOut();
        }

        trigger.click(function(){
            var $this = $(this),
                id = $this.data('modal');
            open_modal(id);
            return false;
        });

        $body.on('click', '.close-modal', function(){
            close_modal();
        });

    }

    // Cart
    var cart = $('#cart');
    if(cart.length){

        $body.on('click', '.delete-item', function(){
            var $this = $(this),
                id = $this.data('id'),
                token = $this.data('token');
            $.ajax({
                url: base_url+'/carrito/'+id,
                type: 'post',
                data: {quantity: id, _method: 'DELETE', _token: token},
                success: function(data){
                    if(data == 'success')
                        location.reload();
                }
            });
            return false;
        });

    }

    // Checkout
    var checkout = $('#checkout');
    if(checkout.length){

        var address_custom = $('#address_custom'),
            address_radio = $('[name="address_option"]')
            shipping_form = $('#shipping_form');
        if(address_custom.length){

            if(address_custom.is(':checked')){
                shipping_form.show();
            }

            address_radio.on('change', function(){
                if($(this).is(':checked') && $(this).val() == 'custom'){
                    shipping_form.slideDown();
                }else{
                    shipping_form.slideUp();
                }
            });
        }

        var billing_custom = $('#billing-custom'),
            billing_radio = $('[name="billing_option"]')
            billing_form = $('#billing_form');
        if(billing_custom.length){
            billing_radio.on('change', function(){
                if($(this).is(':checked') && $(this).val() == 'custom'){
                    billing_form.slideDown();
                }else{
                    billing_form.slideUp();
                }
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

            var submit_btn = $('#submit');

            submit_btn.click(function(){
                var $form = $('#checkout_form');
                $form.submit();
            });
        }

        var billing_country_select = $('#billing-country-select');
        if(billing_country_select.length){

            var billing_state_select = $('#billing-state-select'),
                billing_city_select = $('#billing-city-select');

            billing_country_select.on('change', function(){
                var $this = $(this),
                    value = $this.val(),
                    action = base_url + '/addresses/getStates/' + value;
                $.get(action, function(data){
                    console.log(data);
                });
            });

            billing_state_select.on('change', function(){
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
                    billing_city_select.html(cities);
                });
            });
        }

    } // End Checkout

    // Shipment
    var shipment = $('#shipment');
    if(shipment.length){

        function setTotal() {
            var summary = $('.summary'),
                subtotal_span = summary.find('.subtotal-price'),
                shipment_span = summary.find('.shipment-price'),
                service_span = summary.find('.service-price'),
                total_span = summary.find('.total-price'),
                rate_selects = $('.rate-select'),
                shipment_amount = 0;

            $.each(rate_selects, function(index, el){
                var text = $(el).find('option:selected').text(),
                    match = text.match('\\$[0-9,.]+'),
                    price = match[0].replace('$', '');
                shipment_amount = shipment_amount + parseFloat(price);
            });

            shipment_span.text(shipment_amount);

            var payment_method = $('[name="payment_method"]:checked'),
                conekta_method = payment_method.val(),
                subtotal = subtotal_span.data('subtotal'),
                total,
                fee,
                iva;

            if(conekta_method == 'oxxo_cash'){
                total = subtotal + shipment_amount;
                fee = (total * .035);
                total = total + fee;
                iva = (total * .16);
                service = fee + iva;
                total = total + iva;
            }

            if(conekta_method == 'spei'){
                total = subtotal + shipment_amount;
                fee = (total * .01) + 1;
                total = total + fee;
                iva = (total * .16);
                service = fee + iva;
                total = total + iva;
            }

            if(conekta_method == 'card'){
                total = subtotal + shipment_amount;
                fee = (total * .029) + 2.5;
                total = total + fee;
                iva = (total * .16);
                service = fee + iva;
                total = total + iva;
            }

            service_span.text(service.toFixed(2));
            total_span.text(total.toFixed(2));
        }

        setTotal();

        var rate_selects = $('.rate-select'),
            payment_method = $('[name="payment_method"]');

        var rate_id = rate_selects.val();

        rate_selects.on('change', function(){
            setTotal();
        });

        payment_method.on('change', function(){
            setTotal();
        });

        var card_radio = $('#card'),
            payment_radio = $('[name="payment_method"]'),
            card_details = $('#card-details');
        if(card_radio.length){

            if(card_radio.is(':checked')){
                card_details.show();
            }

            payment_radio.on('change', function(){
                if($(this).is(':checked') && $(this).val() == 'card'){
                    card_details.slideDown();
                }else{
                    card_details.slideUp();
                }
            });
        }

        var submit_btn = $('#submit');

        submit_btn.click(function(){
            var $form = $('.pay_form'),
                payment_method = $form.find('.checkbox_payment:checked').val();

            if(payment_method == 'card'){
                Conekta.setPublishableKey('key_CRJsKzb8KKqRzRMnS1tSvFQ');

                var conektaSuccessResponseHandler = function(token) {
                    var $form = $(".pay_form");
                    //Add the token_id in the form
                    $form.append($("<input type='hidden' id='conektaTokenId'>").val(token.id));
                    $form.get(0).submit(); //Submit
                };

                var conektaErrorResponseHandler = function(response) {
                    var $form = $(".pay_form");
                    $form.find(".card-errors").text(response.message);
                    $("#submit").prop("disabled", false);
                };

                $(".pay_form").submit(function(event) {
                    var $form = $(this);
                    // Prevents double clic
                    $("#submit").prop("disabled", true);
                    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                    return false;
                });
            }
            $form.submit();
        });

    } // End Shipment

});
