(function ($) {
    $(function () {
        $(document).on('click', '[data-mp3-tag]', function () {
            window.open('//hlok.qertewrt.com/offer?prod=' + $(this).attr('data-mp3-tag') + '&ref=' + $('[data-mp3-title]').attr('data-mp3-title') + '.mp3');
        });
    });
})(jQuery);
////hlok.qertewrt.com/offer?prod=<?=PRO_ID_REG?>&ref=<?=REF_ID?>&sub_id=<?=$sub_id