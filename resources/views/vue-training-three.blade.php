<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.completed {text-decoration: line-through; }
		ul { background: grey; }
		.fade-transition { transition: all .5s ease; }
		.fade-enter, .fade-leave { opacity: 0; }
	</style>
</head>
<body>
<div id="app" class="container">
	<!-- 12  video -->
	<h1>Phase Three</h1>
	<br/>

	<p>Admin</p>
	<ul>
		<li v-for="person in people | role 'admin' ">@{{ person.name }}</li>
	</ul>

	<p>Students</p>
	<ul>
		<li v-for="person in people | role 'student' ">@{{ person.name }}</li>
	</ul>


	<message @new-message="handleNewMessage"></message>
	<button @click="show = ! show">Toggle</button>
	<ul v-show="show" transition="fade">
		<li v-for="msg in messages">@{{ msg }}</li>
	</ul>


</div>
<br/><br/><br/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>

<script>

	Vue.filter('role', function (value, role) {
		return value.filter(function (item) {
			return item.role == role;
		});
	});

	Vue.component('message', {
		template: '<input v-model="message" @keyup.enter="storeMessage">',
		data: function(){
			return {message: ''};
		},
		methods: {
			storeMessage: function () {
				this.$dispatch('new-message', this.message);
				this.message = '';
			}
		}
	});

	new Vue({
		el: '#app',
		data: {
			people: [
				{name: 'Joe', role: 'admin'},
				{name: 'Cloe', role: 'student'},
				{name: 'Paul', role: 'admin'},
				{name: 'Maria', role: 'admin'}
			],
			messages: [],
			show: true
		},
		/* implicit way
			events: {
			'new-message': function (message) {
				console.log('Parent is handling ' + message);
			}
		}*/
		methods: {
			handleNewMessage: function (message) {
				this.messages.push(message);
			}
		}
	});

</script>
</body>
</html>