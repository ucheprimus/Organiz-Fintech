<form action="/submit-loan" method="POST">
    <!-- Personal Information -->
    <h3>Personal Information</h3>
    <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" required>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="form-group">
        <label for="address">Residential Address</label>
        <textarea id="address" name="address" required></textarea>
    </div>

    <!-- Employment Details -->
    <h3>Employment Details</h3>
    <div class="form-group">
        <label for="employmentStatus">Employment Status</label>
        <select id="employmentStatus" name="employmentStatus" required>
            <option value="Employed">Employed</option>
            <option value="Self-employed">Self-employed</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Retired">Retired</option>
        </select>
    </div>
    <div class="form-group">
        <label for="annualIncome">Annual Income</label>
        <input type="number" id="annualIncome" name="annualIncome" required>
    </div>

    <!-- Loan Details -->
    <h3>Loan Details</h3>
    <div class="form-group">
        <label for="loanAmount">Loan Amount Requested</label>
        <input type="number" id="loanAmount" name="loanAmount" required>
    </div>
    <div class="form-group">
        <label for="loanPurpose">Loan Purpose</label>
        <textarea id="loanPurpose" name="loanPurpose" required></textarea>
    </div>
    <div class="form-group">
        <label for="loanTerm">Loan Term</label>
        <input type="text" id="loanTerm" name="loanTerm" required>
    </div>

    <!-- Bank Details -->
    <h3>Bank Details</h3>
    <div class="form-group">
        <label for="bankName">Bank Name</label>
        <input type="text" id="bankName" name="bankName" required>
    </div>
    <div class="form-group">
        <label for="accountNumber">Account Number</label>
        <input type="text" id="accountNumber" name="accountNumber" required>
    </div>

    <!-- Credit History -->
    <h3>Credit History</h3>
    <div class="form-group">
        <label for="creditScore">Credit Score</label>
        <input type="number" id="creditScore" name="creditScore">
    </div>
    <div class="form-group">
        <label for="outstandingDebts">Outstanding Debts</label>
        <textarea id="outstandingDebts" name="outstandingDebts"></textarea>
    </div>

    <!-- Guarantor Details (optional) -->
    <h3>Guarantor Details (if applicable)</h3>
    <div class="form-group">
        <label for="guarantorName">Guarantor Name</label>
        <input type="text" id="guarantorName" name="guarantorName">
    </div>
    <div class="form-group">
        <label for="guarantorPhone">Guarantor Phone</label>
        <input type="tel" id="guarantorPhone" name="guarantorPhone">
    </div>

    <!-- Documentation -->
    <h3>Documentation</h3>
    <div class="form-group">
        <label for="identityProof">Proof of Identity (ID/Passport)</label>
        <input type="file" id="identityProof" name="identityProof">
    </div>
    <div class="form-group">
        <label for="proofOfIncome">Proof of Income (Pay Slips/Tax Returns)</label>
        <input type="file" id="proofOfIncome" name="proofOfIncome">
    </div>

    <button type="submit" class="btn btn-primary">Submit Application</button>
</form>
