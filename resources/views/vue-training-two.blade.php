<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.completed {text-decoration: line-through; }
	</style>
</head>
<body>
<div id="app" class="container">
	<!-- 12  video -->
	<h1>Phase Two</h1>

	<alert type="info" > You account is ok.</alert>
	<alert type="success" > Your Account has been updated.</alert>
	<alert type="error" > Some Problem occurred.</alert>

	<template id="my-alert-template">
		<div class="alert alert-@{{type == 'error' ? 'danger' : type}} alert-dismissible fade in" role="alert" v-show="show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="show = false">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong>@{{ type }}!</strong> <slot></slot>
		</div>

	</template>
</div>
<br/><br/><br/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>

<script>
	Vue.component('alert', {
		template: '#my-alert-template',
		props: ['type'],
		methods: {
			deleteAlert: function () {

			}
		},
		data: function () {
			return { show: true};
		}
	});

	new Vue({
		el: '#app'
	});

</script>
</body>
</html>