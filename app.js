$(document).ready(function(){
	$,ajax({
		url: "http://localhost/secdbms/data.php",
		method: "GET",
		success: function(data){
			console.log(data){
				console.log(data);
				 aaa
				var user_name = [];
				var player=[];
				var first_term_total=[];
				for(var user_name in data){
					subject.push("Player " + deta[user_name].playersubject);
					first_term_total.push(data[user_name])
				}
			}
		},
		error: function(data){
			console.log(data);
		}
	});
});