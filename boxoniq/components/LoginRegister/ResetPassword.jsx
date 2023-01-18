import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
const ResetPassword = () => {
  return (
    <div>
      <div className="signup">
        <div className="container">
          <div className="row justify-content-center text-start mt-3 mb-0 mb-lg-4 ">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="signup_title">
                <h1>Reset Password</h1>
              </div>
            </div>
          </div>
          <div className="row justify-content-center text-start">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="signup_form">
                <Form>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Enter your phone number to continue
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="  Enter your phone number"
                    />
                  </Form.Group>

                  <Button
                    className="signup_button w-100 mb-2 mb-lg-5"
                    type="submit"
                  >
                    Reset
                  </Button>
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ResetPassword;
