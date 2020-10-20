const form = document.querySelector("#formSubmit");
const firstName = document.querySelector("#firstName");
const lastName = document.querySelector("#lastName");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const repeatPassword = document.querySelector("#repeatPassword");
const error = document.querySelector("#error");

form.addEventListener("submit", (e) => {
	e.preventDefault();
	const user = {
		firstName: firstName.value,
		lastName: lastName.value,
		email: email.value,
		password: password.value,
		repeatPassword: repeatPassword.value,
	};

	axios.post("./src/assets/form.php", user).then((res) => isResponse(res));
});

function isResponse({ data, data: { ok } }) {
	if (ok) {
		error.textContent = data.messages[0];
		error.classList.remove("d-none");
		error.classList.remove("alert-danger");
		error.classList.add("alert-success");
		error.classList.add("d-block");
		setTimeout(() => {
			location.href = "./src/pages/success.html";
		}, 1000);
	} else {
		if (data.messages.length) {
			error.textContent = data.messages[0];
			error.classList.remove("d-none");
			error.classList.add("d-block");
		}
	}
}
