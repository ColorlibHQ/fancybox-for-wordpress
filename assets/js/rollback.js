jQuery(document).ready(function(){
    //rollback function
    jQuery('.fbfw-rollback-button').on('click', function (event) {
        var checkD = confirm('Are you sure you want to reinstall previous version?');
        if( checkD == true ){
            return true;
        } else {
            return false;
        }
    });
});