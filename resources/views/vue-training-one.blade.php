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
<div id="app" class="container ">
	<!-- First video -->
	<h1>@{{message}}</h1>

	<h2>First video</h2>
	<label>Change Title:</label><input v-model="message" class="form-control">
	<pre> @{{ $data | json}} </pre>

	<br/>

	<!-- Second video-->
	<h2>Second video</h2>
	<form>
		<!-- v-show remove complitelly the element and v-if put display=none on the element -->
		<span class="text-danger" v-show="!input">You must enter a message</span>
		<textarea v-model="input" class="form-control" rows="6"></textarea>
		<button class="btn btn-default" type="submit" v-if="input"> Send Message </button>
	</form>


	<br/>

	<!-- Third video-->
	<h2>Third video</h2>
	<!-- v-on:submit is exactly the same as @submit-->
        <form action="done.html" @submit.prevent="handleIt">
            <button class="btn btn-default" type="submit" @click="doSomething"> Submit it </button>
        </form>

        <br/>

        <!-- On @click is possible to put expression so updateCount function is the same as @click="count += 1" -->
	<button class="btn btn-primary" type="submit" @click="updateCount">
	Increment Counter: @{{count}}
	</button>

	<br/>

	<!-- Fourth video-->
	<h2>Fourth video</h2>
	<counter subject="Likes"></counter>
	<counter subject="Dislikes"></counter>

	<template id="counter-template">
		<button class="btn btn-default" @click="count += 1">@{{subject}} @{{count}}</button>
	</template>

	<br/>

	<!-- Fifth video-->
	<h2>Fifth video</h2>
	<h3>Skill: @{{skill}}</h3>
	<h4>@{{fullName}}</h4>
	<input v-model="firstName">
	<input v-model="lastName">

	<br/>

	<!-- Sixth video-->
	<h2>Sixth video</h2>
	<div v-for="plan in plans">
		<plan :plan="plan" :active.sync="active"></plan>
	</div>

	<template id="plan-template">
		<div class="row">
			<span class="col-md-1">@{{ plan.name }}</span>
			<span  class="col-md-2">@{{ plan.price }}/month</span>
			<button class="btn col-md-1" @click="setActivePlan" v-show="plan.name !== active.name">
			@{{ isUpgrade ? 'Upgrade' : 'Downgrade' }}</button>

                <span v-else class="text-success">
                    Current
                </span>
		</div>
	</template>


	<br/>

	<!-- Seventh video-->
	<h2>Seventh video</h2>
	<ul>
		<li :class="{ 'completed': task.completed}"
			v-for="task in tasks"
		@click="toggleCompletedFor(task)"
		>
		@{{ task.body }}</li>
	</ul>


	<br/>

	<!-- Eighth video-->
	<h2>Eighth video</h2>
	<tasks :list="tasks"></tasks>
	<tasks :list="[{body:'Bla Bla Bla', completed: false}, {body:'Ble Ble Ble', completed: true}]"></tasks>

	<template id="tasks-template">
		<div  v-show="showAdd" class="row">
			<label>New Task</label>
			<input v-model="newTask" v-on:keyup.enter="addTask">
			<button @click="addTask"  class="btn">Save</button>
		</div>

		<h5> My Task
			<span v-show="remaining"> (@{{ remaining }}) </span>
		</h5>

		<ul v-show="list.length">
			<li :class="{ 'completed': task.completed}"
				v-for="task in list"
			@click="task.completed = ! task.completed"
			>
			@{{ task.body }}
			<strong @click="deleteTask(task)">x</strong>
			</li>
		</ul>
		<p v-else> No tasks yet!</p>
		<button @click="clearCompleted">Clear completed</button>
	</template>

	<br/>

	<!-- Ninth video-->
	<h2>Ninth video</h2>
	<tasks :list="tasks2" show-add="true"></tasks>

	<br/>

	<!-- Tenth video-->
	<h2>Tenth video</h2>


</div>
<br/><br/><br/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>

<script>
	Vue.component('tasks', {
		template: '#tasks-template',
		props: ['list', 'showAdd'],
		computed: {
			remaining: function () {
				return this.list.filter(this.inProgress).length;
			}
		},
		methods: {
			isCompleted: function (task) {
				return task.completed;
			},
			inProgress: function (task) {
				return ! task.completed;
			},
			deleteTask: function (task) {
				this.list.$remove(task);
			},
			clearCompleted: function () {
				this.list = this.list.filter(this.inProgress);
			},
			addTask: function () {
				var task = this.newTask.trim()
				if (task) {
					this.list.push({ body: task, completed: false })
					this.newTask = ''
				}
			}
		},
		data: function () {
			return {newTask: ''};
		}
	});

	Vue.component('counter', {
		template: '#counter-template',
		props: ['subject'],
		data: function () {
			return {count: 0};
		}
	});

	new Vue({
		el: '#app',
		data: {
			message: 'Vue Training',
			input:'',
			count: 0,
			points:30,
			firstName: 'Jeisse',
			lastName: 'Rocha',
			plans:[
				{ name: 'Enterprise', price: 100},
				{ name: 'Pro', price: 50},
				{ name: 'Personal', price: 10},
				{ name: 'Free', price: 0}
			],
			active: {},
			tasks: [
				{ body:'Go to the store', completed: false},
				{ body:'Go to the bank', completed: false},
				{ body:'Go to the doctor', completed: false}
			],
			tasks2: [
				{ body:'Go to the store', completed: false},
				{ body:'Go to the bank', completed: false},
				{ body:'Go to the doctor', completed: true}
			]
		},
		methods: {
			handleIt: function () {
				alert('HandleIt');
			},
			updateCount: function () {
				this.count += 1;
			},
			doSomething: function () {
				//do something
			},
			toggleCompletedFor: function (task) {
				task.completed = ! task.completed;
			}
		},
		computed: {
			skill: function () {
				if (this.points <= 100) {
					return 'Beginner';
				}

				return 'Advanced';
			},
			fullName: function () {
				return this.firstName+ ' '+this.lastName;
			}
		},
		components: {
			plan: {
				template: '#plan-template',
				props: ['plan', 'active'],
				computed: {
					isUpgrade: function () {
						return this.plan.price > this.active.price;
					}
				},
				methods: {
					setActivePlan: function () {
						this.active = this.plan;
					}
				}
			}
		}
	})

</script>
</body>
</html>