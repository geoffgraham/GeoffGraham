// Create a new tinyMCE Button
/*global tinymce: true*/
(function () {
    "use strict";
    tinymce.create('tinymce.plugins.CodePenPlugin', {
        init: function (ed, url) {
            ed.addCommand('mcebutton', function () {
                ed.windowManager.open({
                    file: url + '/codepen-popup-form.php',
                    width: 400 + parseInt(ed.getLang('codepen.delta_width', 0), 10),
                    height: 400 + parseInt(ed.getLang('codepen.delta_height', 0), 10),
                    inline: 1
                });
            });
            ed.addButton('codepen_embed', {
                title: 'Insert CodePen Embed',
                cmd: 'mcebutton',
                image: url + '/images/codepen.png',
                'class': 'codepen_btn'
            });
        },
        getInfo: function () {
            return {
                longname: 'CodePen Embed',
                author: 'Jason Witt',
                authorurl: 'http://jawittdesigns.com',
                infourl: 'http://jawittdesigns.com',
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('codepen_embed', tinymce.plugins.CodePenPlugin);
})();