(function($) {
    $.templateEngine = {
        current_template: '',
        templates: {},
        init: function(template_name) {
            if (typeof(this.templates[template_name]) !== 'undefined' ) {
                this.current_template = this.templates[template_name];
                return this;
            }
            console.log('Error: No template group');
            return false;
        },
        addTemplate: function(template_key, template_element) {
            this.templates[template_key] = template_element;
        },
        getTemplate: function(template_name) {
            if(typeof(this.current_template[template_name]) != 'undefined') {
                return this.current_template[template_name];
            }
            console.log('Error: No template');
            return false;
        },
        applyTemplate: function(template_name, params) {
            var template = this.getTemplate(template_name);
            if (typeof(params) != 'undefined' ) {
                $.each(params, function(item_key, item){
                    template = template.replace('{!' + item_key +  "!}", item);
                });
            }
            return template;
        }
    }
})(jQuery);