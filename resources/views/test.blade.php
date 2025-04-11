<form action="http://127.0.0.1:8000/clientstore" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="OCmw60Wo4nfAVjTU9Bhy44uIMxXjT4E9x0GLZU3q" autocomplete="off">

    <div class="step" id="step-1">
        <h3>Find User account</h3>

        <input type="hidden" name="user_id" id="user_id">

        <div class="step" id="step-1">
            <h3>Step 1: Personal Information</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="officer" class="form-label">Assign Officer</label>
                    <select name="officer" id="officer" class="form-control" required>
                        <option value="">-- Select Officer --</option>
                        <option value="1">Edwin</option>
                        <option value="4">Glory</option>

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="">select ---</option>
                        <option value="male">Male
                        </option>
                        <option value="female">
                            Female
                        </option>
                        <option value="other">Other
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="marital_status" class="form-label">Marital Status</label>
                    <select class="form-select" id="marital_status" name="marital_status">
                        <option value="">select ---</option>
                        <option value="single">
                            Single</option>
                        <option value="married">
                            Married</option>
                        <option value="divorced">Divorced
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tin" class="form-label">TIN</label>
                    <input type="text" class="form-control" id="tin" name="tin" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="1"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="identification_type" class="form-label">Identification Type</label>
                    <select class="form-select" id="identification_type" name="identification_type">
                        <option value="">select ---</option>
                        <option value="NIN">NIN</option>
                        <option value="driver's license">
                            Drivers
                            licence</option>
                        <option value="Voter's Card">Voters
                            Card
                        </option>
                        <option value="Int_passport">
                            International Passport</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="id_no" class="form-label">Identification No.</label>
                    <input type="text" class="form-control" id="id_no" name="id_no" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="upload" class="form-label">Upload Document (ID document) </label>
                    <input type="file" class="form-control" id="upload" name="upload" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="utility_bill" class="form-label">Utility Bill </label>
                    <input type="file" class="form-control" id="utility_bill" name="utility_bill"
                        value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="account_type">Select Account Type</label>
                    <select class="form-control" id="account_type" name="account_type" required>
                        <option value="" disabled selected>-- Select --</option>
                        <option value="savings">Savings</option>
                        <option value="loan">Loan</option>
                        <option value="investment">Investment</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="step" id="step-2">
            <h3>Step 2: Employment Details</h3>
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="employment_status" class="form-label">Employment Status</label>
                    <select class="form-select" id="employment_status" name="employment_status">
                        <option value="">select ---</option>
                        <option value="employed">Employed
                        </option>
                        <option value="self_employed">Self
                            Employed</option>
                        <option value="student">Student
                        </option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="job_title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="monthly_income" class="form-label">Monthly Income</label>
                    <input type="number" class="form-control" id="monthly_income" name="monthly_income"
                        value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="job_duration" class="form-label">Job Duration (Years)</label>
                    <input type="number" class="form-control" id="job_duration" name="job_duration"
                        value="">
                </div>
            </div>
        </div>

        <div class="step" id="step-3">
            <h3>Step 3: Bank Details</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="bank_name" class="form-label">Bank name</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bank_account_type" class="form-label">Bank Account Type</label>
                    <select class="form-select" id="bank_account_type" name="bank_account_type">
                        <option value="">select ---</option>
                        <option value="savings">
                            Savings Loan</option>
                        <option value="current">
                            Current</option>
                        <option value="fixed">
                            Fixed</option>
                        <option value="domicillary">Domicillary
                            Loan
                        </option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="loan_amount" class="form-label">Account No.</label>
                    <input type="number" class="form-control" id="loan_amount" name="account_no" value="">
                </div>
            </div>
        </div>
        <div class="step" id="step-4">
            <h3>Step 4: Guarantor's Details</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="g_name" class="form-label">Guarantor's Name</label>
                    <input type="text" class="form-control" id="g_name" name="g_name" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="g_phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="g_phone" name="g_phone" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="g_address" class="form-label">Guarantor's Address</label>
                    <input type="text" class="form-control" id="g_address" name="g_address" value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="g_relationship" class="form-label">Relationship with Guarantor</label>
                    <input type="text" class="form-control" id="g_relationship" name="g_relationship"
                        value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="g_occupation" class="form-label">Guarantor's Occupation</label>
                    <input type="text" class="form-control" id="g_occupation" name="g_occupation"
                        value="">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="g_passport" class="form-label">Guarantor's Passport</label>
                    <input type="file" class="form-control" id="g_passport" name="g_passport" value="">
                </div>
            </div>
        </div>
        <div class="step" id="step-5">
            <h3>Step 5: Review and Submit</h3>
            <div class="col-md-6 mb-3">
                <input type="checkbox"> I agree to the Terms & Conditions of Organiz
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>
</form>
