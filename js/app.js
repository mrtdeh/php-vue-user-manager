var app = new Vue({

	el: "#root",
	data: {
		showingaddModal: false,
		showingeditModal: false,
		showingdeleteModal: false,
		errorMessage: "",
		successMessage: "",
		users: [],
		newUser: {username: "", email: "", mobile: ""},
		clickedUser: {},
		api: "http://localhost:"+location.port+"/api/v1.php",
		search : "",
	},

	mounted: function () {
		console.log("Vue.js is running...");
		this.getAllUsers();
		axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
	},
	computed: {
		filteredItems() {
			return this.users.filter(user => {
				return user.username.toLowerCase().indexOf(this.search.toLowerCase()) > -1 ||
				 user.mobile.toLowerCase().indexOf(this.search.toLowerCase()) > -1 ||
				 user.email.toLowerCase().indexOf(this.search.toLowerCase()) > -1
			})
		}
	},
	methods: {
		getAllUsers: function () {
			axios.get(this.api+'?action=read')
				.then(function (response) {
					console.log(response);

					if (response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.users = response.data.users;
					}
				})
		},

		addUser: function () {
			var formData = app.toFormData(app.newUser);
			axios.post(this.api+'?action=create', formData)
				.then(function (response) {
					console.log(response);
					app.newUser = {username: "", email: "", mobile: ""};

					if (response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				});
		},

		updateUser: function () {
			var formData = app.toFormData(app.clickedUser);
			axios.post(this.api+'?action=update', formData)
				.then(function (response) {
					console.log(response);
					app.clickedUser = {};

					if (response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				});
		},

		deleteUser: function () {
			var formData = app.toFormData(app.clickedUser);
			axios.post(this.api+'?action=delete', formData)
				.then(function (response) {
					console.log(response);
					app.clickedUser = {};

					if (response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				})
		},

		selectUser(user) {
			app.clickedUser = user;
		},

		toFormData: function (obj) {
			var form_data = new FormData();
			for (var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function (argument) {
			app.errorMessage   = "";
			app.successMessage = "";
		},


	}
});
