<?php require "bootstrap.php"; 

header("Access-Control-Allow-Methods: GET");
?>


<!DOCTYPE html>

<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>پنل کاربری</title>
	<link rel="stylesheet" href="css/bootstrap.rtl.css">
	<link rel="stylesheet" href="style.css">
	<script src="js/axios.min.js"></script>
</head>
<body>
<style>
label,input{


text-align:right;
}

</style>	
	<div id="root">
		<nav class="navbar navbar-expand-lg navbar-dark" style="flex-flow: row-reverse ;important">
			


					<button class="btn btn-success" @click="showingaddModal = true;">کاربر جدید</button>
		
		</nav>

		<div class="container p-5">
			<div class="row justify-content-end">

				<div class="alert alert-danger col-md-6" id="alertMessage" role="alert" v-if="errorMessage">
					{{ errorMessage }}
				</div>

				<div class=" alert alert-success col-md-6" id="alertMessage" role="alert" v-if="successMessage">
					{{ successMessage }}
				</div>

			<input style="border: solid 3px black;" class="form-control" type="text" placeholder="جستجوی کاربر : نام کاربری / ایمیل / موبایل" aria-label="Search" v-model="search">
			<div style="margin:5px;"></div>
				<table dir="rtl" class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>ردیف</th>
							<th>نام کاربری</th>
							<th>ایمیل</th>
							<th>موبایل</th>
							<th>ویرایش</th>
							<th>حذف</th>
						</tr>
					</thead>
					<tbody class="tbody-custom">
						<tr v-if="!users.length"><td align="center" colspan="6">هنوز کاربری اضافه نشده</td></tr>
						<tr v-for="user in filteredItems">
							<td>{{user.id}}</td>
							<td>{{user.username}}</td>
							<td>{{user.email}}</td>
							<td>{{user.mobile}}</td>
							<td><button @click="showingeditModal = true; selectUser(user);" class="btn btn-warning">ویرایش</button></td>
							<td><button @click="showingdeleteModal = true; selectUser(user);" class="btn btn-danger">حذف</button></td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>

	<!-- add modal -->
		<div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
				<div class="modal-head">
					<p class="p-left p-2">کاربر جدید</p>
					<hr/>

					<div class="modal-body">
							<div class="col-md-12">
								<label for="uname">نام کاربری</label>
								<input type="text" id="uname" class="form-control" v-model="newUser.username">

								<label for="email">ایمیل</label>
								<input type="text" id="email" class="form-control" v-model="newUser.email">

								<label for="phn">موبایل</label>
								<input type="text" id="phn" class="form-control" v-model="newUser.mobile">
							</div>

						<hr/>
							<button type="button" class="btn btn-success"  @click="showingaddModal = false; addUser();">ذخیره تغییرات</button>
							<button type="button" class="btn btn-danger"   @click="showingaddModal = false;">بی خیال</button>
					</div>
				</div>
			</div>


	<!-- edit modal -->
		<div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
			<div class="modal-head">
				<p class="p-left p-2">ویرایش کاربر</p>
				<hr/>

				<div class="modal-body">
						<div class="col-md-12">
							<label for="uname">نام کاربری</label>
							<input type="text" id="uname" class="form-control" v-model="clickedUser.username">

							<label for="email">ایمیل</label>
							<input type="text" id="email" class="form-control" v-model="clickedUser.email">

							<label for="phn">موبایل</label>
							<input type="text" id="phn" class="form-control" v-model="clickedUser.mobile">
						</div>

					<hr/>
						<button type="button" class="btn btn-success"  @click="showingeditModal = false; updateUser();">ذخیره تغییرات</button>
						<button type="button" class="btn btn-danger"   @click="showingeditModal = false;">بی  خیال</button>
				</div>
			</div>
		</div>


		<!-- delete data -->
		<div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal">
			<div class="modal-head">
				<p class="p-left p-2">حذف</p>
				<hr/>

				<div class="modal-body">
						<center>
							<p>میخوای حذفش کنی ؟</p>
							<h3>{{clickedUser.username}}</h3>
						</center>
					<hr/>
						<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteUser();">اره</button>
						<button type="button" class="btn btn-warning"   @click="showingdeleteModal = false;">بی خیال</button>
				</div>
			</div>
		</div>

	</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.rtl.js"></script>

	<script src="js/vue.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
