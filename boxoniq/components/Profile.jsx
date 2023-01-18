import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import ListGroup from "react-bootstrap/ListGroup";

const Profile = () => {
  return (
    <div className="profile">
      <div className="row">
        <div className="col-md-12">
          <h3 className="mt-5 text-center">My Profile</h3>
        </div>
      </div>
      <div className="container">
        <div className="row">
          <div className="col-md-4">
            <img
              className=""
              src="https://i.ibb.co/W0DTnG4/Rectangle-205.jpg"
              alt=""
            />
          </div>
          <div className="col-md-6">
            <Card style={{ width: "18rem" }}>
              <Card.Header>Featured</Card.Header>
              <ListGroup variant="flush">
                <ListGroup.Item>Cras justo odio</ListGroup.Item>
                <ListGroup.Item>Dapibus ac facilisis in</ListGroup.Item>
                <ListGroup.Item>Vestibulum at eros</ListGroup.Item>
              </ListGroup>
            </Card>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Profile;
