<?php if (ErrorHandler::hasErrors()) echo ErrorHandler::displayErrors(); ?>

<div class="modal fade" id="cregister" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register Your Company</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="registercom.php?add2=1" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control" id="companyName" name="companyName" required 
                                   placeholder="Enter your company name">
                        </div>
                        <div class="invalid-feedback">
                            Please enter your company name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   placeholder="Enter your company email">
                        </div>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            </div>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select company category</option>
                                <option value="Waste Collection">Waste Collection</option>
                                <option value="Recycling">Recycling</option>
                                <option value="Waste Management">Waste Management</option>
                                <option value="Environmental Services">Environmental Services</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Please select a category.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <select class="form-control" id="location" name="location" required>
                                <option value="">Select your location</option>
                                <option value="Nairobi">Nairobi</option>
                                <option value="Mombasa">Mombasa</option>
                                <option value="Kisumu">Kisumu</option>
                                <option value="Nakuru">Nakuru</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Please select your location.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Company Description</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <textarea class="form-control" id="description" name="description" rows="3" required 
                                      placeholder="Describe your company's services"></textarea>
                        </div>
                        <div class="invalid-feedback">
                            Please provide a company description.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone" required 
                                   placeholder="Enter your company phone number">
                        </div>
                        <div class="invalid-feedback">
                            Please enter a valid phone number.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" required 
                                   placeholder="Enter your password">
                        </div>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required 
                                   placeholder="Confirm your password">
                        </div>
                        <div class="invalid-feedback">
                            Passwords do not match.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="logo">Company Logo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/*" required>
                            <label class="custom-file-label" for="logo">Choose file</label>
                        </div>
                        <small class="form-text text-muted">
                            Upload your company logo (max size: 2MB, supported formats: JPG, PNG)
                        </small>
                        <div class="invalid-feedback">
                            Please upload a company logo.
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>
                        </label>
                        <div class="invalid-feedback">
                            You must agree to the terms and conditions.
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-building"></i> Register Company
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center w-100">
                    Already have a company account? 
                    <a href="#" data-toggle="modal" data-target="#companyLogin" data-dismiss="modal">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Password confirmation validation
document.getElementById('confirmPassword').addEventListener('input', function() {
    var password = document.getElementById('password').value;
    var confirmPassword = this.value;
    if (password !== confirmPassword) {
        this.setCustomValidity('Passwords do not match');
    } else {
        this.setCustomValidity('');
    }
});

// File input label update
document.getElementById('logo').addEventListener('change', function() {
    var fileName = this.files[0] ? this.files[0].name : 'Choose file';
    this.nextElementSibling.textContent = fileName;
});
</script> 