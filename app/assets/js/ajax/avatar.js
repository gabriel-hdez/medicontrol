(function($){
    $(function(){
        
        // intercambiar avatares
        $('.avatars').click(function() {
            var avatarUploadNew     = $(this).attr('data-avatar');      
            var avatarNew           = $(this).attr('src');            
            var avatarUploadOld     = $('#preview').attr('data-avatar');      
            var avatarOld           = $('#preview').attr('src');    
            
            $('#avatarUpload').val(avatarUploadNew);
            $('#imgAvatar').val(avatarUploadNew);
            $('#preview').attr('src', avatarNew);
            $('#preview').attr('data-avatar', avatarUploadNew);
            $(this).attr('src', avatarOld);
            $(this).attr('data-avatar', avatarUploadOld);
            
            $('#myAvatar').submit();

        });

        $('#imgAvatar').change(function() {
            $('#avatarUpload').val('1');                    
            $('#myAvatar').submit();
        });

    });
})(jQuery);