$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if (link == location2) {
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        var res = confirm('Подтвердите действия');
        if (!res) {
            return false;
        }
    });

    /*  setTimeout(function () {
          var $preloader = $('.preloader');


         /*  if ($preloader) {
              $preloader.css('height', 0);
              setTimeout(function () {
                  alert();
                  $preloader.children().hide();
              }, 200);
          }
      }, 200);*/

    $("#all_dell").change(function () {
        $('.deluser').each(function () {
            if (this.checked)
                this.checked = false;
            else
                this.checked = true;
        });

    });


    $('body').on('click', '.delvopros', function (e) {
        e.preventDefault();

        $('#vopros' + $(this).data('vopros')).remove();


    })


    $('body').bind('paste keyup', '.form-control.col-10', function (e) {

        var element = $(this);
        setTimeout(function () {
            var text = $(element).val();
            var r = 1;

            r += $(".form-control.col-10").length;

            if (!$("#v" + $(".form-control.col-10").length).val().length) return false;

            $(".voproses").append('<div class="input-group input-group-sm" id="vopros' + r + '"><label htmlFor="">Вариант ' + r + '</label><input type="text" name="vopros[]" id="v' + r + '" class="form-control col-10" placeholder="Введите вариант"value=""><div class="input-group-append"><button type="button" data-vopros="' + r + '" class="btn btn-danger btn-sm delvopros">\n' +
                '                               <i class="fas fa-trash">\n' +
                '                                                </i>\n' +
                '                                                Удалить\n' +
                '                                            </button></div></div>');
            // do something with text
        }, 100);

    });

    $(".delvopros_old").click(function () {

        if (confirm('Вы уверены что хотите удалить вариант ?')) {
            var data = new FormData();
            data.append("id", $(this).data('vopros'));
            $('#vopros_old' + $(this).data('block')).remove();

            $.ajax({
                data: data,
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '/admin_panel/oprosu/del',
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                }
            });
        }
    });





})


function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
        title: 'File Manager',
        url: '/elfinder/tinymce5',
        /**
         * On message will be triggered by the child window
         *
         * @param dialogApi
         * @param details
         * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
         */
        onMessage: function (dialogApi, details) {
            if (details.mceAction === 'fileSelected') {
                const file = details.data.file;

                // Make file info
                const info = file.name;

                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback(file.url, {text: info, title: info});
                }

                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    callback(file.url, {alt: info});
                }

                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback(file.url);
                }

                dialogApi.close();
            }
        }
    });
}
