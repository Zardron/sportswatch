<!-- Request OTP Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">LOGIN</h5>
            </div>
            <div class="modal-body">
                <form id="fupForm" name="form1" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="phones" placeholder="Phone #" name="phone">
                    </div>
                    <button type="button" name="save" class="btn btn-primary" id="otp_request">Request OTP</button>
            </div>

            <div class="modal-footer">
                <!-- <button id="btnCounter" class="btn btn-success" disabled><span id="count"></span> Resend OTP</button> -->
                </form>
            </div>
        </div>
    </div>
</div>