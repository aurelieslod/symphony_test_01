$.ajax ({

  url: '/products/1/delete.json',
  method: 'DELETE'

}).done(function(data) {

  console.log(data);

});
