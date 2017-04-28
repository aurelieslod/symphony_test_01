

function deleteProduct(id){
  $.ajax ({

    url: '/products/' + id + '/delete.json',
    method: 'DELETE'

  }).done(function(data){
    console.log(data.notice);
    $('#product-'+id).remove();
    $('.alert.alert-success').show({
      duration : 1000,
      complete : function(){
        $(this).hide({
          duration : 1000
        });
      }
    })
    $('.alert.alert-success p').text(data.notice);
  });

}
