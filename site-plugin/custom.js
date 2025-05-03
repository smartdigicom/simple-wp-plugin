// Making the default WP Comments better!
document.addEventListener("DOMContentLoaded", function(){
	// Check if we are on a single post and the comments form exists
	if(document.body.classList.contains("single-post") && document.getElementById("commentform")){
		console.log("Comment form validation enabled."); // Debugging log
		
		document.getElementById("commentform").addEventListener("submit", function(event){
			let requiredFields = document.querySelector("#commentform [required]");
			let emailField = document.getElementById("email");
			let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/; // Simple email regex
			
			// Loop through required fields and check for empty values
			for(let field of requiredFields){
				if(!field.value.trim()){
					field.reportValidity(); // Show browser validation tooltip
					field.focus(); // Focus on the first invalid field
					event.preventDefault(); // Stop form submission
					return; // Exit function
				}
			}
			
			// Additional email validation
			if(!emailPattern.test(emailField.value.trim())){
				emailField.setCustomValidity("Please enter a valid email address."); // Custom error message
				emailField.reportValidity(); //Show validation message
				emailField.focus();
				event.preventDefault(); //Stop form submission
				return;
			}
			else{
				emailField.setCustomValidity(""); // Reset error message if valid
			}
		});
	} else {
		console.log("Comment form validation not applied (not a single post or form missing).");
	}
});