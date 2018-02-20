$(document).ready(function () {
   $(document).on('click', 'button', function (e) {
       var doneBox = $('div.result span.done');
       var totalBox = $('div.result span.total');
       var amount = $('input').val();

       $(totalBox).html(amount);
       $(doneBox).html(0);
       $('div.result').show();
       if (amount > 10) {
           alert('please behave (< 10)');
       } else {
           for (var i = 0; i < amount; i++) {
               $.ajax({
                   url: '/load',
                   method: 'post',
                   async: true,
                   success: function (response) {
                       $(doneBox).html(Number($(doneBox).html()) + 1);
                   }
               });
           }
       }
   });
});