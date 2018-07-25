
import 'bootstrap';
require('../scss/theme.scss');
const swal = require('sweetalert2');



$(document).ready(function(){
    console.log("it's ok");
    var form = $('#contact-form');
    var url = $(form).attr('action');
    console.log(url);

    $(form).on('submit', function(e){
       e.preventDefault();
       $.post(url,form.serialize())
           .done(function(){
                swal({
                    text:'Votre message a bien été envoyé ! Je vous contacte au plus vite',
                    type: 'success'
                });
       });

    });

});
