<div class="modal fade" tabindex="-1" role="dialog" id="login_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="text-center">Login</h3>
            </div>
            <div class="modal-body">
                <div class="container" style="width:auto;">

                    <form class="form-horizontal" action="#!">
                        <div class="row" style="margin-left:10px;margin-right:10px;">
                            <div class="col-md-12">
                                <span id="l_message"></span>
                                <!-- email block -->
                                <div id="login_with_email_div">
                                <div class="form-group">
                                    <label class="col-md-4">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" id="l_email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your Email with
                                            anyone else.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Password</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4"></label>
                                    <div class="col-md-8">
                                        <a class="btn btn-primary submit blue_button col-md-12" id="signin">Sign In</a>
                                        <p>
                                            <a href="#" data-toggle="modal" data-target="#register_modal" id="btnRegisterModalShow" class="pull-left">
                                                Don't have an account?
                                            </a>
                                            <a href="javascript:void(1)" id="forgetpassword" class="pull-right">
                                                Forget password?
                                            </a>
                                        </p>
                                    </div>
                                </div>
                              </div>
                                <!-- end of email block -->
                                <!-- <div class="form-group text-center" style="margin-top: 20px">
                                <label class="col-md-4"></label>
                                    <div class="col-md-8">
                                    <h2 class="text-center">OR</h2>
                                    <h3 class="text-center">Sign in with OTP</h3>
                                </div>
                                </div> -->
                                <!-- otp block -->
                                <div id="login_with_otp_div" style="display:none;">
                                <div class="form-group">
                                    <label class="col-md-4">Mobile No.</label>
                                    <div class="col-md-8">
                                        <input class="form-control" id="mobileno" type="text" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group beforeotp">
                                    <label class="col-md-4"></label>
                                    <div class="col-md-8">
                                        <button id="sendotp" class="btn btn-primary btn-block" type="button">Send OTP</button>
                                    </div>
                                </div>

                                <div class="form-group afterotp" style="display: none">
                                    <label class="col-md-4">OTP</label>
                                    <div class="col-md-8">
                                        <input class="form-control" id="otp" type="text" maxlength="6">
                                    </div>
                                </div>
                                <div class="form-group afterotp" style="display: none">
                                    <label class="col-md-4"></label>
                                    <div class="col-md-8">
                                        <button id="otplogin" class="btn btn-success btn-block" type="button">Sign in</button>
                                    </div>
                                </div>
                              </div>
                              <!-- end of otp block -->
                            </div>
                        </div>
                    </form>

                    <hr/>
                    <div class="form-group text-center" id="btn_login_with_otp" style="font-size: medium"><a href="#!" >OTP LOGIN</a></div>
                    <div class="form-group text-center" id="btn_login_with_email" style="font-size: medium; display:none;"><a href="#!" >EMAIL LOGIN</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="forgetpass_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-height: 300px;">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="text-center">Reset Password by OTP</h3>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                  <input id="reg_email" class="form-control text-center" placeholder="Your registered email id" type="email" style="margin: 10px auto" />
                  <h2 class="text-center">Or</h2>
                  <input id="reg_mobile" class="form-control text-center" placeholder="Your 10-digit registered mobile no." type="text" maxlength="10" style="margin: 10px auto" />
                  <button id="sendotprequest" class="btn btn-primary btn-block" type="button">Send OTP</button>

                  <input id="reg_otp" class="form-control text-center" placeholder="Enter OTP" type="text" style="margin-top: 30px; display: none" />
                  <input id="reg_newpass" class="form-control text-center" placeholder="Enter new passwrd" type="password" style="margin: 10px auto; display: none" />
                  <input id="reg_confpass" class="form-control text-center" placeholder="Confirm password" type="password" style="margin: 10px auto; display: none" />
                  <button id="reg_btn" class="btn btn-success btn-block" type="button" style="margin: 10px auto; display: none">Verify OTP</button>
                </div>
                <div class="col-sm-2"></div>
              </div>

            </div>
        </div>
    </div>
</div><!-- End of #forgetpass_modal-->

<script type="text/javascript">
    $(document).ready(function () {
        $("#signin").click(function () {
            $('#signin').empty().append("processing...");
            var email = $("#l_email").val();
            var password = $("#password").val();
            $('#l_message').empty().append('<div class="alert alert-warning" role="alert">Authenticating....</div>');
            $.ajax({
                url: "<?= base_url("login/login_process"); ?>",
                method: "post",
                data: {
                    email: email,
                    password: password
                },
                dataType: "json",
                success: function (jsn) {
                    if (jsn.login) {
                        $('#l_message').empty().append('<div class="alert alert-success" role="alert">' + jsn.message + '</div>');
                        window.location.href = "";
                    } else {
                        $('#l_message').empty().append('<div class="alert alert-danger" role="alert">' + jsn.message + '</div>');
                    }
                    $('#signin').empty().append("Submit");

                }
            });
        });

        $(document).on("click", "#sendotp1", function(){
            //$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Sending OTP...');
            $(this).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Sending OTP...');

        });

        $(document).on("click", "#sendotp", function(){
            var mobNum = $("#mobileno").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if (filter.test(mobNum)) {
                if(mobNum.length==10){
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('login/sendotp')?>",
                        dataType: "json",
                        data: {"mobnum":mobNum},
                        beforeSend:function(){
                            $("#sendotp").attr("disabled", true);
                            $("#sendotp").html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Sending OTP...');
                        },
                        success: function(res){
                            if(res.flag == 1) { //console.log("For testing mode only, OTP : "+res.otp);
                                $('#mobileno').attr('readonly', true);
                                $(".beforeotp").hide();
                                $(".afterotp").show();
                            } else {
                                alert(res.msg);
                                $("#mobileno").focus();
                            }//End of if else
                        }
                    });//End of ajax()
                } else {
                    alert('Please put 10  digit mobile number');
                    $("#mobileno").focus();
                    return false;
                }//End of if else
            } else {
                alert('Not a valid number');
                $("#mobileno").val("");
                $("#mobileno").focus();
                return false;
            }//End of if else
        });

        $(document).on("click", "#otplogin", function(){
            var mobNum = $("#mobileno").val();
            var otp = $("#otp").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if (filter.test(otp)) {
                if(otp.length==6){
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('login/otplogin')?>",
                        dataType: "json",
                        data: {"mobnum":mobNum, "otp":otp},
                        beforeSend:function(){
                            $("#otplogin").attr("disabled", true);
                            $("#otplogin").html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Processing Login...');
                        },
                        success: function(res){ //alert(res);
                            if(res.flag == 1) {
                                window.location.href = "";
                            } else {
                                alert(res.msg);
                                $("#otp").focus();
                                return false;
                            }//End of if else
                        }
                    });//End of ajax()
                } else {
                    alert('Please put 6 digit OTP');
                    $("#otp").focus();
                    return false;
                }//End of if else
            } else {
                alert('Not a valid OTP');
                $("#otp").val("");
                $("#otp").focus();
                return false;
            }//End of if else
        });

        $(document).on("click", "#forgetpassword", function(){
            $("#login_modal").modal('hide');
            $("#forgetpass_modal").modal('show');
        });
        $(document).on("click", "#btnRegisterModalShow", function(){
            $("#login_modal").modal('hide');
            $("#register_modal").modal('show');
        });

        $("#btn_login_with_otp").on('click',function(){
          $("#login_with_otp_div").show();
          $("#login_with_email_div").hide();

          $("#btn_login_with_otp").hide();
          $("#btn_login_with_email").show();
        })
        $("#btn_login_with_email").on('click',function(){
          $("#login_with_otp_div").hide();
          $("#login_with_email_div").show();

          $("#btn_login_with_otp").show();
          $("#btn_login_with_email").hide();
        })


        $(document).on("click", "#sendotprequest", function(){
            var reg_email = $("#reg_email").val();
            var reg_mobile = $("#reg_mobile").val();

            if (reg_email.length < 8 && reg_mobile.length != 10) {
                alert('Please enter a value');
                $("#reg_email").focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('login/sendotp')?>",
                    dataType: "json",
                    data: {"email":reg_email, "mobnum":reg_mobile},
                        beforeSend:function(){
                            $("#sendotprequest").attr("disabled", true);
                            $("#sendotprequest").html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Sending OTP...');
                        },
                    success: function(res){
                        if(res.flag == 1) { console.log("For testing mode only, OTP : "+res.otp);
                            $('#reg_email').attr('readonly', true);
                            $('#reg_mobile').attr('readonly', true);
                            $("#sendotprequest").hide();
                            $("#reg_otp").show();
                            $("#reg_newpass").show();
                            $("#reg_confpass").show();
                            $("#reg_btn").show();
                        } else {
                            alert(res.msg);
                            $("#reg_email").focus();
                        }//End of if else
                    }
                });//End of ajax()
            }//End of if else
        });

        $(document).on("click", "#reg_btn", function(){
            var email = $("#reg_email").val();
            var mobNum = $("#reg_mobile").val();
            var otp = $("#reg_otp").val();
            var reg_newpass = $("#reg_newpass").val();
            var reg_confpass = $("#reg_confpass").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if (filter.test(otp)) {
                if(reg_newpass !== reg_confpass) {
                    alert('Password does not matched!');
                    $("#reg_confpass").focus();
                    return false;
                } else if(otp.length != 6) {
                    alert('Please put 6 digit OTP');
                    $("#otp").focus();
                    return false;
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('login/updatepass')?>",
                        dataType: "json",
                        data: {"email":email, "mobnum":mobNum, "otp":otp, "pass":reg_newpass},
                        beforeSend:function(){
                            $("#reg_btn").attr("disabled", true);
                            $("#reg_btn").html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Updating Password...');
                        },
                        success: function(res){ //alert(res);
                            if(res.flag == 1) {
                                window.location.href = "";
                            } else {
                                alert(res.msg);
                                $("#otp").focus();
                                return false;
                            }//End of if else
                        }
                    });//End of ajax()
                }//End of if else
            } else {
                alert('Not a valid OTP');
                $("#otp").val("");
                $("#otp").focus();
                return false;
            }//End of if else
        });
    });
</script>
