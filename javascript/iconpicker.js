jQuery.entwine("select2.iconpicker", function ($) {

    $("select.select2.font-awesome-picker").entwine({
        onmatch: function () {
            var self = this;
            console.log('matched');
            $.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
                self.select2({
                    width:             '512px',
                    matcher:           oldMatcher(function (searchTerm, elementTitle, data) {
                        if (searchTerm.indexOf('fa-') === 0) {
                            if (!data.id) {
                                return false;
                            } else {
                                return data.id.indexOf(searchTerm.substring(3)) === 0;
                            }
                        } else if (data.id && data.text) {
                            return data.text.indexOf(searchTerm) !== -1 || data.id.indexOf(searchTerm) !== -1;
                        } else if (data.text) {
                            return data.text.indexOf(searchTerm) !== -1;
                        } else if (data.id) {
                            return data.id.indexOf(searchTerm) !== -1;
                        } else {
                            return false;
                        }
                    }),
                    templateSelection: function (icon) {
                        if (!icon.id) {
                            return icon.text;
                        }

                        return $('<span><i class="fa fa-' + icon.id + ' fa-fw"></i> ' + icon.text + '</span>');
                    },
                    templateResult:    function (icon) {

                        if (!icon.id) {
                            return icon.text;
                        }

                        return $('<span><i class="fa fa-' + icon.id + ' fa-fw"></i> ' + icon.text + '</span>');
                    }
                });
            });
        },
    });
});