<div class="contact-container">

    <div class="title-container">
        <h3>Contact Us</h3>
        <img src="{{asset('/customer_page_images/body/title_bg_contact_us.png')}}" />
    </div>

    <div class="contact-form-container">
        <form action="" method="post">
            @csrf
            <h3>Email</h3>
            <p>To contact us via email, please complete our online form below. Required fields are marked with *. We try to reply to all email enquiries within 2 hours (received within our working hours of 9am-5pm, Mon-Fri). </p>

            <div class="form-content-container">
                <div class="form-labels">
                    <p>Title</p>
                    <p>First name: *</p>
                    <p>Last name: *</p>
                    <p>Company:</p>
                    <p>Phone:</p>
                    <p>Email: *</p>
                    <p>Order No:</p>
                    <p>Message: *</p>
                </div>
                <div class="form-inputs">
                    <select name="title" style="width:50%;"><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="ms">Ms</option></select>
                    <input type="text" name="first_name" required>
                    <input type="text" name="last_name" required>
                    <input type="text" name="company" >
                    <input type="tel" name="phone" >
                    <input type="email" name="email" required>
                    <input type="text" name="order_number" >
                    <input class="text-area" type="text" name="message" required>
                </div>
            </div>

            <button class="submit" type="submit">Submit</button>
        </form>

        <div class="background-container"></div>
    </div>

</div>