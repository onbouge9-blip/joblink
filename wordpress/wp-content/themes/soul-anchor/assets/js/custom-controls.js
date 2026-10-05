(function(api) {

    api.sectionConstructor['soul-anchor-buynow'] = api.Section.extend({
        attachEvents: function() {},
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);