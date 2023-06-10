<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<style>
		body {
			background-image: url('img/Starlid-illustration.svg');
			background-size: contain;
			background-repeat: no-repeat;
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}

		.header {
			background-color: #ffffff;
			color: #fff;
			padding: 10px;
			box-shadow: 0px 4px 8px rgb(0 0 0/10%)
		}

		.header img {
			max-width: 150px;
			height: 30px;
			margin-left: 20px;
		}

		form {
			max-width: 500px;
			margin: 10px;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 5px;
			background-color: #fcfcfc;
			float: right;
			margin-top: 30px;
			margin-right: 70px;
			font-size: 12px;
			box-shadow: 0px 4px 8px rgb(0 0 0/10%)
		}

		form img {
			max-width: 120px;
			height: auto;
			margin-top: 10px;
			margin-bottom: -10px;

		}

		h4 {
			font-size: 25px;
			margin-bottom: 0px;
		}

		label {
			display: block;
			font-weight: normal;
			margin-left: 1px;
		}

		input[type=text],
		input[type=email],
		input[type=number] {
			width: 100%;
			padding: 12px 20px;
			margin: 10px 0;
			display: block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=submit] {
			background-color: #1e88e5;
			color: white;
			padding: 5px 10px;
			margin: 8px 0;
			width: 100%;
			cursor: pointer;
			border-color: #1e88e5;
		}

		.social {
			flex-flow: row wrap;
			align-items: center;
		}

		.social img {
			height: 40px;
			margin-left: 40px;
			margin-bottom: 10px;
		}

		.web {
			margin-left: 160px;
		}

		#tableData {
			display: none;
			/* Initially hide the table */
			position: fixed;
			bottom: 0;
			width: 100%;
			background-color: #fcfcfc;
			box-shadow: 0px 4px 8px rgb(0 0 0/10%);
			border-collapse: collapse;
			/* Merge cell borders */
			font-size: 14px;
		}

		#tableData th {
			background-color: #f5f5f5;
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		#tableData td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
		}

		#tableData tbody tr:hover {
			background-color: #f9f9f9;
		}

		#successMessage {
			font-size: 18px;
			margin-bottom: 0px;
			color: green;
		}

		.alertMessage {
			display: none;
			padding: 10px;
			font-weight: bold;
			text-align: center;
		}

		.alertMessage.yellow {
			color: orange;
		}

		.alertMessage.green {
			color: green;
		}

		.alertMessage.red {
			color: red;
		}
	</style>
</head>

<body>
	<div class="header">
		<img src="img/nw-horizontal.png">
	</div>
	<form id="lowker">
		<img src="img/logomark-sign.png">

		<h4>Form Rekrutasi</h4>
		<p>Isi data di bawah sesuai dengan identitas diri anda dan lowongan yang akan anda pilih</p>

		<label for="fullname">Fullname: <span style="color:red">*</span></label>
		<input type="text" id="fullname" name="fullname" placeholder="Masukkan Nama">

		<label for="email">Email: <span style="color:red">*</span></label>
		<input type="text" id="email" name="email" placeholder="Masukkan Email">

		<label for="password">Phone Number: <span style="color:red">*</span></label>
		<input type="number" id="phone" name="phone" placeholder="Masukkan Number">

		<label for="password">Vacancy: <span style="color:red">*</span></label>
		<select id="vacancy" name="vacancy">
			<option disables selected value>
				- Pilih Lowongan -
			</option>
		</select>
		<div id="alertMessage"></div>
		<label for="position">Position <span style="color:red">*</span></label>
		<select class="form-control" name="posisi" id="posisi">
			<option value="" disabled="" selected="">- Pilih Posisi -</option>
		</select>
		<input type="submit" value="Kirim">
		<ul class="social">

			<a href="https://instagram.com/neuronworks">
				<img src="img/instagram.svg">
			</a>

			<a href="https://www.youtube.com/@NeuronworksIndonesia">
				<img src="img/youtube.svg">
			</a>

			<a href="https://twitter.com/neuronworks">
				<img src="img/twitter.svg">
			</a>

			<a href="https://www.facebook.com/neuronworks/">
				<img src="img/square-facebook.svg">
			</a>
		</ul>
		<a class="web" href="https://www.neuronworks.co.id">
			www.neuronworks.co.id
		</a>
	</form>

	<table id="tableData">
		<thead>
			<div id="successMessage"></div>
			<tr>
				<th>Fullname</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Vacancy</th>
				<th>Position</th>
				<th> <button onclick="clearDataTable()">Reset</button></th>
			</tr>
		</thead>
		<tbody id="bodyData"></tbody>
	</table>

	<script>
		var lowonganData = ["Database Administrator", "Programmer", "System Administrator"];

		var posisiData = ["Jakarta", "Bandung"];

		var inputData = [];

		var lowonganDropdown = document.getElementById("vacancy");
		var posisiDropdown = document.getElementById("posisi");

		var kuotaVacancy = {
			"Database Administrator": {
				kuota: 1,
				terisi: 0
			},
			"Programmer": {
				kuota: 2,
				terisi: 0
			},
			"System Administrator": {
				kuota: 2,
				terisi: 0
			}
			
		};

		lowonganData.forEach(function (lowongan) {
			var option = document.createElement("option");
			option.text = lowongan;
			lowonganDropdown.appendChild(option);
		});


		posisiData.forEach(function (posisi) {
			var option = document.createElement("option");
			option.text = posisi;
			posisiDropdown.appendChild(option);
		});

		var selectElement = document.getElementById('vacancy');
		var msgVcncy = document.getElementById("alertMessage");


		selectElement.addEventListener("change", function () {
			var selectedVacancy = selectElement.value;
			msgVcncy.innerHTML = "";



			if (isValidVacancy(selectedVacancy)) {
				var lowonganInfo = getLowonganInfo(selectedVacancy);
				msgVcncy.innerHTML = lowonganInfo;
				if (lowonganInfo.includes('Kuota tersisa')) {
					msgVcncy.className = "alertMessage yellow";
				} else if (lowonganInfo.includes('Anda dapat memilih')) {
					msgVcncy.className = "alertMessage green";
				} else if (lowonganInfo.includes('Mohon maaf') || lowonganInfo.includes('Lowongan tidak tersedia')) {
					msgVcncy.className = "alertMessage red";
				}
				msgVcncy.style.display = "block";
			} else {
				msgVcncy.innerHTML = "Lowongan tidak tersedia";
			}
		});

		const form = document.getElementById("lowker");
		const bodyData = document.getElementById("bodyData");
		form.addEventListener("submit", function (event) {
			event.preventDefault();
			const nama = document.getElementById("fullname").value;
			const email = document.getElementById("email").value;
			const phone = document.getElementById("phone").value;
			const vacancy = document.getElementById("vacancy").value;
			const posisi = document.getElementById("posisi").value;


			if (nama === "" || email === "" || phone === "" || vacancy === "" || posisi === "") {
				alert("Harap isi semua kolom!");
				return;
			}
			else if (!isValidEmail(email)) {
				alert("Harap masukan email yang sesuai!");
				return;
			}
			else if (!isValidPhoneNumber(phone)) {
				alert("Harap masukan no telp yang sesuai minimal 7 angka dan diawali 08!");
				return;
			}
			else if (!isValidVacancy(vacancy)) {

				var lowonganInfo = getLowonganInfo(vacancy);

			}
			else {
				var emailExists = inputData.some(function (item) {
					return item.email === email;
				});

				if (emailExists) {

					alert("Email sudah terdaftar");
					return;
				}

				else {

					alertMessage.innerHTML = lowonganInfo;
					inputData.push({ name: nama, email: email, phone: phone, vacancy: vacancy, posisi: posisi });
					kuotaVacancy[vacancy].terisi++;
					const successMessage = document.getElementById("successMessage");
					successMessage.innerHTML = "Terima kasih telah melakukan pengisian, permintaan anda akan kami segera proses! jumlah pelamar "
						+ vacancy + " adalah " + kuotaVacancy[vacancy].terisi + " Pelamar.";



					const newRow = document.createElement("tr");
					const namaCell = document.createElement("td");
					const emailCell = document.createElement("td");
					const phoneCell = document.createElement("td");
					const vacancyCell = document.createElement("td");
					const posisiCell = document.createElement("td");
					const clearButtonCell = document.createElement("td");



					namaCell.textContent = nama;
					emailCell.textContent = email;
					phoneCell.textContent = phone;
					vacancyCell.textContent = vacancy;
					posisiCell.textContent = posisi;



					newRow.appendChild(namaCell);
					newRow.appendChild(emailCell);
					newRow.appendChild(phoneCell);
					newRow.appendChild(vacancyCell);
					newRow.appendChild(posisiCell);


					bodyData.appendChild(newRow);


					form.reset();
					alertMessage.innerHTML = "";
					tableData.style.display = "table";
				}




			}



		});

		function clearDataTable() {
			bodyData.innerHTML = "";
			successMessage.innerHTML = "";
			alertMessage.innerHTML = "";
			inputData = [];
			tableData.style.display = "none";
		}
		function isValidEmail(email) {
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return emailRegex.test(email);
		}



		function isValidPhoneNumber(phone) {
			var phoneRegex = /^08[0-9]{7,12}$/;
			return phoneRegex.test(phone);
		}


		function getLowonganInfo(vacancy) {
			if (kuotaVacancy.hasOwnProperty(vacancy)) {
				var lowongan = kuotaVacancy[vacancy];
				if (lowongan.terisi < lowongan.kuota) {
					var tersisa = lowongan.kuota - lowongan.terisi;
					if (tersisa <= 2) {
						return 'Kuota tersisa untuk ' + vacancy + ' hanya ' + tersisa + ' pendaftar.';
					} else {
						return 'Anda dapat memilih lowongan ' + vacancy + '.';
					}
				} else {
					return 'Mohon maaf, rekrutasi untuk ' + vacancy + ' sudah penuh dan tidak dapat dipilih.';
				}
			} else {
				return 'Lowongan tidak tersedia.';
			}
		}


		function isValidVacancy(vacancy) {
			if (kuotaVacancy.hasOwnProperty(vacancy)) {
				if (kuotaVacancy[vacancy].terisi < kuotaVacancy[vacancy].kuota) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		const clearButton = document.getElementById("clearButton");
		clearButton.addEventListener("click", clearDataTable);

	</script>

</body>

</html>
