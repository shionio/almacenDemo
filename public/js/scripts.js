// function llenarModelo(){
// 			//alert('a')
// 			var marca = $('#marca').val()
// 			//var token = $("#token").val()
// 			$.ajaxSetup({
// 			    headers: {
// 			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 			    }
// 			});
// 			// console.log(token)

// 			$.ajax({
// 				//headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
// 				url : 'llenarModelo',
// 				type : 'POST',
// 				data :	{id_marca : marca, "_token": "{{ csrf_token() }}" },

// 				success:function(modelo){
// 					console.log(modelo)
// 				}
// 			})
// }