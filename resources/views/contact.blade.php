<x-header></x-header>

<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <section>
        <header>
            <div class="my-3">
                <h2>Retailer Inquiries</h2>
                <p>This form is for retailer inquiries only. For all other customer or shopper
                    support requests, please visit the links below this form.
                </p>
            </div>
            <form class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="fname">First Name<span class="text-danger">*</span></label>
                    <input type="text" id="fname" class="form-control" name="fname" placeholder="Enter your first name" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="lname">Last Name<span class="text-danger">*</span></label>
                    <input type="text" id="lname" class="form-control" name="lname" placeholder="Enter your last name" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="company">Company<span class="text-danger">*</span></label>
                    <input type="text" id="company" class="form-control" name="company" placeholder="Your company" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control" name="title" placeholder="Your title" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="emailContact">Email<span class="text-danger">*</span></label>
                    <input type="email" id="emailContact" class="form-control" name="emailContact" placeholder="Your Email" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label" for="phone">Phone<span class="text-danger">*</span></label>
                    <input type="number" id="phone" class="form-control" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="comments">Comments</label>
                    <textarea name="comments" id="comments" class="form-control" rows="3" placeholder="Additional comments"></textarea>
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary text-white" style="background-color:#0aad0a!important;">Submit</button>
                </div>
            </form>
        </header>
    </section>
</main>

<x-footer></x-footer>
