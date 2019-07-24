<!--/Register-->
<div class="modal fade" tabindex="-1" role="dialog" id="register_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="text-center">Register</h3>
            </div>
            <div class="modal-body">
                <div class="container" style="width:auto">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 align="center" id="r_message"></h3>
                            <form id="registration_form" autocomplete="off" action="<?= base_url(); ?>customers/customer/customer_save_modal" method="post">
                                <div class="form-group">
                                    <label class="col-md-4">Name</label>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" id="r_name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Phone</label>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control"  id="r_contact" name="contact" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Email</label>
                                    <div class="col-md-8 form-group">
                                        <input type="email" class="form-control"  id="r_email" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">City/Location</label>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" autocomplete="off" value="" id="address" name="address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Password</label>
                                    <div class="col-md-8 form-group">
                                        <input type="password" class="form-control" id="mypassword" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Confirm Password</label>
                                    <div class="col-md-8 form-group">
                                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4"></label>
                                    <div class="col-md-8 form-group login">
                                        <button type="submit" class="btn btn-success btn-login submit col-md-12" id="submit_button">Register</button>
                                        <p class="text-center col-md-12">
                                            <a href="#">By clicking Register, I agree to your terms</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#registration_form").validate({
                // Specify validation rules
                rules: {
                    name: "required",
                    address: "required",
                    contact: {
                        required: true,
                        number: true,
                        minlength: 10,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: '<?= base_url("customers/customer/check_email"); ?>',
                            method: "POST",
                            dataType: 'json',
                            /*data: {
                          user_nickname: function() {
                            return $( "#user_nickname" ).val();
                            }                       
                            success: function(data) {
                                console.log(data);
                                if (data.data.email == 0) {
                                    message: {
                                        email: 'The email is already Registered!'
                                    }
                                    
                                }
                            }*/
                        }
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    cpassword: {
                        required: true,
                        equalTo: "#mypassword"
                    }
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter your name",
                    email: {
                        required: "Please enter your email",
                        email: "Please enter valid Email",
                        remote: "Email already exists",
                    },
                    contact: {
                        required: "Please enter your Phone No",
                        minlength: "Mobile No should be of 10 digits",
                    },
                    address: "Please enter your City",
                    cpassword: {
                        required: "Please enter your Confirm Password",
                        equalTo: "Password and Confirm Password Does not match",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                },

                submitHandler: function(form) {
                    $('#submit_button').empty().append("processing...");
                    var name=$("#r_name").val();
                    var email=$("#r_email").val();
                    var phone=$("#r_contact").val();
                    var address=$("#address").val();
                    var password=$("#mypassword").val();
                    $.ajax({
                        url:"<?= base_url("customers/customer/save_customer"); ?>",
                        method:"post",
                        data:{name:name,email:email,phone:phone,address:address,password:password},
                        dataType:"json",
                        success:function(jsn){
                            console.log(jsn);
                            if(jsn.message.flag==1){
                                $('#r_message').empty().append(jsn.message.message+"<br/><br/><br/>");
                                $('#registration_form').fadeOut("slow");
                            }else{
                                $('#r_message').empty().append(jsn.message.message);
                                $('#submit_button').empty().append("submit");
                            }

                        }
                    });
                }
            });
        });
        
    });
</script>
<!--//Register-->