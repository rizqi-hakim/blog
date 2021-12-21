const form = document.getElementById('form-register');
const uname = document.getElementById('name');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
	// console.log(checkInputs());
	// $("#form-register").submit();
});

function checkInputs() {
	// trim to remove the whitespaces
	const unameValue = uname.value.trim();
	const usernameValue = username.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	
	// let validUname = false;
	// let validUsername = false;
	// let validEmail = false;
	// let validPassword = false;
	// let validConPassword = false;
	var validUname = validUsername = validEmail = validPassword = validConPassword = false;
	
	if(unameValue === '') {
		setErrorFor(uname, 'Name cannot be blank');
	} else {
		setSuccessFor(uname);
		validUname = true;
	}

	if(usernameValue === '') {
		setErrorFor(username, 'Username cannot be blank');
	} else {
		$.post('check-username', {
			username: usernameValue
		}, function (data) {
			if (data == 1) {
				setErrorFor(username, 'This username is already exist');
			} else {
				setSuccessFor(username);
				validUsername = true;
			}
		})
	}
	
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		$.post('check-email', {
			email: emailValue
		}, function (data) {
			if (data == 1) {
				setErrorFor(email, 'This email is already exist');
			} else {
				setSuccessFor(email);
				validEmail = true;
			}
		})
	}
	
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else {
		setSuccessFor(password);
		validPassword = true;
	}
	
	if(password2Value === '') {
		setErrorFor(password2, 'Confirmation password cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Confirmation password does not match');
	} else{
		setSuccessFor(password2);
		validConPassword = true;
	}

	console.log(validUname . validUsername);
	// Prevent the form from being submitted if there are any errors
    if((validUname || validUsername || validEmail || validPassword || validConPassword) == false) {
		return false;
	 } else {
		// console.log('sini');
		return true;
	 }
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-floating error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-floating success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}